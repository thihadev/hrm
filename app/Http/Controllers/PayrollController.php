<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Department;
use App\Designation;
use PDF;
use Dompdf\Dompdf;
use App\Payroll;
use App\Employee;

class PayrollController extends Controller
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
        if(Auth::user()->hasPermission("show-user")) {
        $employees = Employee::all();
        $payrolls = Payroll::all();

        return view("Payroll.index", ['payrolls' => $payrolls, 'employees' => $employees]);
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
        if(Auth::user()->hasPermission("create-info")) {
        $employees = Employee::all();
        $payrolls = Payroll::all();        
        return view('Payroll.create', ['payrolls' => $payrolls,'employees' => $employees]);
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
        $request->validate([
            'over_time' => 'required|bool',
            'hours'=> 'required',
            'rate'=>'required'

        ]);
        
        $payrolls = Payroll::create([
            'employee_id' => $request->employee_id,
            'over_time' => $request->over_time,
            'hours' => $request->hours,
            'rate' => $request->rate
            
        ]);
        
        $payrolls->grossPay();
        $payrolls->save();

        alert()->success('Successfully', 'New Employee Payroll Added', 'success');
        return view('Payroll.index', compact("payrolls"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->hasPermission("show-user")) {
        $payrolls = Payroll::findOrFail($id)->with('employee')->where('id',$id)->first();
        $employees = Employee::get();
        $departments = Department::get();
        $designations = Designation::get();
        // dd($employees);
        
        return view("Payroll.payslip", compact("payrolls" ,"employees", "departments", "designations"));
        }else{
            return redirect()->route('home');
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
        if(Auth::user()->hasPermission("update-user")) {
        $payrolls = Payroll::findOrFail($id);
        $employees = Employee::select('name', 'id')->get();
        return view('Payroll.edit',['payrolls' => $payrolls, 'employees' => $employees]);
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
            'over_time' => 'required|bool',
            'hours'=> 'required',
            'rate'=>'required'
        ]);

        Payroll::find($id)->update($request->all());

        alert()->success('Successfully', 'Employee Payroll Updated', 'success');
         //Session::flash('message', 'You have successfully updated Product.'); 
         return redirect()->route('payroll.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasPermission("delete-user")) {
        $payrolls = Payroll::findOrFail($id);
        $payrolls->delete();
        
        alert()->success('Successfully', 'Employee Payroll Deleted', 'success');
        return redirect()->back();
        }else{
            return redirect()->route('home');
        }
    }

    public function data(Request $request) {

        if($request->ajax()) {
            // $model = Payroll::latest();
            $model = DB::table('payrolls') 
        ->leftJoin('employees', 'payrolls.employee_id', '=', 'employees.id')
        ->select('payrolls.*', 'employees.name as employee_name', 'employees.id as employee_id')->get();
           
            return Datatables::of($model)
                ->addColumn("action", function($model) {
            if(Auth::user()->hasPermission("update-info") || Auth::user()->hasPermission("delete-info"))
            {
            if(Auth::user()->hasPermission("update-info") && Auth::user()->hasPermission("delete-info"))
              {
                    $data = '<div class="col-md-4"><a href="'.route("payroll.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div><div class="col-md-2"><form action="' . route('payroll.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                }
            else if(Auth::user()->hasPermission("update-info")) {
                    $data = '<div class="col-md-3"><a href="'.route("payroll.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div>';
                }
            else if(Auth::user()->hasPermission("delete-info")) {                     
                    $data =  '<div class="col-md-2"><form action="' . route('payroll.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                            
                        }
                
                    return $data;
                }
                                               
            })
            ->rawColumns(['action'])
            ->toJson();
    }
    return abort(404);
    }

}
