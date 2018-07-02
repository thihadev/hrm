@extends('layouts.app')

@section('content')
<h1 style="text-align: center;">Welcome to Chatroom</h1>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                List of Employees 
            </div>
                <div class="panel panel-body">
                        @foreach($users as $user)
                        <p>{{ $user->name }}</p>
                        @endforeach         
                </div>
          </div>
    </div>
        <div class="col-md-8" style="float: right;">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Chat Room <a href="{{url('/')}}" class="btn btn-primary" style="float: right;"> Dashboard </a></h3>
                
                </div>

                <div class ="panel-body" style="height: 500px;overflow-y: scroll;">
                    <chat-messages :messages="messages"></chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                    ></chat-form>
                </div>
            </div>
        </div>

@endsection
