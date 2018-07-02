<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller
{
  

	// public function admin()
	// {
	// 	$users = User::all();
	// 	return view('admin.home', compact("users"));
	// }

	// public function update_avatar(Request $request){

 //        // Handle the user upload of avatar
 //        if($request->hasFile('avatar')){
 //            $avatar = $request->file('avatar');
 //            $filename = time() . '.' . $avatar->getClientOriginalExtension();
 //            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

 //            $user = Auth::user();
 //            $user->avatar = $filename;
 //            $user->save();
 //        }

 //        return view('profile', array('user' => Auth::user()) );
 //        // return view('profile',compact('employees'),['user' => Auth::user()]);

    }

}

