@extends('dashboard')
@section('page-style-files')

<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }} ">
<link rel="stylesheet" type="text/css" href="{{ asset('css/hrm.css') }} ">
<link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}"/>
 <script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection

@section('action-content')
      <div class="container">
          <div class="row">
               <div class="col-md-10">
                @if(Auth::user()->hasPermission('show-user'))
            <div class="panel panel-primary">
 
             <div class="panel-heading"> Event Calendar Create Form</div>
 
             
                  <div class="panel-body">    
 
                  <form class="form-group" method="POST" action="{{ route('events.update', $event->id) }}">
                        {{ csrf_field() }}
                  <input name="_method" type="hidden" value="PATCH">  
                    <div class="row">
 
                      <div class="col-xs-4 col-sm-4 col-md-3">
                        <div class="form-group">
                            {!! Form::label('event_name','Event Name:') !!}
                            <div class="">
                            <input id="event_name" type="text" class="form-control" name="event_name" value="{{ $event->event_name }}" placeholder="Event Name" required autofocus>
                            {!! $errors->first('event_name', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                      </div>

                      <div class="col-xs-4 col-sm-4 col-md-3">
                        <div class="form-group">
                          {!! Form::label('event_time','Event Time :') !!}
                          <div class="">
                          <input type="time" value="{{ $event->event_time }}" name="event_time" class="form-control" id="event_time" required>
                          {!! $errors->first('event_time', '<p class="alert alert-danger">:message</p>') !!}
                          </div>
                        </div>
                      </div>
 
                      <div class="col-xs-4 col-sm-4 col-md-3">
                        <div class="form-group">
                          {!! Form::label('start_date','Start Date:') !!}
                          <div class="">
                          <input type="date" value="{{ $event->start_date }}" name="start_date" class="form-control pull-right" id="start_date" required>
                          {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                          </div>
                        </div>
                      </div>
 
                      <div class="col-xs-4 col-sm-4 col-md-3">
                        <div class="form-group">
                          {!! Form::label('end_date','End Date:') !!}
                          <div class="">
                          <input type="date" value="{{ $event->end_date }}" name="end_date" class="form-control pull-right" id="end_date" required>
                          {!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}
                          </div>
                        </div>
                      </div>
 
                      <div class="col-xs-2 col-sm-2"> &nbsp;<br/>
                      {!! Form::submit('Update Event',['class'=>'btn btn-primary']) !!}
                      </div>
                        
                    </div>
                  
                   {!! Form::close() !!}
                 </div> 
              </div>    
            @endif
          </div>
        </div>
      </div>



@endsection
<!-- Scripts -->
@section('page-js-files')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@stop