@extends('dashboard')


@section('action-content')

<div class="col-md-10">

        <div class="panel panel-primary">
 
          <div class="panel-heading"> HRM Company Infomation </div><br/>

      <div class="panel-body">    
          <table class="table table-bordered" style="width: 100%; text-align: center;">
          <thead >
            <tr>  
              <th class="text-center">Company Name</th>   
              <th class="text-center">Company Address</th>
              <th class="text-center">Contact</th>
              <th class="text-center">About</th>         
            </tr>
          </thead>
          <tbody>
            @foreach($settings as $set)
              <tr>

                <td>{{ $set->name }}</td>
                <td>{{ $set->address }}</td>
                <td>{{ $set->contact }}</td>
                <td>{{ $set->about }}</td>
                <td>
                  <a href="{{route('setting.edit', $set->id )}}">
                  <button class="btn btn-info">
                    Edit Setting
                  </button>
              </a>
                </td>
              </tr>
              @endforeach 
          </tbody>
          </table>
          <div class="col-md-2">
            
              <a href="{{route('setting.create')}}">
                  <button class="btn btn-primary">
                    Create Setting
                  </button>
              </a>
            </div>
            <div class="col-md-1">
              
            </div><br/><br/>               
        </div>
    </div>            
</div>
              


@endsection
