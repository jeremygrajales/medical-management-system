@extends('home.layouts.master')

@section('content')

<div class="conversation">
	<label>Subject:</label><span class="subject"> {{ $conversation->subject }}</span><br>
	<span>Started @if($conversation->sender->id == $user->id) with <i><u>{{$conversation->receiver->first_name . ' ' . $conversation->receiver->last_name}}</u></i>@else by <i><u>{{$conversation->sender->first_name . ' ' . $conversation->sender->last_name}}</u></i>@endif on </span>
	<span>{{ date("l, F jS, Y", strtotime($conversation->created_at)) }} at </span>
	<span>{{ date("g:i A", strtotime($conversation->created_at)) }}</span><br><br>
	<span class="sender"><b>{{$conversation->sender->first_name . ' ' . $conversation->sender->last_name}}</b></span>
	<span class="date">{{ date("m/d/Y", strtotime($conversation->created_at)) }}</span>
	<span class="time"> {{ date("g:i A", strtotime($conversation->created_at)) }}</span><br>
	<p class="message">{{ $conversation->message }}</p>
	@foreach($comments as $comment)
		<div class="comment">
			<span class="commenter"><b>{{$comment->user->first_name . ' ' . $comment->user->last_name}}</b></span>
			<span class="date">{{ date("m/d/Y", strtotime($comment->created_at)) }}</span>
			<span class="time"> {{ date("g:i A", strtotime($comment->created_at)) }}</span><br>
			<p class="message">{{ $comment->message }}</p>
		</div>
	@endforeach
</div>

<form class="form-horizontal" action="{{ URL::route('conversation.comment', array($conversation->id)) }}" method="post">
	<fieldset>

		<!-- Form Name -->
		<legend>Add Comment</legend>

		<!-- Textarea -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="textarea">Comment</label>
			<div class="col-md-4">                     
				<textarea class="form-control" id="message" name="message"></textarea>
			</div>
		</div>

		<!-- Button -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="singlebutton"></label>
			<div class="col-md-4">
				<button id="post" name="post" class="btn btn-primary">Post</button>
			</div>
		</div>

	</fieldset>
</form>





@stop


@section('footerScripts')
$(document).ready(function(){
	$('#date').datepicker({
		format: "mm/dd/yyyy",
		weekStart: 0,
		autoclose: true,
		todayHighlight: true
	});
	
	$('#time').timepicker({
		minuteStep: 30,
		defaultTime: '9:00 AM',
	});
});


@stop