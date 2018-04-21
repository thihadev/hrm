<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Department;
use App\Designation;
use App\Employee;

class EmployeeController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $employees = DB::table('employees')
        // ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
        // ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id')
        // ->select('employees.*', 'department.name as department_name', 'department.id as department_id', 'division.name as division_name', 'division.id as division_id')
        // ->paginate(5);
        $employees = Employee::paginate(5);
        return view("Employee.index", ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $departments = Department::all();
        $designations = Designation::all();
        return view('Employee.create', ['departments' => $departments, 'designations' => $designations]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validateInput($request);
        // // Upload image
        // //$path = $request->file('avatar')->store('avatars');
        // $keys = ['name', 'email', 'password', 'age', 'phone','address','dateofbirth', 'department_id', 'designation_id', 'joined'];
        // $input = $this->createQueryInput($keys, $request);
        // //$input['avatar'] = $path;
        // // Not implement yet
        // // $input['company_id'] = 0;

        // Employee::create($input);
        $request-> validate ([
            'avatar' => 'required',
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'age' => 'required|integer',
            'phone' => 'required',
            'address' => 'required',
            'dateofbirth' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'joined' => 'required'
        ]);

        $file = $request->file('avatar');
        Storage::put($file, 'public/','avatars');
        Employee::create($request->except('_token'));
        return view('Employee.index');
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


    // public function load($name) {
    //      $path = storage_path().'/public/avatars/'.$name;
    //     if (file_exists($path)) {
    //         return Response::download($path);
    //     }
    // }

    // private function validateInput($request) {
    //     $this->validate($request, [
    //         'avatar' => 'required',
    //         'name' => 'required|min:3',
    //         'email' => 'required|email',
    //         'password' => 'required|string|min:6',
    //         'age' => 'required|integer',
    //         'phone' => 'required',
    //         'address' => 'required',
    //         'dateofbirth' => 'required',
    //         'department_id' => 'required',
    //         'designation_id' => 'required',
    //         'joined' => 'required'
    //     ]);
    // }

    // public function createQueryInput($keys, $request) {
    //     $queryInput = [];
    //     for($i = 0; $i < sizeof($keys); $i++) {
    //         $key = $keys[$i];
    //         $queryInput[$key] = $request[$key];
    //     }

    //     return $queryInput;
    // }
}