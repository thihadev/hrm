@extends ('dashboard')

@section('action-content')
<h1> Hello from Department</h1><br>
@if(Auth::user()->hasPermission("create-department"))
	<a href="{{route('dep.create')}}">
		<button class="btn-btn primary">
			Create dep
	</button>
</a>
<div id="buttons" class="pull-right"></div>
@endif
<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Department Information</h3>
  			<div class="box-tools pull-right">
          
         <!--    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button> -->
          </div>
        </div>
        <div class="box-body">
           <table class="table table-striped table-bordered" id="dep-table" style="width: 100%;">
					<thead>
						<tr>
              <th>No</th>	            				
							<th>Name</th>        
               @if(Auth::user()->hasPermission("update-department") OR Auth::user()->hasPermission("delete-department"))
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
    var table = $('#dep-table').DataTable({
        // dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
        processing: true,
        serverSide: true,
        // dom: 'Bfrtip',
        ajax: '{!! route('dep.data') !!}',
        columns: [
            {  data: "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
},
            { data: 'name', name: 'name' },
           
            @if(Auth::user()->hasPermission("update-department") OR Auth::user()->hasPermission("delete-department"))
            { data: 'action' ,name: 'action'}
            @endif
        ]
    });
  var buttons = new $.fn.dataTable.Buttons(table, {
      buttons: [{
      extend: 'copy',
      title: 'Department Detail'
        }, {
      extend: 'csv',
      filename: 'Department Detail'
        }, {
      extend: 'pdf',
      title: 'Department Detail',
      filename: 'Department Detail'
        }, {
      extend: 'excel',
      title: 'Department Detail',
      filename: 'Department Detail'
        }, {
      extend: 'print',
      title: 'Department Detail',
      filename: 'Department Detail'
        }]
    }).container().appendTo($('#buttons'));
});
</script>
@endpush