@extends ('dashboard')

@section('action-content')
<h1> Hello from Department</h1><br>
	<a href="{{route('dep.create')}}">
		<button class="btn-btn primary">
			Create dep
	</button>
</a>

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
           <table class="table table-bordered" id="dep-table">
					<thead>
						<tr>									
							<th>Name</th>
							<th>Action</th>
							<th></th>
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
    $('#dep-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('dep.data') !!}',
        columns: [
            { data: 'name', name: 'name' },
            // { data: 'action' ,name: 'action'}
            { data: 'edit', name: 'edit'},
            { data: 'delete', name: 'delete'}
        ]
    });
});
</script>
@endpush