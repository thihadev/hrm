@extends('dashboard')

@section('action-content')

    <div class="col-md-8">
        <div class="panel-heading">
            <h1 > Edit Notice Board </h1>
        </div>    
              @if(Session::has('flash_message'))
                  <div class="alert alert-success">
                      {{Session::get('flash_message')}}
                  </div>
              @endif
      <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('noticeboard.update', $posts->id) }}">
             {{csrf_field()}}
          <input name="_method" type="hidden" value="PATCH">

        <div class="form-group">
          <label for="author" class="col-md-3 control-label">Written By</label>

          <div class="col-md-6">
            <input id="author" type="text" class="form-control" name="author" value="{{ $posts->author }}" placeholder="Author Name" required autofocus>
          </div>
        </div>
       
        <div class="form-group">
          <label for="title" class="col-md-3 control-label">Title</label>

          <div class="col-md-6">
            <input id="title" type="text" class="form-control" name="title" value="{{ $posts->title }}" placeholder="Title Name" required autofocus>
          </div>
        </div>

        <div class="form-group">
          <label for="description" class="col-md-3 control-label">Description</label>
          <div class="col-md-6">
            <textarea id="description" rows="15" type="longtext" class="form-control" name="description" value="" required>{{$posts->description}}</textarea>
          </div>
        </div>
                                            
        <div class="col-md-5"></div>
              <button type="submit" class="btn btn-success" >Update</button>
              <a href="{{route('noticeboard.index')}}" class="btn btn-danger" >Cancel</a>
                           
    </form>
</div>



@endsection
