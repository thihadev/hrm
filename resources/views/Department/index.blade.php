@extends ('layouts.admindashboard')

@section('content')
<h1> Hello from Department</h1><br>
	<a href="{{route('dep.create')}}">
		<button class="btn-btn primary">
			Create dep
	</button>
</a>

@endsection