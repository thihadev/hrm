@extends ('dashboard')

@section('action-content')
<h1> Hello From Employee</h1><br>
	<a href="{{route('emp.create')}}">
		<button class="btn-btn primary">
			Create emp
	</button>
</a>	
	<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Employee Information</h3>
  			<div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
           <table class="table table-bordered" id="emp-table">
					<thead>
						<tr>								
							<th>Photo</th>											
							<th>Name</th>
							<th>Email</th>
							<th>Age</th>
							<th>Mobile</th>
							<th>Address</th>
							<th>Birthay</th>
							<th>Department</th>
							<th>Designation</th>
							<th>Join Date</th>
							<th>Action</th>
							<!-- <th></th> -->
							
						</tr>
					</thead>
					
					</table>
		        </div>
	

        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
    </div>
        <!-- /.box-footer-->
      <!-- /.box -->
@endsection
@push('scripts')
<script>
$(function() {
    $('#emp-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('emp.data') !!}',
        columns: [
            { data: 'photo', name: 'photo',
            	render: function (data, url) {
            		return "<img height=50 width=50 src='/uploads/photos/' />";
            	}
             },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'age', name: 'age' },
            { data: 'phone', name: 'phone'},
            { data: 'address', name: 'address' },
            { data: 'dateofbirth', name: 'dateofbirth' },
            { data: 'department_id', name: 'department_id' },
            { data: 'designation_id', name: 'designation_id' },
            { data: 'joined', name: 'joined' },
            { data: 'action' ,name: 'action'}
            // { data: 'delete', name: 'edit'}         
        ]
    });
});
</script>
@endpush

<!-- 
						 <tbody>
						@foreach ($employees as $employee)
						<tr>
							<td>
							<a href="profile.html" class="avatar"><img src="/uploads/photos/{{ $employee->photo }}" class="rounded circle"/></a>
							<h4><a href="profile.html">{{$employee->name}}<span>{{$employee->designation_name}}</span></a></h4>
							</td>
							<td>{{$employee->email}}</td>
							<td>{{$employee->age}}</td>
							<td>{{$employee->phone}}</td>
							<td>{{$employee->address}}</td>
							<td>{{$employee->dateofbirth}}</td>
							<td>{{$employee->department_name}}</td>
							<td>{{$employee->designation_name}}</td>
							<td>{{$employee->joined}}</td>

							<td class="text-right">
							<div class="dropdown">
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<ul class="dropdown-menu pull-right">
										<li><a href="#" data-toggle="modal" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
										<li><a href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
									</ul>
							</div>
							</td>
							</tr>
							@endforeach
						</tbody> -->