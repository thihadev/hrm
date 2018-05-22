@extends ('dashboard')

@section('action-content')
<h1> Hello from Designation</h1><br>
@if(Auth::user()->hasPermission("create-designation"))
	<a href="{{route('des.create')}}">
		<button class="btn-btn primary">
			Create des
	</button>
</a>
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
           <table class="table table-bordered" id="des-table">
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
    $('#des-table').DataTable({
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
});
</script>
@endpush
