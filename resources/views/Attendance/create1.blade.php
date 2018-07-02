

@extends ('dashboard')

@section('action-content')

<h1>Hello from Attendance </h1>
	<div class="container">
	    <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Add new Attendance</div>
	                <div class="panel-body">

				<p><b>Full-Time</b> : Yes </p>

		
		<form action="{{ route('attendance.store')}}" method="POST"
			class="form-horizontal">
				{{ csrf_field() }}
			
		<div class="form-group{{ $errors->has('att_employee_id') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Employee</label>
          <div class="col-md-5">
            <select class="form-control" name="att_employee_id">
              @foreach ($employees as $employee)
              <option value="{{$employee->id}}">{{$employee->name}}</option>
              @endforeach
            </select>
            @if ($errors->has('att_employee_id'))
            <span class="help-block">
              <strong>{{ $errors->first('att_employee_id') }}</strong>
            </span>
            @endif
          </div>
        </div>

         <div class="form-group">
            <label class="col-md-4 control-label"> Date</label>
                <div class="col-md-5">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" value="{{ old('att_date') }}" name="att_date" class="form-control pull-right" id="att_date" required>
                    </div>
                </div>
            </div>

			<div class="form-group">
				<label class="control-label col-md-4" for="attend">Attendance </label>
				<div class="col-md-5">
					<select name="attend" id="attend" class="form-control">
						<option value="1"> Present </option>
						<option value="0"> Absent </option>					
					</select>
				</div>
			</div>
			
			
			<div class="col-md-13 text-center">
				<button class="btn btn-success" type="submit" >Submit</button>
			</div>
		</form> 
	</div>
</div>
</div>
</div>
</div>

@endsection