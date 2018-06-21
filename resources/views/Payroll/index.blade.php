@extends ('dashboard')

@section('action-content')
<h1> Hello From Payroll</h1><br>
@if(Auth::user()->hasPermission("create-info"))
	<a href="{{route('payroll.create')}}">
		<button class="btn-btn primary">
			Create Payroll
	</button>
</a>
<div id="buttons" class="pull-right"></div>
<a target="_blank" href="" class="btn btn-default">payslip</a> 
@endif	
	<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Payroll Information</h3>
  			<div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
           <table class="table table-bordered" id="payroll-table" style="width: 100%;">
					<thead>
						<tr>	
							<th>No</th>		
							<th>Employee Name</th>
							<th>Over time</th>
							<th>Hours</th>
							<th>Rate</th>
							<th>Salary</th>
              <th>Pay Date </th>
              <th>Payslip</th>
                @if(Auth::user()->hasPermission("update-info") OR Auth::user()->hasPermission("delete-info"))
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
        <!-- /.box-footer-->
      <!-- /.box -->
@endsection
@push('scripts')
<script>
$(function() {
    var table = $('#payroll-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('payroll.data') !!}',
        columns: [

    {  data: "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
},
            { data: 'employee_name', name: 'employee_id'},
            { data: 'over_time', name: 'over_time' },
            { data: 'hours', name: 'hours' },
            { data: 'rate', name: 'rate'},
            { data: 'gross', name: 'gross' },
            { data: 'created_at', name: 'created_at' },
            { data: 'payslip', name: 'payslip' },
            @if(Auth::user()->hasPermission("update-info") OR Auth::user()->hasPermission("delete-info"))
            { data: 'action' ,name: 'action'}
            @endif
    
        ]
    });
      var buttons = new $.fn.dataTable.Buttons(table, {
      buttons: [{
      extend: 'copy',
      title: 'Payroll Detail'
        }, {
      extend: 'csv',
      filename: 'Payroll Detail'
        }, {
      extend: 'pdf',
      title: 'Payroll Detail',
      filename: 'Payroll Detail'
        }, {
      extend: 'excel',
      title: 'Payroll Detail',
      filename: 'Payroll Detail'
        }, {
      extend: 'print',
      title: 'Payroll Detail',
      filename: 'Payroll Detail'

        }]
    }).container().appendTo($('#buttons'));
});

</script>

@endpush

						 