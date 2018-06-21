@extends ('dashboard')

@section('action-content')
<h1> Hello From Expense</h1><br>
@if(Auth::user()->hasPermission("create-info"))
	<a href="{{route('expense.create')}}">
		<button class="btn-btn primary">
			Create Expense
	</button>
</a>
<div id="buttons" class="pull-right"></div>
@endif	
	<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Expense Information</h3>
  			<div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
           <table class="table table-bordered" id="expense-table" style="width: 100%;">
					<thead>
						<tr>	
							<th>No</th>		
							<th>Employee Name</th>
							<th>Item</th>
							<th>Purchase From</th>
							<th>Date of Purchase</th>
							<th>Amount</th>
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
    var table = $('#expense-table').DataTable({
        // dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
        processing: true,
        serverSide: true,
        ajax: '{!! route('expense.data') !!}',
        columns: [

    {  data: "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
},
            { data: 'employee_name', name: 'user_id'},
            { data: 'item', name: 'item' },
            { data: 'purchase_from', name: 'purchase_from' },
            { data: 'date_of_purchase', name: 'date_of_purchase'},
            { data: 'amount', name: 'amount' },
            @if(Auth::user()->hasPermission("update-info") OR Auth::user()->hasPermission("delete-info"))
            { data: 'action' ,name: 'action'}
            @endif
    
        ]
    });
      var buttons = new $.fn.dataTable.Buttons(table, {
      buttons: [{
      extend: 'copy',
      title: 'Expense Detail'
        }, {
      extend: 'csv',
      filename: 'Expense Detail'
        }, {
      extend: 'pdf',
      title: 'Expense Detail',
      filename: 'Expense Detail'
        }, {
      extend: 'excel',
      title: 'Expense Detail',
      filename: 'Expense Detail'
        }, {
      extend: 'print',
      title: 'Expense Detail',
      filename: 'Expense Detail'
        }]
    }).container().appendTo($('#buttons'));
});

</script>

@endpush

						 