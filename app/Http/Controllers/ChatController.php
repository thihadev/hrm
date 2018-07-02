<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Yajra\Datatables\Datatables;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use App\User;

class ChatController extends Controller
{
    public function index() 
    {
        
      $users = User::all();
    	return view('chat.index', compact("users"));
    }

    public function fetchMessages()
    {
      $messages = Message::with('user')->MostRecent()->get();
      $messages = array_reverse($messages->toArray());


      return $messages;
    }

/**
 * Persist message to database
 *
 * @param  Request $request
 * @return Response
 */
    public function sendMessage(Request $request)
    {
      $user = Auth::user();

      $message = $user->messages()->create([
        'message' => $request->input('message')
      ]);

      broadcast(new MessageSent($user, $message))->toOthers();

      return ['status' => 'Message Sent!'];
    }


}
