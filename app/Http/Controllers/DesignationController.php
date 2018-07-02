<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Employee;
use App\Designation;


class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->hasPermission("show-designation"))
        {        
            $designations = Designation::select('id')->get(); 
            return view("Designation.index", compact('designations'));
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
        if(Auth::user()->hasPermission("create-designation"))
        {        
        return view('Designation.create');
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
        $this->validateInput($request);
         Designation::create([
            'name' => $request['name']
        ]);
        alert()->success('Successfully', 'New Designation Added', 'success');
        return view("Designation.index");
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
        if(Auth::user()->hasPermission("update-designation"))
        {        
            $designations = Designation::findOrFail($id);
            return view('Designation.edit', compact("designations"));
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
            'name' => 'required',
        ]);
            
        Designation::find($id)->update($request->all());

        alert()->success('Successfully', 'Designation Info Updated', 'success');
        return redirect()->route('des.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasPermission("delete-designation"))
        {        
            Designation::find($id)->delete();
            alert()->success('Successfully', 'Designation Deleted', 'success');
            return redirect()->route('des.index');
        }else{
            return redirect()->route('home');
        }

    }

    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60|unique:departments'
        ]);
    }

    public function data(Request $request) {
        if($request->ajax()) {

            $model = Designation::all();
            return Datatables::of($model)
                ->addColumn("action", function($model) {
                    if(Auth::user()->hasPermission("update-designation") || Auth::user()->hasPermission("delete-designation"))
            {
            if(Auth::user()->hasPermission("update-designation") && Auth::user()->hasPermission("delete-designation"))
              {
                    $data = '<div class="col-md-2"><a href="'.route("des.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div><div class="col-md-1"><form action="' . route('des.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                }
            else if(Auth::user()->hasPermission("update-designation")) {
                    $data = '<div class="col-md-1"><a href="'.route("des.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div>';
                }
            else if(Auth::user()->hasPermission("delete-designation")) {                     
                    $data =  '<div class="col-md-1"><form action="' . route('des.destroy', $model->id). '" method="post">'
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
