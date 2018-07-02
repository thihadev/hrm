@extends('dashboard')

@section('action-content')
<div class="row">
    <div class="col-md-11">
        <div class="box box-success">
            <div class="panel">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"> Edit Expense</span>
        </div>
     
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <strong>Whoops!!</strong> There were some problems with your input.<br>
                      <ul>
                          @foreach ($error->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                </div>
            @endif
      <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('project.update', $projects->id) }}">
          {{csrf_field()}}
          <input name="_method" type="hidden" value="PATCH">

          <div class="form-group">
          <label for="p_name" class="col-md-4 control-label">Project</label>

          <div class="col-md-6">
            <input id="p_name" type="text" class="form-control" name="p_name" value="{{ $projects->p_name }}" placeholder="Project Name" required autofocus>
          </div>
        </div>

       <div class="form-group">
          <label class="col-md-4 control-label"> Client </label>
          <div class="col-md-6">
            <select class="form-control" id="client_id" value="{{$projects->client_id}}" name="client_id">
              @foreach ($clients as $client)
              <option {{$projects->client_id == $client->id ? 'selected' : ''}} value="{{$client->id}}">{{$client->c_name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Employee Name</label>
            <div class="col-md-6">
              <select class="form-control" id="employee_id" value="{{$projects->employee_id}}" name="employee_id">
                @foreach ($employees as $emp)
              <option {{$projects->employee_id == $emp->id ? 'selected' : ''}} value="{{$emp->id}}">{{$emp->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
                                                    
        <div class="form-group">
            <label class="col-md-4 control-label">Start Date</label>
                <div class="col-md-6">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" value="{{ $projects->start_date }}" name="start_date" class="form-control pull-right" id="start_date" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Deadline Date</label>
                <div class="col-md-6">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" value="{{ $projects->end_date }}" name="end_date" class="form-control pull-right" id="end_date" required>
                    </div>
                </div>
            </div>

              <div class="col-md-5"></div>
                <button type="submit" class="btn btn-success" >Update</button>
                <a href="{{ route('project.index')}}" class="btn btn-danger">Cancel</a>
                           
            </form>
        </div>
    </div>
  </div> 
</div>  



@endsection
