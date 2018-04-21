@extends ('layouts.admindashboard')

@section('content')
<h1> Hello From Employee</h1><br>
	<a href="{{route('emp.create')}}">
		<button class="btn-btn primary">
			Create emp
	</button>
</a>

@endsection