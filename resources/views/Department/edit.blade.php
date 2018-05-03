@extends ('dashboard')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit department</div>
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
<form class="form-horizontal" role="form" method="POST" action="{{ route('dep.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Department Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
							@foreach ($departments as $department)
                                    <span class="help-block">
                                        <strong>{{ $department->name }}</strong>
                                    </span>
							@endforeach
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

@endsection