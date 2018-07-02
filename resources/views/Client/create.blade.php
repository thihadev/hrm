@extends ('dashboard')

@section('action-content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Client</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('client.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('c_name') ? ' has-error' : '' }}">
                            <label for="c_name" class="col-md-4 control-label">Client Name</label>

                            <div class="col-md-7">
                                <input id="c_name" type="text" class="form-control" name="c_name" value="{{ old('c_name') }}" required autofocus>

                                @if ($errors->has('c_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('c_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('c_email') ? ' has-error' : '' }}">
                            <label for="c_email" class="col-md-4 control-label">Client Email</label>

                            <div class="col-md-7">
                                <input id="c_email" type="text" class="form-control" name="c_email" value="{{ old('c_email') }}" required autofocus>

                                @if ($errors->has('c_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('c_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('c_phone') ? ' has-error' : '' }}">
                            <label for="c_phone" class="col-md-4 control-label">Client Phone</label>

                        <div class="col-md-7">
                            <input id="c_phone" type="number" class="form-control" name="c_phone" value="{{ old('c_phone') }}" required >

                            @if ($errors->has('c_phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('c_phone') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('c_address') ? ' has-error' : '' }}">
                            <label for="c_address" class="col-md-4 control-label">Client Address </label>

                            <div class="col-md-7">
                                <input id="c_address" type="text" class="form-control" name="c_address" value="{{ old('c_address') }}" required autofocus>

                                @if ($errors->has('c_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('c_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('c_web') ? ' has-error' : '' }}">
                            <label for="c_web" class="col-md-4 control-label">Client website </label>

                            <div class="col-md-7">
                                <input id="c_web" type="text" class="form-control" name="c_web" value="{{ old('c_web') }}" required autofocus>

                                @if ($errors->has('c_web'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('c_web') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
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