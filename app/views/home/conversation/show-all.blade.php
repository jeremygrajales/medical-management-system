@extends('home.layouts.master')

@section('content')

<h2>Conversations</h2>
@foreach($conversations as $conversation)
	
	<div class="conversation">
		<label>Subject:</label> <span class="subject">{{ $conversation->subject }}</span><br>
		<span class="sender">Started @if($conversation->sender->id == Confide::user()->id) with <i><u>{{$conversation->receiver->first_name . ' ' . $conversation->receiver->last_name}}</u></i>@else by <i><u>{{$conversation->sender->first_name . ' ' . $conversation->sender->last_name}}</u></i>@endif on </span>
		<span class="date">{{ date("l, F jS, Y", strtotime($conversation->created_at)) }} at </span>
		<span class="time">{{ date("g:i A", strtotime($conversation->created_at)) }}</span>
		<a href="{{ URL::route('conversation.show', array($conversation->id)) }}" class="btn btn-sm btn-primary">Show</a>
	</div>
	
@endforeach

<style>
	.conversation {
		margin:20px 0px;
	}
</style>

@stop 