@extends('layouts.chatroom')

@section('content')
<h1>Welcome to Chatroom</h1>
	<div id="app">
		<div class="panel panel-default">
			<div class="panel-heading">
				Chatroom
				<span class="badge pull-right">@{{ roomCount.length }}</span>
			</div>

			<chat-log :messages="messages"></chat-log>
			<chat-composer v-on:messagesent="addMessage"></chat-composer>

		
			</div>
		</div>
			
@endsection

<!-- 				<chat-list v-bind:messages="messages"></chat-list>
				<chat-create v-on:messagecreated="addMessage"
					:currentuser="currentuser"></chat-create> -->