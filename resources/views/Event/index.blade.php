@extends('dashboard')
@section('page-style-files')

<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }} ">
<link rel="stylesheet" type="text/css" href="{{ asset('css/hrm.css') }} ">
<link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}"/>
 <script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection

@section('action-content')

<div class="col-md-10">
      @if(Auth::user()->hasPermission('show-user'))
        <div class="panel panel-primary">
 
          <div class="panel-heading"> Event Calendar Create Form</div><br/>
          <div class="col-xs-1">
              <a href="{{route('events.create')}}">
                  <button class="btn btn-primary">
                    Create Event
                  </button>
              </a>
            </div><br/><br/>    
      <div class="panel-body">    
          <table class="table table-bordered" style="width: 100%; text-align: center;">
          <thead>
            <tr>  
              <th>Event Name</th>   
              <th>Event Time</th>
              <th>Start Date</th>
              <th>End Date</th>
                @if(Auth::user()->hasPermission("update-info") OR Auth::user()->hasPermission("delete-info"))
              <th>Action</th>
                @endif
              
            </tr>
          </thead>
          <tbody>
            @foreach($events as $evt)
              <tr>
                <td>{{ $evt->event_name }}</td>
                <td>{{ $evt->event_time }}</td>
                <td>{{ $evt->start_date }}</td>
                <td>{{ $evt->end_date }}</td>
                
                <td>@if(Auth::user()->hasPermission("update-info"))
                  <div class="col-md-3">
                    <a href="{{ route('events.edit', $evt->id) }}">
                      <button class="btn btn-success"><i class="fa fa-pencil"> Edit </i></button></a></div>
                      @endif
                      @if(Auth::user()->hasPermission("delete-info"))
                      <div class="col-md-1">
                      <form action="{{route('events.destroy', $evt->id)}}" method="post">
                                {{csrf_field()  }} 
                                {{ method_field("delete")}} 
                        <button class="btn btn-danger" ><i class="fa fa-trash-o"> Delete </i></button>
                      </form></div>
                      @endif
                </td>
                
              </tr>
              @endforeach
          </tbody>
          </table>
        </div>

            </div>
              <div class="panel panel-primary">
              <div class="panel-heading">HRM Event Details</div>
              <div class="panel-body" >
                 
                  {!! $calendar_details->calendar() !!}
                  {!! $calendar_details->script() !!}
                 
              </div>
            </div>
                    
            </div>
              
        </div>
        @else
        <div class="alert alert-danger alert-dismissible alert-important" role="alert">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>

        <h1>Your are unauthorized for this Page!</h1>

        </div>

        
      @endif
</div>

@endsection
<!-- Scripts -->
@section('page-js-files')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@stop