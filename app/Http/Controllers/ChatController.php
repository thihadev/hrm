<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index() 
    {
    	return view('chat.index');
    }

    // public function getMessages(Request $request)
    // {
    // 	if (!$request->ajax()) {
    // 		throw new UnauthorizedException();
    // 	}
    // 	$messages = Message::with('user')->MostRecent()->get();
    // 	$messages = array_reverse($messages->toArray());

    // 	return $messages;
    // }

    //     public function postMessages(Request $request)
    // {
    // 	if (!$request->ajax()) {
    // 		throw new UnauthorizedException();
    // 	}
    // 	$user = Auth::user();
    // 	$message = $user->messages()->create([
    // 		'message' => request()->get('message')
    // 	]);

    //     broadcast(new MessagePosted($user, $message))->toOthers();
    	
    //     return ['status' => 'OK'];
    // }

    public function fetchMessages()
    {
      return Message::with('user')->get();
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
