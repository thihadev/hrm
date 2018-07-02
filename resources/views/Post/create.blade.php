@extends('dashboard')

@section('action-content')

    <div class="col-md-8">
        <div class="panel-heading">
            <h1 > Add Notice Board </h1>
        </div>    
              @if(Session::has('flash_message'))
                  <div class="alert alert-success">
                      {{Session::get('flash_message')}}
                  </div>
              @endif
      <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('noticeboard.store') }}">
            {{csrf_field()}}

        <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
          <label for="author" class="col-md-3 control-label">Written By</label>

          <div class="col-md-6">
            <input id="author" type="text" class="form-control" name="author" value="{{ old('author') }}" placeholder="Author Name" required autofocus>

            @if ($errors->has('author'))
            <span class="help-block">
              <strong>{{ $errors->first('author') }}</strong>
            </span>
            @endif
          </div>
        </div>
       
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
          <label for="title" class="col-md-3 control-label">Title</label>

          <div class="col-md-6">
            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title Name" required autofocus>

            @if ($errors->has('title'))
            <span class="help-block">
              <strong>{{ $errors->first('title') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
          <label for="description" class="col-md-3 control-label">Description</label>

          <div class="col-md-6">
            <textarea id="description" rows="15" type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Description" required autofocus></textarea>

            @if ($errors->has('description'))
            <span class="help-block">
              <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
          </div>
        </div>
                                            
        <div class="col-md-5"></div>
              <button type="submit" class="btn btn-success" >Submit</button>
              <button type="reset" class="btn btn-danger" >Reset</button>
                           
    </form>
</div>



@endsection
