@extends('home.layouts.master')

@section('content')

<form class="form-horizontal" action="{{ URL::route('conversation.create') }}" method="post">
	<fieldset>

		<!-- Form Name -->
		<legend>New Conversation</legend>

		@if($recipient)
			<input type="hidden" name="user_id" id="user_id" value="{{ $recipient->id }}">
		@else
		<!-- Button Drop Down -->
		<div class="form-group has-feedback">
			<label class="col-md-4 control-label">Recipient:</label>  
			<div class="col-md-4">
				{{ Form::select('user_id', $users, Input::old('user_id'), array('class' => 'form-control input-small')) }}
			</div>
		</div>
		@endif

		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="title">Subject:</label>  
			<div class="col-md-4">
				@if(Input::get('subject'))
				<input id="subject" name="subject" type="text" placeholder="" class="form-control input-md" value="{{ Input::get('subject') }}" disabled="disabled">
				@else
				<input id="subject" name="subject" type="text" placeholder="" class="form-control input-md" value="{{ Input::old('subject') }}">
				@endif
			</div>
		</div>

		<!-- Textarea -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="message">Message:</label>
			<div class="col-md-4">                     
				<textarea class="form-control" id="message" name="message">{{ Input::old('message') }}</textarea>
			</div>
		</div>

		<!-- Button -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="send"></label>
			<div class="col-md-4">
				<button id="send" name="send" class="btn btn-primary">Send</button>
			</div>
		</div>

	</fieldset>
</form>

@stop