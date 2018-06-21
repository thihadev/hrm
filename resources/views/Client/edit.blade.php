@extends ('dashboard')

@section('action-content')
<div class="container">
    <div class="row">
        
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Client</div>
                <div class="panel-body">
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
    <form class="form-horizontal" role="form" method="POST" action="{{ route('client.update', $clients->id) }}">
                        {{ csrf_field() }}
    <input name="_method" type="hidden" value="PATCH">                       
        <div class="form-group">
            <label for="c_name" class="col-md-4 control-label">Client Name</label>
          <div class="col-md-6">
              <input id="c_name" type="text" class="form-control" name="c_name" value="{{ $clients->c_name }}" required autofocus>
          </div>
        </div>
            <div class="form-group">
            <label for="c_email" class="col-md-4 control-label">Client Email</label>
          <div class="col-md-6">
              <input id="c_email" type="text" class="form-control" name="c_email" value="{{ $clients->c_email }}" required autofocus>
          </div>
        </div>

            <div class="form-group">
            <label for="c_phone" class="col-md-4 control-label">Client Phone</label>
          <div class="col-md-6">
              <input id="c_phone" type="text" class="form-control" name="c_phone" value="{{ $clients->c_phone }}" required autofocus>
          </div>
        </div>

            <div class="form-group">
            <label for="c_address" class="col-md-4 control-label">Client Address</label>
          <div class="col-md-6">
              <input id="c_address" type="text" class="form-control" name="c_address" value="{{ $clients->c_address }}" required autofocus>
          </div>
        </div>

            <div class="form-group">
            <label for="c_web" class="col-md-4 control-label">Client Website</label>
          <div class="col-md-6">
              <input id="c_web" type="text" class="form-control" name="c_web" value="{{ $clients->c_web }}" required autofocus>
          </div>
        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection