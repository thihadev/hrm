<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Attendance;
use App\Employee;
use App\Department;
use App\Designation;

class AttendanceController extends Controller
{

    public function __construct() 
    {
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
            $attends = Attendance::select('id')->get(); 
            return view("Attendance.index", compact('attends'));
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
        $attends = Attendance::all(); 
        $employees = Employee::all();        

        return view('Attendance.create', compact("attends", "employees"));
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

        $request->validate ([
            'att_employee_id' => 'required',
            'att_date' => 'required',
            'attend' => 'required'

        ]);

        $attends = new Attendance();
        $attends->att_employee_id = $request->att_employee_id;
        $attends->att_date = $request->att_date;
        $attends->attend = $request->attend;
        $attends->save();

        alert()->success('Successfully', 'Attendance info Created!');
        return view('Attendance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("errors.404");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasPermission("update-info")) {
            $attends = Attendance::findOrFail($id);
            $employees = Employee::select('name', 'id')->get();
        return view('Attendance.edit',compact("attends","employees"));
        }else{
                return redirect()->route('home');
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
            'att_employee_id' => 'required',
            'att_date' => 'required',
            'attend' => 'required'

            ]);
        Attendance::find($id)->update($request->all());
        alert()->success('Successfully', 'Updated Attendance', 'success');
        return redirect()->route('attendance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasPermission("delete-info")) {
            Attendance::findOrFail($id)->delete();

        alert()->success('Successfully', 'Deleted Attendance');
            return redirect()->back();
        }else{
            return redirect()->route('home');
        }
    }

    public function data(Request $request) {

        if($request->ajax()) {

            $model = Attendance::latest();
             $model = DB::table('attendances') 
        ->leftJoin('employees', 'attendances.att_employee_id', '=', 'employees.id')
        ->select('attendances.*', 'employees.name as employee_name', 'employees.id as att_employee_id');
           
            return Datatables::of($model)
                ->addColumn("attend",function($model) {
                    if($model->attend == 1) {
                       $data = '<p class="text-green">Present</p>';
                      } else {
                        $data = '<p class="text-red">Absent</p>';
                       }
                    return $data;
                    
            })
                ->addColumn("action", function($model) {
            if(Auth::user()->hasPermission("update-info") || Auth::user()->hasPermission("delete-info"))
            {
            if(Auth::user()->hasPermission("update-info") && Auth::user()->hasPermission("delete-info"))
              {
                    $data = '<div class="col-md-4"><a href="'.route("attendance.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div><div class="col-md-2"><form action="' . route('attendance.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                }
            else if(Auth::user()->hasPermission("update-info")) {
                    $data = '<div class="col-md-3"><a href="'.route("attendance.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div>';
                }
            else if(Auth::user()->hasPermission("delete-info")) {                     
                    $data =  '<div class="col-md-2"><form action="' . route('attendance.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                            
                        }
                
                    return $data;
                }
                                               
            })
            ->rawColumns(["attend",'action'])
            ->toJson();
    }
    return abort(404);
    }
}
