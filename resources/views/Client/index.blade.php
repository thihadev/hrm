@extends ('dashboard')

@section('action-content')
<h1> Hello from Client</h1><br>
@if(Auth::user()->hasPermission("create-info"))
	<a href="{{route('client.create')}}">
		<button class="btn btn-primary">
			Create Client
	</button>
</a>
<div id="buttons" class="pull-right"></div>
@endif
<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Client Information</h3>
  			<div class="box-tools pull-right">
          </div>
        </div>
        <div class="box-body">
           <table class="table table-striped table-bordered" id="client-table" style="width: 100%;">
					<thead>
						<tr>
              <th>No</th>	            				
							<th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Website</th>     
               @if(Auth::user()->hasPermission("update-info") OR Auth::user()->hasPermission("delete-info"))
							<th></th>
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
    var table = $('#client-table').DataTable({

        processing: true,
        serverSide: true,
        ajax: '{!! route('client.data') !!}',
        columns: [
            {  data: "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
},
            { data: 'c_name', name: 'c_name' },
            { data: 'c_email', name: 'c_email' },
            { data: 'c_phone', name: 'c_phone' },
            { data: 'c_address', name: 'c_address' },
            { data: 'c_web', name: 'c_web' },
           
            @if(Auth::user()->hasPermission("update-info") OR Auth::user()->hasPermission("delete-info"))
            { data: 'action' ,name: 'action'}
            @endif
        ]
    });
  var buttons = new $.fn.dataTable.Buttons(table, {
      buttons: [{
      extend: 'copy',
      title: 'Client Detail'
        }, {
      extend: 'csv',
      filename: 'Client Detail'
        }, {
      extend: 'pdf',
      title: 'Client Detail',
      filename: 'Client Detail'
        }, {
      extend: 'excel',
      title: 'Client Detail',
      filename: 'Client Detail'
        }, {
      extend: 'print',
      title: 'Client Detail',
      filename: 'Client Detail'
        }]
    }).container().appendTo($('#buttons'));

  var deleter = {

        linkSelector : "#delete-btn",

        init: function() {
            $(this.linkSelector).on('click', {self:this}, this.handleClick);
        },

        handleClick: function(event) {
            event.preventDefault();

            var self = event.data.self;
            var link = $(this);

            swal({
                title: "Confirm Delete",
                text: "Are you sure to delete this category?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            },
            function(isConfirm){
                if(isConfirm){
                    window.location = link.attr('href');
                }
                else{
                    swal("cancelled", "Category deletion Cancelled", "error");
                }
            });

        },
    };

    deleter.init();
});
    
</script>
@endpush