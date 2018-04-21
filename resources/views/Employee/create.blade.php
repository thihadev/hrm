@extends ('layouts.admindashboard')

@section('content')
<div class="container">
    <div class="row">
       <!--  <form class="form-horizontal" method="POST" action="{{ route('emp.store') }}">
                        {{ csrf_field() }}
        <div class="form-group">
  <label class="col-md-3 control-label">Browse</label>  
        <div class="row justify-content-center">
            <form method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <input  type="file" class="img-thumbnail" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                </div>
            </form>
          </div>
        </div>

<div class="form-group">
  <label class="col-md-3 control-label">Your Name</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="name" placeholder="Your Name" class="form-control" id="name" type="text" value="{{ old('name')}}">  
    </div>
  </div>
</div>


       <div class="form-group">
  <label class="col-md-3 control-label">E-Mail</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="email" placeholder="E-Mail Address" class="form-control" id="email" type="email" value="{{ old('email')}}">
    </div>
  </div>
</div>

 <div class="form-group">
  <label class="col-md-3 control-label" >Password</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input name="password" placeholder="Password" class="form-control"  type="password">
    </div>
  </div>
</div> 



 <div class="form-group">
  <label class="col-md-3 control-label" >Confirm Password</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input name="confirm_password" placeholder="Confirm Password" class="form-control"  type="password">
    </div>
  </div>
</div> 


<div class="form-group">
  <label class="col-md-3 control-label">Age</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input  name="age" placeholder="Your Age" class="form-control" id="age" value="{{ old('age')}}" type="text">
    </div>
  </div>
</div>

       
<div class="form-group">
  <label class="col-md-3 control-label">Contact No.</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
  <input name="phone" placeholder="(09-)" class="form-control" id="phone" value="{{ old('phone')}}" >
    </div>
  </div>
</div>



<div class="form-group">
  <label class="col-md-3 control-label">Address</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
  <input  name="address" placeholder="Your address" class="form-control" value="{{ old('address')}}" id="address" type="text">
    </div>
  </div>
</div>


<div class="form-group">
  <label class="col-md-3 control-label">Date of Birth</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
  <input  name="dateofbirth" placeholder="Your birth" value="{{ old('dateofbirth')}}" class="form-control" id="dateofbirth" type="date">
    </div>
  </div>
</div>



<div class="form-group"> 
  <label class="col-md-3 control-label">Department / Office</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    <select name="department_id"  class="form-control selectpicker">
                <option>Select your Department/Office</option>
           @foreach ($departments as $department)

        <option value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
    </select>
  </div>
</div>
</div>


<div class="form-group"> 
  <label class="col-md-3 control-label">Designation / Position</label>
    <div class="col-md-4 selectContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
    <select name="designation_id"  class="form-control selectpicker">
              <option>Select your Designation/Position</option>
        @foreach ($designations as $designation)

      <option value="{{$designation->id}}">{{$designation->name}}</option>
        @endforeach
    </select>
  </div>
</div>
</div>



<div class="form-group">
  <label class="col-md-3 control-label">Joined</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
  <input  name="joined" placeholder="Your address" value="{{ old('joined')}}" class="form-control" id="joined" type="date">
    </div>
  </div>
</div>

<div class="col-md-6 col-md-offset-4">
    <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
</div>
</form> -->
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new employee</div>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('emp.store') }}">
                        {{ csrf_field() }}
                        <div class="profile-img-wrap">
							<img class="inline-block" src="../img/user.jpg" >
								<div class="fileupload btn btn-default">
										<span class="btn-text">edit</span>
									<input class="upload" id="avatar" name="avatar" type="file" required>
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

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirm" required>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection