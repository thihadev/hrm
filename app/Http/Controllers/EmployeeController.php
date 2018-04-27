<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\File;
use App\Department;
use App\Designation;
use App\Employee;
use Image;

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

        $employees = DB::table('employees')
        ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
        ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id')
        ->select('employees.*', 'departments.name as department_name', 'departments.id as department_id', 'designations.name as designation_name', 'designations.id as designation_id' )
        ->paginate(5);
        // $employees = Employee::paginate(5);
        return view("Employee.index",['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
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
        // $employees = Employee::all();
        // $this->validateInput($request);
        // // Upload image

        // $path = $request->file('avatar')->store('public');
        // $keys = ['name', 'email','age', 'phone','address','dateofbirth', 'department_id', 'designation_id', 'joined'];
        // $input = $this->createQueryInput($keys, $request);
        // $input['avatar'] = $path;
        // Employee::create($input);
        // return view('Employee.index', compact('employees', 'avatar'));

            $request-> validate ([
            'photo' => 'required',
            'name' => 'required|min:3',
            'email' => 'required|email',
            'age' => 'required|integer',
            'phone' => 'required',
            'address' => 'required',
            'dateofbirth' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'joined' => 'required'
        ]);


        $employees = DB::table('employees');

        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $filename = time(). '.'. $request->file('photo')->getClientOriginalExtension();
            Image::make($photo)->resize(300, 300)->save( public_path('/uploads/photos/' . $filename ) );

            $employees = Employee::all();
            $employees->photo = $filename;
            // $employees->save();
        }
        Employee::create($request->except('_token'));
        return view('Employee.store', compact('employees'));

    }

        // $request->file('avatar');
        // Storage::put('public/image', $request->file('avatar'));
        // Employee::create($request->except('_token'));

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
        // $employee = Employee::findOrFail($id);
        // $this->validateInput($request);
        // // Upload image
        // $keys = ['name', 'email', 'age', 'phone','address','dateofbirth', 'department_id', 'designation_id', 'joined'];
        // $input = $this->createQueryInput($keys, $request);
        // if ($request->file('avatar')) {
        //     $path = $request->file('avatar')->store('public');
        //     $input['avatar'] = $path;
        // }

        // Employee::where('id', $id)
        //     ->update($input);

          
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
    //      $path = storage_path().'/public/'.$name;
    //     if (file_exists($path)) {
    //         return Response::download($path);
    //     }
    // }

    private function validateInput(Request $request) {
        $this->validate($request, [
            'photo' => 'required',
            'name' => 'required|min:3',
            'email' => 'required|email',
            'age' => 'required|integer',
            'phone' => 'required',
            'address' => 'required',
            'dateofbirth' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'joined' => 'required'
        ]);
        // $path = $request->file('avatar')->put('avatars');
    }

    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }

     public function data(Request $request) {
        if($request->ajax()) {

            $model = Employee::query();
            return Datatables::of($model)        
            ->addColumn("edit", function($model) {
                    $data = "<a class='btn btn-success' href=" . route("emp.edit", $model->id) . ">Edit</a>";
                    return $data;
                })
            ->addColumn("delete", function($model) {
                    $data = '<form action="' . route('emp.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger">Delete</button>
                            </form>';
                    return $data;
                })
            ->rawColumns(['edit', 'delete'])
            ->toJson();
        }
        return abort(404);
    }

    //     public function upload(Request $request){

    //     // Handle the user upload of avatar
    //         $employees = Employee::all();
    //     if($request->hasFile('myphoto')){
    //         $avatar = $request->file('myphoto');
    //         $filename = time() . '.' . $avatar->getClientOriginalExtension();
    //         Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/photos/' . $filename ) );

    //         $employees = Auth::user();
    //         $employees->avatar = $filename;
    //         $employees->save();
    //     }

    //     return view('Employee.index', compact('employees'));

    // }
}