@extends('dashboard')

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
            <a href="{{route('register') }}" class="small-box-footer">
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
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-plus-circle"></i>
            </a>
          </div>
        </div>
        @endif
       
      </div>
      <!-- /.row -->
@endsection
