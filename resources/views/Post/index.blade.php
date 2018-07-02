@extends("dashboard")

@section("action-content")

<h1> Hello From Post</h1><br>
@if(Auth::user()->hasPermission("create-info"))
<a href="{{route('noticeboard.create')}}">
    <button class="btn btn-primary">
      Create Post
  </button>
</a><br/><br>

@endif  

    @foreach ($posts as $post)
        <div class="panel panel-body">
          <h2>
            <a href="{{ route('noticeboard.show', $post->id) }}">
              {{ $post->title }}
            </a>
          </h2>
          <div class="col-md-1">
              <a href="{{ route('noticeboard.edit', $post->id) }}" class="btn btn-info"> Edit </a>
          </div>
          <div class="col-md-1">
            <form action="{{ route('noticeboard.destroy', $post->id) }}" method="POST">
               {{ csrf_field() }}
              {{ method_field("delete") }}
              <button class="btn btn-danger" type="submit"> Delete </button>
            </form>
        </div>
      </div>

    @endforeach
{!! $posts->links() !!}

@endsection