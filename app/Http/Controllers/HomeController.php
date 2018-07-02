<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Event;
use App\Project;
use App\Client;
use App\Payroll;
use App\User;
use App\Employee;
use App\Designation;
use App\Department;
use Calendar;
use Validator;
use Auth;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChangePasswordForm()
    {
        return view('auth.changepassword');
    }

    public function changePassword(Request $request){
 
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
 
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
 
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
 
        return redirect()->back()->with("success","Password changed successfully !");
 
    }
 


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::count();
        $employees = Employee::count();
        $clients = Client::count();
        $payrolls = Payroll::count();
        $deparments = Department::count();
        $designations = Designation::count();
        $projects = Project::count();
        $co = Event::count();

        //event calendar
        $events = Event::get();
        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->event_name . ' / '. $event->event_time,
                true,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date.' +1 day'),
                null,
                    // Add color and link on event
                [

                        'url' => route('events.index')
                ]
            );
        }
        $calendar_details = Calendar::addEvents($event_list); 
        //dd($calendar_details);
        
       $posts = Post::latest()->paginate(5);

        return view('home', compact("employees","users","clients","payrolls","deparments","designations","projects","calendar_details", "co", "posts"))
                ->with('i', (request()->input('page', 1) - 1) * 5);;
          
    }
   
}
