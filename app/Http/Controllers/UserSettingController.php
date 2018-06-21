<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Department;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\UserRole;
use App\User;


class UserSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

          if(Auth::user()->hasPermission("show-user")){        
            $users = User::select('id')->get(); 

            return view("User.index",compact('users'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $users = User::find($id);
        $userRole  = DB::select('select role_id from user_roles where user_id = :id', ['id' => $id]);
        $roles = Role::select('name', 'id')->get();
        return view('User.edit', compact("users", "userRole", "roles"));
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
        'email' => 'required',

        ]);
        $user = User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        
        DB::table('user_roles')
                ->where('user_id', $id)
                ->update(['role_id' => $request->role]);
            

        // dd($user);
        alert()->success('Successfully', 'User Updated');
        return redirect()->route('user.index');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index')
                        ->with('success', "User Deleted Successful");
    }

    public function data(Request $request) {

        if($request->ajax()) {
            
            $model = User::latest();
            return Datatables::of($model)
                ->addColumn("role", function($model) {
                    $data = '<p>'.$model->roles->first()->name.'<p>';
                    return $data;
                })
                ->addColumn("status", function($model) {
                    if($model->isOnline()) {
                        $data = '<li class="text-green" style="list-style:none;"> Online </li>';
                    } else {
                        $data = '<li class="text-grey" style="list-style:none;"> Offline </li>';
                    }
                    return $data;
                })
                ->addColumn("action", function($model) {
            if(Auth::user()->hasPermission("update-user") || Auth::user()->hasPermission("delete-user"))
            {
            if(Auth::user()->hasPermission("update-user") && Auth::user()->hasPermission("delete-user"))
              {
                    $data = '<div class="col-md-4"><a href="'.route("user.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div><div class="col-md-2"><form action="' . route('user.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                }
            else if(Auth::user()->hasPermission("update-user")) {
                    $data = '<div class="col-md-2"><a href="'.route("user.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div>';
                }
            else if(Auth::user()->hasPermission("delete-user")) {                     
                    $data =  '<div class="col-md-4"><form action="' . route('user.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                            
                        }
                
                    return $data;
                }
                                               
            })
            ->rawColumns(['role', 'status', 'action'])
            ->toJson();
    }
    return abort(404);
    }
}
