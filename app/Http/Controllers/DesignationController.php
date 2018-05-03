<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Employee;
use App\Designation;
use Auth;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::paginate(5);
        return view('Designation.index', ['designations' => $designations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('Designation.create',  array('user' => Auth::user()));
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

        return view('Designation.index');
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
             Designation::find($id)->delete();
        return redirect()->route('des.index')
                        ->with('success', "Designation Deleted Successful");
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
                    $data = '<div class="col-md-1"><a href="'.route("emp.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div>'.
                            '<div class="col-md-1"><form action="' . route('emp.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                            return $data;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    return abort(404);
}
}
