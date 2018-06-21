@extends ('dashboard')

@section('action-content')

	<h1>Hello from Payroll </h1>
	<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new designation</div>
                <div class="panel-body">

			<p><b>Full-Time</b> : Yes</p>

		
		<form action="{{ route('payroll.store')}}" method="POST"
			class="form-horizontal">
				{{ csrf_field() }}
			
		<div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Employee</label>
          <div class="col-md-5">
            <select class="form-control" name="employee_id">
              @foreach ($employees as $employee)
              <option value="{{$employee->id}}">{{$employee->name}}</option>
              @endforeach
            </select>
            @if ($errors->has('employee_id'))
            <span class="help-block">
              <strong>{{ $errors->first('employee_id') }}</strong>
            </span>
            @endif
          </div>
        </div>
			<div class="form-group">
				<label class="control-label col-md-4" for="over_time">Overtime:</label>
				<div class="col-md-5">
					<select name="over_time" id="over_time" class="form-control">
						<option value="1">Yes</option>
						<option value="0">No</option>					
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-4" for="hours">Hours: </label>
				<div class="col-md-5">					
					<input type="number" name="hours" class="form-control">		
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-4" for="rate">Rate: </label>
				<div class="col-md-5">
					<input type="number" name="rate" class="form-control">	
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