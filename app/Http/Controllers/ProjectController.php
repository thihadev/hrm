<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Employee;
use App\Client;
use App\Project;

class ProjectController extends Controller
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
        if(Auth::user()->hasPermission("show-info")) {
            return view("Project.index", compact("project"));
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
            $projects = Project::all();
            $clients = Client::all();        
            $employees = Employee::all();


            return view('Project.create', compact("projects","employees",  "clients"));
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
            'p_name' => 'required',
            'client_id' => 'required',
            'employee_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'

        ]);

        $projects = new Project();
        $projects->p_name = $request->p_name;
        $projects->client_id = $request->client_id;
        $projects->employee_id = $request->employee_id;
        $projects->start_date = $request->start_date;
        $projects->end_date = $request->end_date;
        $projects->save();

        return view('Project.index');
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
            $projects = Project::findOrFail($id);
            $employees = Employee::select('name', 'id')->get();
            $clients = Client::select('c_name', 'id')->get();
        return view('Project.edit',compact("projects", "employees", "clients"));
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
            'p_name' => 'required',
            'client_id' => 'required',
            'employee_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'

        ]);

        Project::find($id)->update($request->all());
         return redirect()->route('project.index');
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
            Project::findOrFail($id)->delete();
            return view("Project.index");
        }else{
            return redirect()->route('home');
        }
    }

    public function data(Request $request) {

        if($request->ajax()) {

            $model = Project::latest();
            return Datatables::of($model)
            ->addColumn("cname", function($model) {
                    $data = '<p>'.$model->client->c_name.'<p>';
                    return $data;
                })
            ->addColumn("empname", function($model) {
                    $data = '<p>'.$model->employee->name.'<p>';
                    return $data;
                })
                ->addColumn("action", function($model) {
            if(Auth::user()->hasPermission("update-info") || Auth::user()->hasPermission("delete-info"))
            {
            if(Auth::user()->hasPermission("update-info") && Auth::user()->hasPermission("delete-info"))
              {
                    $data = '<div class="col-md-4"><a href="'.route("project.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div><div class="col-md-2"><form action="' . route('project.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                }
            else if(Auth::user()->hasPermission("update-info")) {
                    $data = '<div class="col-md-3"><a href="'.route("project.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div>';
                }
            else if(Auth::user()->hasPermission("delete-info")) {                     
                    $data =  '<div class="col-md-2"><form action="' . route('project.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                            
                        }
                
                    return $data;
                }
                                               
            })
            ->rawColumns(['cname','empname','action'])
            ->toJson();
    }
    return abort(404);
    }
}
