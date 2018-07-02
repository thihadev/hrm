@extends ('dashboard')

@section('action-content')

<div class="row">
    <div class="col-md-11">
        <div class="box box-success">
            <div class="panel">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"> Edit Payroll</span>
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
<form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('payroll.update', $payrolls->id) }}">
          {{csrf_field()}}
          <input name="_method" type="hidden" value="PATCH">
       <div class="form-group">
          <label class="col-md-4 control-label">Employee Name</label>
          <div class="col-md-5">
            <select class="form-control" id="employee_id" value="{{$payrolls->employee_id}}" name="employee_id">
              @foreach ($employees as $emp)
              <option {{$payrolls->employee_id == $emp->id ? 'selected' : ''}} value="{{$emp->id}}">{{$emp->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

			<div class="form-group">
				<label class="control-label col-md-4" for="over_time">Overtime:</label>
				<div class="col-md-5">
					<select name="over_time" id="over_time" class="form-control">
						<option {{ $payrolls->over_time == '1' ? 'selected':''}} value="1"> Yes </option>
						<option {{ $payrolls->over_time == '0' ? 'selected':'' }} value="0"> No </option>					
					</select>
				</div>
			</div>

        	<div class="form-group">
				<label class="control-label col-md-4" for="hours">Hours: </label>
				<div class="col-md-5">					
					<input type="number" value="{{$payrolls->hours}}" name="hours" id="hours" class="form-control">		
				</div>
			</div>
                                            
       		<div class="form-group">
				<label class="control-label col-md-4" for="rate">Rate: </label>
				<div class="col-md-5">
					<input type="number" value="{{$payrolls->rate}}" name="rate" id="rate" class="form-control">	
				</div>
			</div>	


            <div class="col-md-5"></div>
                <button type="submit" class="btn btn-success" >Update</button>
                <a href="{{ route('payroll.index')}}" class="btn btn-danger">Cancel</a>
                           
            </form>
        </div>
    </div>
</div> 
</div>  



@endsection
