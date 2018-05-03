<?php

use App\Events\MessagePosted;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Chat room route
Route::get('/chat', function() {
	return view('chat');
})->middleware('auth');

// Route::get('/chat', 'ChatController@getMessages')->middleware('auth');
// Route::post('/chat', 'ChatController@postMessages')->middleware('auth');
Route::get('/chat', 'ChatController@index')->middleware('auth');

//chat username route
// Route::get('/username', 'UsernameController@show')->middleware('auth');

Route::get('/messages', function() {
	return App\Message::with('user')->get();
})->middleware('auth');

Route::post('/messages', function() {
	$user = Auth::user();
	$user->messages()->create([
		'message' => $request()->get('message')
	]);
	return ['status' => 'OK'];
})->middleware('auth');


// event(new MessagePosted($message, $user));


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//users profile
Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@update_avatar');

//login & logout route
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Changepassword route
Route::get('/changePassword', 'HomeController@showChangePasswordForm');
Route::post('/changePassword', 'HomeController@changePassword')->name('changePassword');


//test
Route::get('/admin', 'AdminController@index');
Route::get('/superadmin', 'SuperAdminController@index');

//Employee Route
Route::resource('emp', 'EmployeeController');
// Route::get('emp', 'EmployeeController@index')->name('emp.index');
// Route::get('emp/create', 'EmployeeController@create')->name('emp.create');
// Route::post('emp/store', 'EmployeeController@store')->name('emp.store');
Route::get("emp-data", "EmployeeController@data")->name("emp.data");
// Route::get('avatars/{name}', 'EmployeeController@load');
// Route::get('/Employee/create-step1', 'EmployeeController@createStep1');
// Route::post('/Employee/create-step1', 'EmployeeController@postCreateStep1');

//Department & position route
Route::resource("dep", 'DepartmentController');
Route::get("dep-data", 'DepartmentController@data')->name('dep.data');

Route::resource("des", 'DesignationController');
Route::get("des-data", 'DesignationController@data')->name('des.data');



