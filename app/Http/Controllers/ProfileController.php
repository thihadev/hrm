<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;
use App\Role;
use App\Employee;
use App\User;
use App\Designation;
use App\Department;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    // $employees = Employee::all();
    $employees = Employee::where('user_id', \Auth::user()->id)
        ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
        ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id')
        ->select('employees.*', 'departments.name as department_name', 'departments.id as department_id', 'designations.name as designation_name', 'designations.id as designation_id' )->get();
        return view('profile', compact('employees'),['user' => Auth::user()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function update_avatar(Request $request){

    //     // Handle the user upload of avatar
    //     if($request->hasFile('avatar')){
    //         $avatar = $request->file('avatar');
    //         $filename = time() . '.' . $avatar->getClientOriginalExtension();
    //         Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

    //         $user = Auth::user();
    //         $user->avatar = $filename;
    //         $user->save();
    //     }

    //     // return view('profile', array('user' => Auth::user()) );
    //     return view('profile',compact('employees'),['user' => Auth::user()]);

    // }

}
