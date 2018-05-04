@extends ('dashboard')

@section('action-content')
<div class="row">
  <div class="col-md-12">
    <!-- <div class="panel panel-default"> -->
      <!-- <div class="panel-heading">Add new employee</div> -->
      <!-- <div class="panel-body"> -->
        <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('emp.store') }}">
          {{csrf_field()}}
          <input name="_method" type="hidden" value="PATCH">
          <div class="profile-img-wrap">
           <img class="inline-block" src="../img/user.jpg" >
           <div class="fileupload btn btn-default">
            <span class="btn-text">edit</span>
            <input class="upload" id="photo" name="photo" type="file" required>
          </div>
        </div>

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label for="name" class="col-md-4 control-label">Your Name</label>

          <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
            <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">Your Email</label>

          <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
        </div>



        <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
          <label for="age" class="col-md-4 control-label">Age</label>

          <div class="col-md-6">
            <input id="age" type="text" class="form-control" name="age" value="{{ old('age') }}" required>

            @if ($errors->has('age'))
            <span class="help-block">
              <strong>{{ $errors->first('age') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
          <label for="phone" class="col-md-4 control-label">Your Phone </label>

          <div class="col-md-6">
            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

            @if ($errors->has('phone'))
            <span class="help-block">
              <strong>{{ $errors->first('phone') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
          <label for="address" class="col-md-4 control-label">Address</label>

          <div class="col-md-6">
            <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>

            @if ($errors->has('address'))
            <span class="help-block">
              <strong>{{ $errors->first('address') }}</strong>
            </span>
            @endif
          </div>
        </div>


        <div class="form-group">
          <label class="col-md-4 control-label">Birthday</label>
          <div class="col-md-6">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="date" value="{{ old('dateofbirth') }}" name="dateofbirth" class="form-control pull-right" id="dateofbirth" required>
            </div>
          </div>
        </div>

        <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Department</label>
          <div class="col-md-6">
            <select class="form-control" name="department_id">
              @foreach ($departments as $department)
              <option value="{{$department->id}}">{{$department->name}}</option>
              @endforeach
            </select>
            @if ($errors->has('department_id'))
            <span class="help-block">
              <strong>{{ $errors->first('department_id') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('designation_id') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Designation</label>
          <div class="col-md-6">
            <select class="form-control" name="designation_id">
              @foreach ($designations as $designation)
              <option value="{{$designation->id}}">{{$designation->name}}</option>
              @endforeach
            </select>
            @if ($errors->has('designation_id'))
            <span class="help-block">
              <strong>{{ $errors->first('designation_id') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Joined Date</label>
          <div class="col-md-6">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="date" value="{{ old('joined') }}" name="joined" class="form-control pull-right" id="joined" required>
            </div>
          </div>
        </div>


        <div class="col-md-6 col-md-offset-4">
          <button type="submit" class="btn btn-primary">
            Create
          </button>
        </div>
      </form>
    </div>
  </div>


  @endsection
