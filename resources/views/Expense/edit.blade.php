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
<form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('expense.update', $expenses->id) }}">
          {{csrf_field()}}
          <input name="_method" type="hidden" value="PATCH">
       <div class="form-group">
          <label class="col-md-4 control-label">Employee Name</label>
          <div class="col-md-6">
            <select class="form-control" id="user_id" value="{{$expenses->user_id}}" name="user_id">
              @foreach ($employees as $emp)
              <option {{$expenses->employee_id == $emp->id ? 'selected' : ''}} value="{{$emp->id}}">{{$emp->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="item" class="col-md-4 control-label">Item</label>

          <div class="col-md-6">
            <input id="item" type="text" class="form-control" name="item" value="{{ $expenses->item }}" placeholder="Item Name" required autofocus>
          </div>
        </div>

        <div class="form-group">
          <label for="purchase_from" class="col-md-4 control-label">Purchase From</label>

          <div class="col-md-6">
            <input id="purchase_from" type="text" class="form-control" name="purchase_from" value="{{ $expenses->purchase_from }}" placeholder="Purchase From" required autofocus>
          </div>
        </div>
                                            
        <div class="form-group">
            <label class="col-md-4 control-label">Purchase Date</label>
                <div class="col-md-6">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" value="{{ $expenses->date_of_purchase }}" name="date_of_purchase" class="form-control pull-right" id="date_of_purchase" required>
                    </div>
                </div>
            </div>

        <div class="form-group">
          <label for="amount" class="col-md-4 control-label">Amount</label>

          <div class="col-md-6">
            <input id="amount" type="text" class="form-control" name="amount" value="{{ $expenses->amount }}" placeholder="Amount" required>
          </div>
        </div>

            <div class="col-md-5"></div>
                <button type="submit" class="btn btn-success" >Update</button>
                <a href="{{ route('expense.index')}}" class="btn btn-danger">Cancel</a>
                           
            </form>
        </div>
    </div>
</div> 
</div>  



@endsection
@push('scripts')
    <script src="/assets/js/pages/forms-widgets.js"></script>
    <script src="/assets/js/custom.js"></script>
@endpush