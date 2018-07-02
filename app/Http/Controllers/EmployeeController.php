<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Payroll;
use App\Department;
use App\Role;
use App\UserRole;
use App\User;
use App\Designation;
use App\Employee;
use Intervention\Image\Facades\Image;
use Session;

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

        if(Auth::user()->hasPermission("show-info")){        
            $employees = Employee::all(); 
            return view("Employee.index", compact('employees'));
        }else{
            return redirect()->route('home');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasPermission("create-info")){   
        $employees = Employee::all();        
        $departments = Department::all();
        $designations = Designation::all();
        $roles = \App\Role::orderBy('name')->pluck('name', 'id');
        return view('Employee.create', ['roles' => $roles, 'departments' => $departments, 'designations' => $designations]);
        }else{
            return redirect()->route('home');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request-> validate ([
            'photo' => 'required',
            'name' => 'required|min:3',
            'email' => 'required|email|unique:employees',
            'gender' => 'required',
            'nrc' => 'required|unique:employees',
            'phone' => 'required|min:6|max:11',
            'address' => 'required',
            'dateofbirth' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'joined' => 'required',
            'salary' => 'required'
        ]);


        $filename = public_path('photos/a.png');
        if($request->file('photo')) {
            $file = $request->file('photo');
            Image::make($file)->resize(300, 300);
            $filename = str_random(12);
            $fileExt = $file->getClientOriginalExtension();
            
            $photopath = public_path('photos');
            $filename = $filename . '.' . $fileExt;
            
            $file->move($photopath, $filename);

            $user            = new User;
            $user->name      = $request->name;
            $user->email     = str_replace(' ', '_', $request->name) . '@gmail.com';
            $user->password  = bcrypt('123456');          
            $user->save();

            $emp                = new Employee;
            $emp->photo         = $filename;
            $emp->name          = $request->name;
            $emp->email         = $request->email;
            $emp->gender        = $request->gender;
            $emp->nrc           = $request->nrc;
            $emp->phone         = $request->phone;
            $emp->address       = $request->address;
            $emp->dateofbirth   = $request->dateofbirth;
            $emp->department_id = $request->department_id;
            $emp->designation_id= $request->designation_id;
            $emp->joined        = $request->joined;
            $emp->salary        = $request->salary;
            $emp->user_id       = $user->id;

            $emp->save();

            $userRole          = new UserRole();
            $userRole->role_id = $request->role;
            $userRole->user_id = $user->id;
            $userRole->save();
        alert()->success('Successfully', 'New Employee Registered');
        // Session()->flash('message', 'Employee Registered successfully!');
            
        return view('Employee.index', compact('employees'));
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->hasPermission("show-info")) { 
        $employees = Employee::findOrFail($id)  
                    ->with('department', 'designation')->where('id',$id)->first();
        $departments = Department::get();
        $designations = Designation::get();

        return view('Employee.show', compact('employees','departments', 'designations'));
        }else{
            return abort(404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasPermission("update-info")){   
        $employees = Employee::findOrFail($id);
        $departments = Department::select('name', 'id')->get(); 
        $designations = Designation::select('name', 'id')->get();

        return view('Employee.edit',compact("employees", "departments","designations"));
        }else{
            return abort(401);
        }
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
        request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'gender' => 'required',
            'nrc' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'dateofbirth' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'joined' => 'required',
            'salary' => 'required'
            ]);
        Employee::find($id)->update($request->all());
        alert()->success('Successfully', ' Updated Employee Info');
         // Session::flash('message', 'You have successfully updated Product.'); 
         return redirect()->route('emp.index');
          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    if(Auth::user()->hasPermission("delete-info")){   
        $employees = Employee::findOrFail($id);
        $employees->user()->delete();
        $employees->delete();

        Session::flash('danger', 'Your Employee Info Deleted Successfully!');
        return redirect()->route('emp.index');
        }else{
            return redirect()->route('home');
        }
 
    }


    // public function load($name) {
    //      $path = storage_path().'/public/uploads'.$name;
    //     if (file_exists($path)) {
    //         return Response::download($path);
    //     }
    // }

    public function data(Request $request) {

        if($request->ajax()) {

            $model = Employee::latest();
           
            $model = DB::table('employees') 
        ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
        ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id')
        ->select('employees.*', 'departments.name as department_name', 'departments.id as department_id', 'designations.name as designation_name', 'designations.id as designation_id' );

            return Datatables::of($model)
                ->addColumn("photo", function($model) {
                    $url = asset("/photos/$model->photo");
                    return view("_datatable.image", compact('url'))->render();
                })

                ->addColumn("action", function($model) {
            if(Auth::user()->hasPermission("update-info") || Auth::user()->hasPermission("delete-info"))
            {
            if(Auth::user()->hasPermission("update-info") && Auth::user()->hasPermission("delete-info"))
              {
                    $data = '<div class="col-md-4"><a href="'.route('emp.show', $model->id).'"><button class="btn btn-info"><i class="fa fa-envelope"></i></button></a></div><div class="col-md-4"><a href="'.route("emp.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div><div class="col-md-4"><form action="' . route('emp.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                }
            else if(Auth::user()->hasPermission("update-info")) {
                    $data = '<div class="col-md-4"><a href="'.route('emp.show', $model->id).'"><button class="btn btn-info"><i class="fa fa-envelope"></i></button></a></div><div class="col-md-4"><a href="'.route("emp.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div>';
                }
            else if(Auth::user()->hasPermission("delete-info")) {                     
                    $data =  '<div class="col-md-1"><form action="' . route('emp.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                            
                        }
                
                    return $data;
                }
                                               
            })
            ->rawColumns(['photo','action'])
            ->toJson();
    }
    return abort(404);
    }

}

