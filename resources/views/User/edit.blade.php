@extends ('dashboard')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit User</div>
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
        <form class="form-horizontal" role="form" method="POST" action="{{ route('user.update', $users->id) }}">
                        {{ csrf_field() }}
    <input name="_method" type="hidden" value="PATCH">                       
        <div class="form-group">
            <label for="name" class="col-md-4 control-label">User Name</label>
          <div class="col-md-6">
              <input id="name" type="text" class="form-control" name="name" value="{{ $users->name}}" required autofocus>
          </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-md-4 control-label">User Email </label>

            <div class="col-md-6">
                <input id="email" type="text" class="form-control" name="email" value="{{ $users->email}}" required>
            </div>
        </div>
         <div class="form-group">
            <label for="role" class="col-md-4 control-label">Role Permission</label>
                <div class="col-md-6">
                    @foreach($userRole as $u)
                          <?php $userRole = $u->role_id; ?>
                        @endforeach
                      <select id="role" type="text" class="form-control" name="role" required autofocus>

                            @foreach($roles as $role)
                            @if($role->id == $userRole)
                              <option value="{{$role->id}}" selected="selected"> {{$role->name}}</option>
                              @else
                              <option value="{{$role->id}}"> {{$role->name}}</option>
                              @endif
                            @endforeach
                      </select>

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