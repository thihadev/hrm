
@extends ('dashboard')


@section('action-content')

<div class="row">
	
	<div class="col-md-12">
		<h3 class="pull-left">Update Employee Form</h3>
		<div class="pull-right">
            <a class="btn btn-primary" href="{{ route('emp.index') }}"> Back</a>
        </div>
	</div>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
		    <strong>Whoops!</strong> There were some problems with your input.<br><br>
		    <ul>
		        @foreach ($errors->all() as $error)
		        <li>{{ $error }}</li>
		        @endforeach
		    </ul>
		</div>
	@endif
	<form method="post" class="form-horizontal" enctype="multipart/form-data" action="{{ route('emp.update', $employees->id) }}" >
       	{{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
		<div class="profile-img-wrap">
        	<img class="inline-block" src="/photos/{{ $employees->photo }}" >
	        <div class="fileupload btn btn-default">
	            <span class="btn-text">edit</span>
	            <input class="upload" id="photo" name="photo" type="file" value="{{$employees->photo}}">
	        </div>
	    </div>
	    <div class="form-group">
          	<label for="name" class="col-md-4 control-label">Your Name</label>
	        <div class="col-md-6">
	            <input id="name" type="text" class="form-control" name="name" value="{{$employees->name}}" required autofocus>
	        </div>
        </div>
        <div class="form-group">
          	<label for="email" class="col-md-4 control-label">Your Email</label>

	        <div class="col-md-6">
	            <input id="email" type="email" class="form-control" name="email" value="{{ $employees->email}}" required>
	        </div>
        </div>
        <div class="form-group">
          <label for="gender" class="col-md-4 control-label">Gender</label>

          <div class="col-md-6">
            <select class="form-control" id="gender" name="gender">
              	<option value="">-- Select Gender --</option>
              	<option {{ $employees->gender =='male' ? 'selected':'' }} value="male"  >Male</option>
				        <option {{ $employees->gender == 'female' ? 'selected':'' }} value="female"  >Female</option> 
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="nrc" class="col-md-4 control-label">Your NRC</label>

          <div class="col-md-6">
            <input id="nrc" type="nrc" class="form-control" name="nrc" value="{{ $employees->nrc }}" required>
          </div>
        </div>

        <div class="form-group">
          	<label for="phone" class="col-md-4 control-label">Your Phone </label>

	        <div class="col-md-6">
	            <input id="phone" type="text" class="form-control" name="phone" value="{{ $employees->phone}}" required>
	        </div>
        </div>
       	<div class="form-group">
          	<label for="address" class="col-md-4 control-label">Address</label>
          	<div class="col-md-6">
            	<input id="address" type="text" class="form-control" name="address" value="{{ $employees->address}}" required>
          	</div>
        </div>
        <div class="form-group">
          	<label class="col-md-4 control-label">Birthday</label>
	        <div class="col-md-6">
	            <div class="input-group date">
	              <div class="input-group-addon">
	                <i class="fa fa-calendar"></i>
	              </div>
	              <input type="date" value="{{ $employees->dateofbirth}}" name="dateofbirth" class="form-control pull-right" id="dateofbirth" required>
	            </div>
	        </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Department</label>
          <div class="col-md-6">
            <select class="form-control" name="department_id">
     		@foreach ($departments as $department)
              <option {{$employees->department_id == $department->id ? 'selected' : ''}} value="{{$department->id}}">{{$department->name}}</option>
               @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          	<label class="col-md-4 control-label">Designation</label>
	        <div class="col-md-6">
	            <select class="form-control" name="designation_id">
	              @foreach ($designations as $designation)
	              <option {{ $employees->designation_id == $designation->id ? 'selected' : ''}} value="{{$designation->id}}">{{$designation->name}}</option>
	              @endforeach
	            </select>
	        </div>
        </div>
        <div class="form-group">
          	<label class="col-md-4 control-label">Joined Date</label>
          	<div class="col-md-6">
	            <div class="input-group date">
	              <div class="input-group-addon">
	                <i class="fa fa-calendar"></i>
	              </div>
	              <input type="date" value="{{$employees->joined}}" name="joined" class="form-control pull-right" id="joined" required>
	            </div>
          	</div>
        </div>

        <div class="form-group">
          <label for="salary" class="col-md-4 control-label">Your Salary</label>

          <div class="col-md-6">
            <input id="salary" type="salary" class="form-control" name="salary" value="{{$employees->salary }}" required>
          </div>
        </div>

		<div class="col-md-12 text-center">
          <button type="submit" class="btn btn-primary">
            Update
          </button>
        </div>

    </form>



</div>

@endsection

