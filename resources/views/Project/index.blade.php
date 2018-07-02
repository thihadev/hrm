@extends ('dashboard')

@section('action-content')
<h1> Hello From Project</h1><br>
@if(Auth::user()->hasPermission("create-info"))
	<a href="{{route('project.create')}}">
		<button class="btn btn-primary">
			Create Project
	</button>
</a>
<div id="buttons" class="pull-right"></div>
@endif	
	<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Project Information</h3>
        </div>
        <div class="box-body">
           <table class="table table-bordered" id="project-table" style="width: 100%;">
					<thead>
						<tr>	
							<th>No</th>		
							<th>Project Name</th>
							<th>Client</th>
							<th>Team Leader</th>
							<th>Start Date</th>
							<th>Deadline Date</th>
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
    var table = $('#project-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('project.data') !!}',
        columns: [

    {  data: "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
},
            { data: 'p_name', name: 'p_name'},
            { data: 'cname', name: 'cname' },
            { data: 'empname', name: 'empname' },
            { data: 'start_date', name: 'start_date'},
            { data: 'end_date', name: 'end_date' },
            @if(Auth::user()->hasPermission("update-info") OR Auth::user()->hasPermission("delete-info"))
            { data: 'action' ,name: 'action'}
            @endif
    
        ]
    });
      var buttons = new $.fn.dataTable.Buttons(table, {
      buttons: [{
      extend: 'copy',
      title: 'Project Detail'
        }, {
      extend: 'csv',
      filename: 'Project Detail'
        }, {
      extend: 'pdf',
      title: 'Project Detail',
      filename: 'Project Detail'
        }, {
      extend: 'excel',
      title: 'Project Detail',
      filename: 'Project Detail'
        }, {
      extend: 'print',
      title: 'Project Detail',
      filename: 'Project Detail'

        }]
    }).container().appendTo($('#buttons'));
});

</script>

@endpush

						 