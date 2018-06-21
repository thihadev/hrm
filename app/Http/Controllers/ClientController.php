<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Session;

class ClientController extends Controller
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
            $clients = Client::select('id')->get(); 
            return view("Client.index", compact('clients'));
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
        $clients = Client::all();
        return view("Client.create", compact("clients"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clients = new Client();
        $clients->c_name = $request->c_name;
        $clients->c_email = $request->c_email;
        $clients->c_phone = $request->c_phone;
        $clients->c_address = $request->c_address;
        $clients->c_web = $request->c_web;
        $clients->save();
        alert()->success('Successfully', 'New Client Added', 'success');
        // Session::flash('message', "Successfully add new Client");

        return view('Client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = Client::find($id);
        return view("Client.edit", compact("clients"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'c_name' => 'required',
            'c_email' => 'required',
            'c_phone' => 'required',
            'c_address' => 'required',
            'c_web' => 'required'
        ]);
        Client::find($id)->update($request->all());

        alert()->success('Successfully', ' Updated Client', 'success');
        // Session::flash('message', 'You have successfully updated Client.'); 
         return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clients = Client::find($id)->delete();

        alert()->success('Successfully', 'Client Deleted', 'success');
        // Session::flash('danger', 'Your Client Info Deleted Successfully!');
        return redirect()->route('client.index');
                        
    }

    private function validateInput($request) {
        $this->validate($request, [
        'c_name' => 'required',
        'c_email' => 'required',
        'c_phone' => 'required',
        'c_address' => 'required',
        'c_web' => 'required'

        ]);
    }


    public function data(Request $request) {

        if($request->ajax()) {

            $model = Client::latest();

            return Datatables::of($model)
                ->addColumn("action", function($model) {
            if(Auth::user()->hasPermission("update-info") || Auth::user()->hasPermission("delete-info"))
            {
            if(Auth::user()->hasPermission("update-info") && Auth::user()->hasPermission("delete-info"))
              {
                    $data = '<div class="col-md-3"><a href="'.route("client.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div><div class="col-md-1"><form class="del" action="' . route('client.destroy', $model->id). '" method="post">'
                                . csrf_field() .
                                 method_field("delete") .
                                '<button class="btn btn-danger" ><i class="fa fa-trash-o"></i></button>
                            </form></div>';
                }
            else if(Auth::user()->hasPermission("update-info")) {
                    $data = '<div class="col-md-3"><a href="'.route("client.edit", $model->id).'"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></div>';
                }
            else if(Auth::user()->hasPermission("delete-info")) {                     
                    $data =  '<div class="col-md-1"><form id="delete-btn" action="' . route('client.destroy', $model->id). '" method="post">'
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
