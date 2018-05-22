<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Department;
use App\Employee;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::user()->hasPermission("show-department")){        
            $departments = Department::select('id')->get(); 
            return view("Department.index", compact('departments'));
        }else{
            return redirect()->route('home');
        }


        // $departments = Department::paginate(5);
        // return view('Department.index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);
         Department::create([
            'name' => $request['name']
        ]);

        return view('Department.index');
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
        $departments = Department::find($id);
        return view('Department.edit', compact("departments"));

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
        'name' => 'required',

        ]);
        Department::find($id)->update($request->all());
        return redirect()->route('dep.index')
                        ->with('success','Department updated successfully');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::find($id)->delete();
        return redirect()->route('dep.index')
                        ->with('success', "Department Deleted Successful");
    }

    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60|unique:departments'
    ]);
    }

//     public function data(Request $request) {
//         if($request->ajax()) {

//             $model = Department::all();
//             return Datatables::of($model)
//                 ->addColumn("edit", function($model) {
//                     $data = "<a class='btn btn-success' href=" . route("dep.edit", $model->id) . ">Edit</a>";
//                     return $data;
//                 })
//             ->addColumn("delete", function($model) {
//                     $data = '<form action="' . route('dep.destroy', $model->id). '" method="post">'
//                                 . csrf_field() .
//                                  method_field("delete") .
//                                 '<button class="btn btn-danger">Delete</button>
//                             </form>';
//                     return $data;
//                 })
//             ->rawColumns(['edit', 'delete'])
//             ->toJson();
//         }
//         return abort('404');
// }

    public function data(Request $request) {
        if($request->ajax()) {

            $model = Department::all();
            return Datatables::of($model)
                ->addColumn("action", function($model) {
                    if(Auth::user()->hasPermission("update-department") || Auth::user()->hasPermission("delete-department"))
            {
            if(Auth::user()->hasPermission("update-department") && Auth::user()->hasPermission("delete-department"))
              {
                    $data = '<div class="col-md-4"><a href="'.route("emp.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div><div class="col-md-1"><form action="' . route('emp.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                }
            else if(Auth::user()->hasPermission("update-department")) {
                    $data = '<div class="col-md-3"><a href="'.route("emp.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div>';
                }
            else if(Auth::user()->hasPermission("delete-department")) {                     
                    $data =  '<div class="col-md-1"><form action="' . route('emp.destroy', $model->id). '" method="post">'
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
