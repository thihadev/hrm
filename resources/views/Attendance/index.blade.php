@extends ('dashboard')

@section('action-content')
<h1> Hello From Attendance</h1><br>
@if(Auth::user()->hasPermission("create-info"))
	<a href="{{route('attendance.create')}}">
		<button class="btn btn-primary">
			Create Attendance
	</button>
</a>
<div id="buttons" class="pull-right"></div>
@endif	
	<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Attendance Information</h3>
  			<div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
           <table class="table table-bordered" id="attendance-table" style="width: 100%;">
					<thead>
						<tr>	
							<th>No</th>		
							<th>Employee Name</th>
							<th>Date</th>
							<th>Attend</th>

                @if(Auth::user()->hasPermission("update-info") OR Auth::user()->hasPermission("delete-info"))
							<th></th>
                @endif
							
						</tr>
					</thead>

					</table>
		    </div>
	
    </div>

@endsection
@push('scripts')
<script>
$(function() {
    var table = $('#attendance-table').DataTable({
        dateFormat: 'dd-mm-yyyy',
        timeFormat: 'HH:mm:ss',
        processing: true,
        serverSide: true,
        ajax: '{!! route('attendance.data') !!}',
        columns: [

    {  data: "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
},
            { data: 'employee_name', name: 'employee_id'},
            { data: 'att_date', name: 'att_date' },
            { data: 'attend', name: 'attend' },
            @if(Auth::user()->hasPermission("update-info") OR Auth::user()->hasPermission("delete-info"))
            { data: 'action' ,name: 'action'}
            @endif
    
        ]
    });
      var buttons = new $.fn.dataTable.Buttons(table, {
      buttons: [{
      extend: 'copy',
      title: 'Attendance Detail'
        }, {
      extend: 'csv',
      filename: 'Attendance Detail'
        }, {
      extend: 'pdf',
      title: 'Attendance Detail',
      filename: 'Attendance Detail'
        }, {
      extend: 'excel',
      title: 'Attendance Detail',
      filename: 'Attendance Detail'
        }, {
      extend: 'print',
      title: 'Attendance Detail',
      filename: 'Attendance Detail'

        }]
    }).container().appendTo($('#buttons'));
});

</script>

@endpush

						 