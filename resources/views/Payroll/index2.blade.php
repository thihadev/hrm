@extends ('dashboard')

@section('action-content')

	<h1>Hello from Payroll </h1>	

	<a href="{{ route('payroll.create') }}" class="btn btn-primary">Create</a>
	<div class="box">
	<table class= "table table-bordered" id="filterTable">
		<thead>	
			<th>Name</th>
			<th>Over-Time</th>
			<th>Hours</th>
			<th>Rate</th>
			<th>Gross</th>
			<th>Date-issued</td>
			<th>Edit</th>	
			<th>Trash</th>
		</thead>		
			
		<tbody>
				@foreach($payrolls as $payroll)
					<tr>		@foreach ($employees as $employee)
						<td>{{ $employee->name }}</td>@endforeach
						<td>
							@if($payroll->over_time)
								<p><b>Yes</b></p>				
							@else
								<p><b>No</b></p>							
							@endif				
						</td>
						<td>{{ $payroll->hours }}</td>
						<td>{{ $payroll->rate }}</td>
						<td>{{ $payroll->gross }}</td>
						<td>{{ $payroll->created_at->toDateString() }}</td>
						

						<td>
							<a href="" class="btn btn-success">Edit</a>
						</td>
						<td>
							<form action="{{ route('payroll.destroy', ['id' => $payroll->id]) }}" method="POST">
								{{csrf_field() }}
								{{method_field('DELETE')}}
								<button class="btn btn-danger">Bin</button>
							</form>
						</td>
					</tr>
				@endforeach
		</tbody>							
	</table>
</div>

@endsection