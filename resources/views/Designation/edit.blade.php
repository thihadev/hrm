@extends ('dashboard')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Designation</div>
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
<form class="form-horizontal" role="form" method="POST" action="{{ route('des.update', $designations->id) }}">
                        {{ csrf_field() }}
    <input name="_method" type="hidden" value="PATCH">                       
        <div class="form-group">
            <label for="name" class="col-md-4 control-label">Designation Name</label>
          <div class="col-md-6">
              <input id="name" type="text" class="form-control" name="name" value="{{ $designations->name}}" required autofocus>
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