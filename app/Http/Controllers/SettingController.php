<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Auth;
use DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        // dd($settings);
        return view("Setting.index", compact("settings"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("Setting.create");
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
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'about' => 'required'

        ]);

        $setting = Setting::create($request->all());

        alert()->success('Successfully', 'Setting Created!');
        return redirect()->route('setting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $settings = Setting::find($id);
        return view("Setting.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasPermission("update-info"))
        {   
            $settings = Setting::findOrFail($id);

            return view("Setting.edit", compact("settings"));
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
            'address' => 'required',
            'contact' => 'required',
            'about' => 'required'
            ]);
        Setting::find($id)->update($request->all());
        alert()->success('Successfully', ' Updated Setting Info');
         // Session::flash('message', 'You have successfully updated Product.'); 
         return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
