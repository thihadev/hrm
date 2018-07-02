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

// Route::get('/', function () {
//     return view('auth.login');
// });

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

// Route::group(['middleware' => 'auth'], function() {

Route::get('/chat', 'ChatController@index');
Route::get('chat-data', 'ChatController@data')->name('chat.data');
Route::get('/messages', 'ChatController@fetchMessages')->middleware('auth');
Route::post('/messages', 'ChatController@sendMessage')->middleware('auth');
Route::post('/messages', 'ChatController@deleteMessage')->middleware('auth');


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
// Route::get('/', 'HomeController@event')->name('home');


//users profile
Route::get('profile', 'ProfileController@index')->name('profile.index');
Route::post('profile', 'ProfileController@update_avatar');

//users setting
Route::resource('user' , 'UserSettingController');
Route::get("user-data", "UserSettingController@data")->name("user.data");


//Employee Route
Route::resource('emp', 'EmployeeController');
Route::get("emp-data", "EmployeeController@data")->name("emp.data");


//Department & position route
Route::resource("dep", 'DepartmentController');
Route::get("dep-data", 'DepartmentController@data')->name('dep.data');

Route::resource("des", 'DesignationController');
Route::get("des-data", 'DesignationController@data')->name('des.data');

Route::resource("expense" ,"ExpenseController");
Route::get("expense-data", 'ExpenseController@data')->name('expense.data');

Route::resource("client" ,"ClientController");
Route::get("client-data", 'ClientController@data')->name('client.data');

Route::resource("payroll", "PayrollController");
Route::get("payroll-data", 'PayrollController@data')->name('payroll.data');


Route::resource("attendance", "AttendanceController");
Route::get("attendance-data", 'AttendanceController@data')->name('attendance.data');

Route::resource("project", "ProjectController");
Route::get("project-data", 'ProjectController@data')->name('project.data');

Route::resource('noticeboard', 'PostController');
Route::resource('/events', 'EventController');
Route::resource("setting", "SettingController");


Route::get('/payslip', function() {
	return view('Extra_Testing.payslip');
});
Route::get('about', function() {
	return view('HRMS.about');
});
Route::get('service', function() {
	return view('HRMS.service');
});






