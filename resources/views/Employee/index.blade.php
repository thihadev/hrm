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
							<th>No</th>		
							<th>Photo</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Department</th>
							<th>Designation</th>
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

    {  data: "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
},
            { data: 'photo', name: 'photo',
            	render: function (data, url) {
            		return "<img height=50 width=50 src='/uploads/photos/' />";
            	}
             },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone'},
            { data: 'department_id', name: 'department_id' },
            { data: 'designation_id', name: 'designation_id' },
            { data: 'action' ,name: 'action'}
            // { data: 'delete', name: 'edit'}         
        ]
    });
});

</script>
<!-- <script>
	$(document).ready(function() {
    $('#emp.table').DataTable( {
"columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    } );
 
    on( 'order.dt search.dt', function () {
        column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
</script> -->
@endpush

<!-- 
						 