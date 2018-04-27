<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    // 	return ['status' => 'OK'];
    // }
}
