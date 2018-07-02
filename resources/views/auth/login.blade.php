@extends('layouts.login')

@section('content')

    <form class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
        <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input id="email" name="email" class="form-control" placeholder="E-Mail" type="text" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('passwordemail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input id="password" name="password" class="form-control" placeholder="Password" type="password" required >
                            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                </div>

                
                <div class="form-group row text-left">
                    <div class="col-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-right">
                    <div class="col-md-12">
                        <button class="btn btn-outline-light" type="submit">Log In
                        </button>
                    </div>
                </div>

                <div class="form-group row m-t-30">
                    <div class="col-sm-7">
                        <a href="http://coderthemes.com/minton/dark/pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your
                            password?</a>
                    </div>
     
                </div>
            </form>

@endsection

