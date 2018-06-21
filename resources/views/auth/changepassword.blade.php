@extends('layouts.login')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Change password</div>
 
                <div class="panel-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
        <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                        {{ csrf_field() }}
 
                        <div class="form-group row{{ $errors->has('current-password') ? ' has-error' : '' }}">
                    <!--         <label for="new-password" class="col-md-4 control-label">Current Password</label> -->
 
                            <div class="col-12">
                                <input id="current-password" type="password" class="form-control" name="current-password" placeholder="Current Password" required>
 
                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 
                        <div class="form-group row{{ $errors->has('new-password') ? ' has-error' : '' }}">
          <!--                   <label for="new-password" class="col-md-4 control-label">New Password</label> -->
 
                            <div class="col-12">
                                <input id="new-password" type="password" class="form-control" name="new-password" placeholder="New Password" required>
 
                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 
                        <div class="form-group row">
              <!--               <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label> -->
 
                            <div class="col-12">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" placeholder="Confirm New Password" required>
                            </div>
                        </div>
 
                        <div class="form-group">
                            <div class="col-md-6 pull-left">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                            <div class="col-md-5 pull-right">
                                <a href="{{ route('home') }}" type="reset" class="btn btn-danger"> Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection