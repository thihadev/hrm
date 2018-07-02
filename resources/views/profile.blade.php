@extends('dashboard')

@section('action-content')
@if(Auth::user()->is_admin)
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
                
              </tr>
              @endforeach
          </tbody>
          </table>
        </div>

    </div>
            
</div>
@else
    <div class="row">@foreach ($employees as $employee)
        <div class="col-md-12">           
            <img type="file" name="photo"  src="/photos/{{ $employee->photo }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px; margin-top: 20px;" />
            <div class="col-md-3 pull-right" style="margin-top: 20px; margin-right: 20px;">
                <div class="small-box bg-black">
                    <div class="inner datebar" align="center">
                        <p style="color:ghostwhite">{{\Carbon\Carbon::now()->format('l, jS \\of F, Y')}}</p>
                        <h3 style="color: ghostwhite" id="clock"></h3>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    
                <div class="panel-heading">
                    <span class="panel-title"><h3> Name : {{ $employee->name }}</h3></span>
                </div>
 
                    <div style="margin-left: 20px; margin-bottom: 30px;">
                        <p><h4>Department : {{ $employee->department_name}}</h4></p>
                        <p><h4>Address : {{ $employee->address}}</h4></p>
                    </div>
     

            <div class="col-md-6">
                <div class="box box-success">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">Personal Details</span>
                        </div>
                        <div class="panel-body pn pb5">
                            <hr class="short br-lighter">
                            <div class="box-body no-padding">

                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td style="width: 10px" class="text-center"><i class="fa fa-birthday-cake"></i>
                                        </td>
                                        <td><strong>Birthday</strong></td>
                                        <td>{{$employee->dateofbirth}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10px" class="text-center"><i class="fa fa-genderless"></i>
                                        </td>
                                        <td><strong>Gender</strong></td>
                                        <td>{{ $employee->gender }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10px" class="text-center"><i class="fa fa-mobile-phone"></i>
                                        </td>
                                        <td><strong>Phone</strong></td>
                                        <td>{{ $employee->phone }}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">Employment Details</span>
                        </div>
                        <div class="panel-body pn pb5">
                            <hr class="short br-lighter">
                            <div class="box-body no-padding">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td style="width: 10px" class="text-center"><i class="fa fa-key"></i></td>
                                        <td><strong>Employee ID</strong></td>
                                        <td>{{ $employee->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fa fa-briefcase"></i></td>
                                        <td><strong>Department</strong></td>
                                        <td>{{ $employee->department_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fa fa-cubes"></i></td>
                                        <td><strong>Designation</strong></td>
                                        <td>{{ $employee->designation_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fa fa-calendar"></i></td>
                                        <td><strong>Date Joined</strong></td>
                                        <td>{{ $employee->joined }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fa fa-credit-card"></i></td>
                                        <td><strong>Salary</strong></td>
                                        <td>{{ $employee->salary }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach 
    @endif

    


@endsection
@push('scripts')
<script type="text/javascript">
    function startTime() {
        var today = new Date(),
                curr_hour = today.getHours(),
                curr_min = today.getMinutes(),
                curr_sec = today.getSeconds();
        curr_hour = checkTime(curr_hour);
        curr_min = checkTime(curr_min);
        curr_sec = checkTime(curr_sec);
        document.getElementById('clock').innerHTML = curr_hour + ":" + curr_min + ":" + curr_sec;
    }
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(startTime, 500);
</script>
@endpush
