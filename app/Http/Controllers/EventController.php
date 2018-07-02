<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Validator;
use App\Event;

use Calendar;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasPermission("show-user")){  
        $events = Event::get();
        $event_list = [];
        foreach ($events as $key => $event) {
            $event_list[] = Calendar::event(
                $event->event_name . ' / '. $event->event_time,
                true,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date.' +1 day'),
                null,
                    // Add color and link on event
                [
                        'url' => route('events.index')
                ]
            );
        }
        $calendar_details = Calendar::addEvents($event_list); 
        //dd($calendar_details);

        return view('Event.index', compact('calendar_details','events') );
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
        $events = Event::all();
       return view('Event.create', compact('events') );
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
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'event_time' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        if ($validator->fails()) {
            \Session::flash('warnning','Please enter the valid details');
            return Redirect::to('/events')->withInput()->withErrors($validator);
        }

        $event = new Event;
        $event->event_name = $request['event_name'];    
        $event->event_time = $request['event_time'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->save();

        alert()->success("Congrats.!", "Event Added successfully");
        // \Session::flash('success','Event added successfully.');
        return Redirect::to('/events');
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
        $event = Event::findOrFail($id);

        return view("Event.edit", compact("event"));
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
            'event_name' => 'required',
            'event_time' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'

            ]);
        Event::find($id)->update($request->all());
        alert()->success('Successfully', 'Updated Event', 'success');
        return redirect()->route('events.index');
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
            $event = Event::findOrFail($id)->delete();

        alert()->success('Successfully', 'Deleted Event');
            return redirect()->back();
        }else{
            return abort(401);
        }
    }

}
