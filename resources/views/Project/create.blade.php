@extends ('dashboard')

@section('action-content')

	<h1>Hello from Project </h1>
	<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Project</div>
                <div class="panel-body">

		
		<form action="{{ route('project.store')}}" method="POST"
			class="form-horizontal">
				{{ csrf_field() }}
			
		<div class="form-group{{ $errors->has('p_name') ? ' has-error' : '' }}">
          <label for="p_name" class="col-md-4 control-label">Project Name</label>

          <div class="col-md-5">
            <input id="p_name" type="text" class="form-control" name="p_name" value="{{ old('p_name') }}" placeholder="Project Name" required autofocus>

            @if ($errors->has('p_name'))
            <span class="help-block">
              <strong>{{ $errors->first('p_name') }}</strong>
            </span>
            @endif
          </div>
        </div>

			<div class="form-group{{ $errors->has('client_id') ? ' has-error' : '' }}">
	          <label class="col-md-4 control-label">Client</label>
	          <div class="col-md-5">
	            <select class="form-control" name="client_id">
	              @foreach ($clients as $client)
	              <option value="{{ $client->id }}">{{ $client->c_name }}</option>
	              @endforeach
	            </select>
	            @if ($errors->has('client_id'))
	            <span class="help-block">
	              <strong>{{ $errors->first('client_id') }}</strong>
	            </span>
	            @endif
	          </div>
	        </div>

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
            <label class="col-md-4 control-label">Start Date</label>
                <div class="col-md-5">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" value="{{ old('start_date') }}" name="start_date" class="form-control pull-right" id="start_date" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
            <label class="col-md-4 control-label">Deadline Date</label>
                <div class="col-md-5">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" value="{{ old('end_date') }}" name="end_date" class="form-control pull-right" id="end_date" required>
                    </div>
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