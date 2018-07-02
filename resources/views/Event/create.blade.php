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
 
                   {!! Form::open(array('route' => 'events.store','method'=>'POST','files'=>'true')) !!}
                    <div class="row">

 
                      <div class="col-xs-4 col-sm-4 col-md-3">
                        <div class="form-group">
                            {!! Form::label('event_name','Event Name:') !!}
                            <div class="">
                            {!! Form::text('event_name', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('event_name', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                      </div>

                      <div class="col-xs-4 col-sm-4 col-md-3">
                        <div class="form-group">
                          {!! Form::label('event_time','Event Time :') !!}
                          <div class="">
                          {!! Form::time('event_time', null, ['class' => 'form-control']) !!}
                          {!! $errors->first('event_time', '<p class="alert alert-danger">:message</p>') !!}
                          </div>
                        </div>
                      </div>
 
                      <div class="col-xs-4 col-sm-4 col-md-3">
                        <div class="form-group">
                          {!! Form::label('start_date','Start Date:') !!}
                          <div class="">
                          {!! Form::date('start_date', null, ['class' => 'form-control pull-right']) !!}
                          {!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
                          </div><br/>
                        </div>
                      </div>
 
                      <div class="col-xs-4 col-sm-4 col-md-3">
                        <div class="form-group">
                          {!! Form::label('end_date','End Date:') !!}
                          <div class="">
                          {!! Form::Date('end_date', null, ['class' => 'form-control pull-right']) !!}
                          {!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}
                          </div>
                        </div>
                      </div>
 
                      <div class="col-xs-2 col-sm-2 col-md-offset-5"> &nbsp;<br/>
                      {!! Form::submit('Add Event',['class'=>'btn btn-primary']) !!}
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