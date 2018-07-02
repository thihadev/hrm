@extends ('dashboard')

@section('action-content')

<div class="row">
    <div class="col-md-11">
        <div class="box box-success">
            <div class="panel">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"> Edit Attendance </span>
        </div>

      
            @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!!</strong> There were some problems with your input.<br>
                            <ul>
                                @foreach ($error->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('attendance.update', $attends->id) }}">
          {{csrf_field()}}
          <input name="_method" type="hidden" value="PATCH">
       <div class="form-group">
          <label class="col-md-4 control-label">Employee Name</label>
          <div class="col-md-4">
            <select class="form-control" id="att_employee_id" value="{{ $attends->att_employee_id }}" name="att_employee_id">
              @foreach ($employees as $emp)
              <option {{$attends->att_employee_id == $emp->id ? 'selected' : ''}} value="{{$emp->id}}">{{$emp->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label"> Date </label>
                <div class="col-md-4">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" value="{{ $attends->att_date }}" name="att_date" class="form-control pull-right" id="att_date" required>
                    </div>
                </div>
            </div>

    			<div class="form-group">
    				<label class="control-label col-md-4" for="attend">Attend</label>
    				<div class="col-md-4">
    					<select name="attend" id="attend" class="form-control">
    						<option {{ $attends->attend == '1' ? 'selected':''}} value="1"> Present </option>
    						<option {{ $attends->attend == '0' ? 'selected':'' }} value="0"> Absent </option>					
    					</select>
    				</div>
    			</div>



            <div class="col-md-5"></div>
                <button type="submit" class="btn btn-success" >Update</button>
                <a href="{{ route('attendance.index')}}" class="btn btn-danger">Cancel</a>
                           
            </form>
        </div>
    </div>
  </div> 
</div>  



@endsection
