@extends ('dashboard')

@section('action-content')
<h1> Hello from User Setting</h1>

<div id="buttons" class="pull-right"></div>

<div class="box" style="margin-top: 60px;">
        <div class="box-header with-border">
          <h3 class="box-title">User Information</h3>
  			<div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">
           <table style="width: 100%;"  id="user-table">
					<thead>
						<tr>
              <th>No</th>	             				
							<th>Name</th>
              <th>Email</th>
              <th>Role Access</th>
              <th>Status</th>

               @if(Auth::user()->hasPermission("update-user") OR Auth::user()->hasPermission("delete-user"))
							<th>Action</th>
              @endif

						</tr>
					</thead>	
		
					</table>
		        </div>
	
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
    </div>

@endsection
@push('scripts')
<script>
$(function() {
   var table = $('#user-table').DataTable({
        // dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
        processing: true,
        serverSide: true,
        ajax: '{!! route('user.data') !!}',
        columns: [
            {  data: "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
},
 
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'role', name: 'role' },
            { data: 'status', name: 'status'},
            @if(Auth::user()->hasPermission("update-user") OR Auth::user()->hasPermission("delete-user"))
            { data: 'action' ,name: 'action'}
            @endif
        ]

    });
      var buttons = new $.fn.dataTable.Buttons(table, {
      buttons: [{
      extend: 'copy',
      title: 'User Detail'
        }, {
      extend: 'csv',
      filename: 'User Detail'
        }, {
      extend: 'pdf',
      title: 'User Detail',
      filename: 'User Detail'
        }, {
      extend: 'excel',
      title: 'User Detail',
      filename: 'User Detail'
        }, {
      extend: 'print',
      title: 'User Detail',
      filename: 'User Detail'
        }]
    }).container().appendTo($('#buttons'));
});
</script>
@endpush