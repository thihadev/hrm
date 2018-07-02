@extends ('dashboard')

@section('action-content')
<h1> Hello From Employee</h1><br>
@if(Auth::user()->hasPermission("create-info"))
	<a href="{{route('emp.create')}}">
		<button class="btn btn-primary">
			Create emp
	</button>
</a>
<div id="buttons" class="pull-right"></div>
@endif
	<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Employee Information</h3>
        </div>
        <div class="box-body">
           <table class="table-bordered" id="emp-table" style="width: 100%;">
					<thead>
						<tr>	
								
							<th></th>
              <th>No</th> 
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Department</th>
							<th>Designation</th>
                @if(Auth::user()->hasPermission("update-info") OR Auth::user()->hasPermission("delete-info"))
							<th></th>
                @endif
							<!-- <th></th> -->
							
						</tr>
					</thead>

					</table>
		    </div>
    </div>

@endsection
@push('scripts')
<script>
$(function() {
    var table = $('#emp-table').DataTable({
        // dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],

        processing: true,
        serverSide: true,
        ajax: '{!! route('emp.data') !!}',
        columns: [
            { data: 'photo', name: 'photo'},
    {  data: "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
},

            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone'},
            { data: 'department_name', name: 'department_id' },
            { data: 'designation_name', name: 'designation_id' },
            // { data: 'show', name: 'show'},
            @if(Auth::user()->hasPermission("update-info") OR Auth::user()->hasPermission("delete-info") )
            { data: 'action' ,name: 'action'}
            @endif
     
        ]
    });
      var buttons = new $.fn.dataTable.Buttons(table, {
      buttons: [{
      extend: 'copy',
      title: 'Employees Detail'
        }, {
      extend: 'csv',
      filename: 'Employees Detail'
        }, {
      extend: 'pdf',
      title: 'Employees Detail',
      filename: 'Employees Detail'
        }, {
      extend: 'excel',
      title: 'Employees Detail',
      filename: 'Employees Detail'
        }, {
      extend: 'print',
      title: 'Employees Detail',
      filename: 'Employees Detail'
        }]
    }).container().appendTo($('#buttons'));
});

</script>

@endpush


						 