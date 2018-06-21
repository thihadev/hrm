@extends ('dashboard')

@section('action-content')
<h1> Hello from Designation</h1><br>
@if(Auth::user()->hasPermission("create-designation"))
	<a href="{{route('des.create')}}">
		<button class="btn-btn primary">
			Create des
	</button>
</a>
<div id="buttons" class="pull-right"></div>
@endif
<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Department Information</h3>
  			<div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
           <table class="table table-bordered" id="des-table" style="width: 100%;">
					<thead>
						<tr>	
              <th>No</th>								
							<th>Name</th>
              @if(Auth::user()->hasPermission("update-designation") OR Auth::user()->hasPermission("delete-designation"))
							<th>Action</th>
              @endif
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

@endsection
@push('scripts')
<script>
$(function() {
    var table = $('#des-table').DataTable({
        // dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
        processing: true,
        serverSide: true,
        ajax: '{!! route('des.data') !!}',
        columns: [
            {  data: "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
},
            { data: 'name', name: 'name' },
            @if(Auth::user()->hasPermission("update-designation") OR Auth::user()->hasPermission("delete-designation"))
            { data: 'action' ,name: 'action'}
            @endif
        ]
    });
      var buttons = new $.fn.dataTable.Buttons(table, {
      buttons: [{
      extend: 'copy',
      title: 'Designation Detail'
        }, {
      extend: 'csv',
      filename: 'Designation Detail'
        }, {
      extend: 'pdf',
      title: 'Designation Detail',
      filename: 'Designation Detail'
        }, {
      extend: 'excel',
      title: 'Designation Detail',
      filename: 'Designation Detail'
        }, {
      extend: 'print',
      title: 'Designation Detail',
      filename: 'Designation Detail'
        }]
    }).container().appendTo($('#buttons'));
});
</script>
@endpush
