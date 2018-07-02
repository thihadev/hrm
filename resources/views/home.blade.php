@extends('dashboard')
@section('page-style-files')
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }} "> -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/hrm.css') }} ">
<link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}"/>
 <script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection
@section('action-content')

@if(Auth::user()->hasPermission('show-user'))
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{ $employees }}</h3>

              <p>Employees</p>
            </div>
            <div class="icon">
              <i class="fa fa-group"></i>
            </div>
            <a href="{{route('emp.index')}}" class="small-box-footer">
              More info <i class="fa fa-plus-circle"></i>
            </a>
          </div>
        </div>
   
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $users }}</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('user.index') }}" class="small-box-footer">
              More info <i class="fa fa-plus-circle"></i>
            </a>
          </div>
        </div>

         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $clients }}</h3>

              <p>Clients</p>
            </div>
            <div class="icon">
              <i class="fa fa-handshake-o"></i>
            </div>
            <a href="{{ route('client.index') }}" class="small-box-footer">
              More info <i class="fa fa-plus-circle"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $payrolls }}</h3>

              <p>Payroll</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="{{ route('payroll.index') }}" class="small-box-footer">
              More info <i class="fa fa-plus-circle"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <h3>{{ $deparments }}</h3>

              <p> Departments </p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ route('dep.index') }}" class="small-box-footer">
              More info <i class="fa fa-plus-circle"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>{{ $designations }}</h3>

              <p> Designations </p>
            </div>
            <div class="icon">
              <i class="fa fa-sitemap"></i>
            </div>
            <a href="{{ route('des.index') }}" class="small-box-footer">
              More info <i class="fa fa-plus-circle"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $projects }}</h3>

              <p> Projects </p>
            </div>
            <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            <a href="{{route('project.index')}}" class="small-box-footer">
              More info <i class="fa fa-plus-circle"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-black">
            <div class="inner">
              <h3>{{ $co }}</h3>

              <p> Events </p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="{{route('events.index')}}" class="small-box-footer">
              More info <i class="fa fa-plus-circle"></i>
            </a>
          </div>
        </div>
        @endif

      </div>
      <!-- /.row -->
      
      <div class="row">
        <div class="panel panel-primary">
         <div class="panel-body">
          <h1>Notice board </h1>
          @foreach($posts as $post)
          <h2>
            <a href="{{ route('noticeboard.show', $post->id) }}">
              {{ ++$i }} / Title : {{ $post->title }}
            </a>
            </h2>
          @endforeach
          </div>
        </div>
        {!! $posts->links() !!}
      </div>
      <div class="row">
      
          <div class="panel panel-primary">
              <div class="panel-heading">HRM Event Details</div>
              <div class="panel-body" >
                 
                  {!! $calendar_details->calendar() !!}
                  {!! $calendar_details->script() !!}
                 
              </div>
            </div>
       </div>
@endsection

<!-- Scripts -->
@section('page-js-files')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@stop
