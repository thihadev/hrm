@extends ('dashboard')

@section('action-content')
<h1> Hello from Designation</h1><br>
	<a href="{{route('des.create')}}">
		<button class="btn-btn primary">
			Create des
	</button>
</a>

@endsection