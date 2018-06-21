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
        $employees = Employee::all();
        $payrolls = Payroll::all();

        return view("Payroll.index", ['payrolls' => $payrolls, 'employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        $payrolls = Payroll::all();        
        return view('Payroll.create', ['payrolls' => $payrolls,'employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
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
        return redirect()->route('payroll.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payrolls = Payroll::where('id',$id)->first();
        $employees = Employee::where('id', $id)->first();

        $departments = Department::where('id', $id)->first();
        $designations = Designation::where('id', $id)->first();
        // dd($payrolls);
        
        return view("Payroll.payslip", compact("payrolls" ,"employees", "departments", "designations"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payrolls = Payroll::find($id);
        $employees = Employee::select('name', 'id')->get();
        return view('Payroll.edit',['payrolls' => $payrolls, 'employees' => $employees]);
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
        $payrolls = Payroll::findOrFail($id);
        $payrolls->delete();
        
        alert()->success('Successfully', 'Employee Payroll Deleted', 'success');
        return redirect()->back();
    }

    public function data(Request $request) {

        if($request->ajax()) {

            $model = Payroll::latest();
            //dd($model);
            $model = DB::table('payrolls') 
        ->leftJoin('employees', 'payrolls.employee_id', '=', 'employees.id')
        ->select('payrolls.*', 'employees.name as employee_name', 'employees.id as employee_id');
           
            return Datatables::of($model)
                ->addColumn("payslip", function($payroll) {
                    $data = '<div class="col-md-3"><a href="'.route("payroll.show", $payroll->id).'"><button class="btn btn-info"> Generate Payslip</button></a></div>';
                    

                    return $data;
                })
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
            ->rawColumns(['payslip','action'])
            ->toJson();
    }
    return abort(404);
    }


}
