@extends('dashboard')

@section('action-content')
<div class="row">
    <div class="col-md-11">
        <div class="box box-success">
            <div class="panel">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"> Add Expense</span>
        </div>
      
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            {{Session::get('flash_message')}}
                        </div>
                    @endif
<form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('expense.store') }}">
          {{csrf_field()}}
        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
            <label for="user_id" class="col-md-4 control-label">User</label>
                <div class="col-md-6">
                      <select id="user_id" type="text" class="form-control" name="user_id" value="{{ old('user_id') }}" required autofocus>
                            <option value="">Select One</option>
                            @foreach($employees as $emp)
                              <option value="{{$emp->id}}"> {{$emp->name}}</option>
                            @endforeach
                      </select>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

        <div class="form-group{{ $errors->has('item') ? ' has-error' : '' }}">
          <label for="item" class="col-md-4 control-label">Item</label>

          <div class="col-md-6">
            <input id="item" type="text" class="form-control" name="item" value="{{ old('item') }}" placeholder="Item Name" required autofocus>

            @if ($errors->has('item'))
            <span class="help-block">
              <strong>{{ $errors->first('item') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('purchase_from') ? ' has-error' : '' }}">
          <label for="purchase_from" class="col-md-4 control-label">Purchase From</label>

          <div class="col-md-6">
            <input id="purchase_from" type="text" class="form-control" name="purchase_from" value="{{ old('purchase_from') }}" placeholder="Purchase From" required autofocus>

            @if ($errors->has('purchase_from'))
            <span class="help-block">
              <strong>{{ $errors->first('purchase_from') }}</strong>
            </span>
            @endif
          </div>
        </div>
                                            
        <div class="form-group">
            <label class="col-md-4 control-label">Purchase Date</label>
                <div class="col-md-6">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" value="{{ old('date_of_purchase') }}" name="date_of_purchase" class="form-control pull-right" id="date_of_purchase" required>
                    </div>
                </div>
            </div>

        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
          <label for="amount" class="col-md-4 control-label">Amount</label>

          <div class="col-md-6">
            <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="Amount" required>

            @if ($errors->has('amount'))
            <span class="help-block">
              <strong>{{ $errors->first('amount') }}</strong>
            </span>
            @endif
          </div>
        </div>

            <div class="col-md-5"></div>
                <button type="submit" class="btn btn-success" >Submit</button>
                <button type="reset" class="btn btn-danger" >Reset</button>
                           
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