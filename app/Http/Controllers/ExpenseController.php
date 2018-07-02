<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Expense;
use App\Employee;
use App\User;

class ExpenseController extends Controller
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
        if(Auth::user()->hasPermission("show-info")) {
            return view("Expense.index", compact("expenses"));
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
            $expenses = Expense::all();
            return view('Expense.create', ['employees' => $employees, 'expenses' => $expenses]);
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
            'user_id' => 'required',
            'item' => 'required',
            'purchase_from' => 'required',
            'date_of_purchase' => 'required',
            'amount' => 'required'

        ]);

        $expenses = new Expense();
        $expenses->user_id = $request->user_id;
        $expenses->item = $request->item;
        $expenses->purchase_from = $request->purchase_from;
        $expenses->date_of_purchase = $request->date_of_purchase;
        $expenses->amount = $request->amount;
        $expenses->save();

        return view('Expense.index');
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
        $expenses = Expense::findOrFail($id);
        $employees = Employee::select('name', 'id')->get();
        return view('Expense.edit',['expenses' => $expenses, 'employees' => $employees]);
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
            'user_id' => 'required',
            'item' => 'required',
            'purchase_from' => 'required',
            'date_of_purchase' => 'required',
            'amount' => 'required'
        ]);

        Expense::find($id)->update($request->all());

         //Session::flash('message', 'You have successfully updated Product.'); 
         return redirect()->route('expense.index');
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
            Expense::findOrFail($id)->delete();
            return view("Expense.index");
        }else{
            return redirect()->route('home');
        }
    }

    public function data(Request $request) {

        if($request->ajax()) {

            $model = Expense::latest();
            $model = DB::table('expenses') 
        ->leftJoin('employees', 'expenses.user_id', '=', 'employees.id')
        ->select('expenses.*', 'employees.name as employee_name', 'employees.id as user_id');
           
            return Datatables::of($model)
                ->addColumn("action", function($model) {
            if(Auth::user()->hasPermission("update-info") || Auth::user()->hasPermission("delete-info"))
            {
            if(Auth::user()->hasPermission("update-info") && Auth::user()->hasPermission("delete-info"))
              {
                    $data = '<div class="col-md-4"><a href="'.route("expense.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div><div class="col-md-2"><form action="' . route('expense.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                }
            else if(Auth::user()->hasPermission("update-info")) {
                    $data = '<div class="col-md-3"><a href="'.route("expense.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div>';
                }
            else if(Auth::user()->hasPermission("delete-info")) {                     
                    $data =  '<div class="col-md-2"><form action="' . route('expense.destroy', $model->id). '" method="post">'
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
