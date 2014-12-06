@extends('home.layouts.master')

@section('content')

<form action="{{ URL::route('billing.make-payment') }}" method="POST" id="make_payment_form" class="form-horizontal text-center">
	<fieldset>
		<legend>Make a Payment</legend>	
		<div class="form-group">
			<!-- Name on Card -->
			<label class="col-md-5 control-label" for="first_name">Name on card:</label>  
			<div class="col-md-3">
				<input id="name" name="name" type="text" class="form-control" value="{{ Input::old('name') }}">
			</div>
		</div>
		
		<div class="form-group">
			<!-- Card Type -->
			<label class="col-md-5 control-label" for="cc_type">Card type:</label>
			<div class="col-md-3">
				{{ Form::select('cc_type', array('amex' => 'American Express', 'visa' => 'Visa', 'mastercard' => 'MasterCard'), Input::old('cc_type'), array('class' => 'form-control')) }}
			</div>
		</div>
		
		<div class="form-group">
			<!-- Card Number -->
			<label class="col-md-5 control-label" for="cc_num">Card number:</label>
			<div class="col-md-3">
				<input id="cc_num" name="cc_num" type="text" class="form-control" value="{{ Input::old('cc_num') }}">
			</div>
		</div>
		
		<div class="form-group">
			<!-- Card Expiration Date -->
			<label class="col-md-5 control-label" for="cc_exp_date">Expiration date:</label>  
			<div class="col-md-3">
				<input id="cc_exp_date" name="cc_exp_date" type="text" class="form-control" value="{{ Input::old('cc_exp_date') }}" placeholder="mm/yyyy">
			</div>
		</div>
		
		<div class="form-group">
			<!-- Card Code -->		
			<label class="col-md-5 control-label" for="cc_code">Card security code:</label>  
			<div class="col-md-3">
				<input id="cc_code" name="cc_code" type="text" class="form-control" value="{{ Input::old('cc_code') }}">
			</div>
		</div>
		
		<div class="form-group">
			<!-- Amount -->
			<label class="col-md-5 control-label" for="amount">Payment amount:</label>
			<div class="col-md-3">
				<input id="amount" name="amount" type="text" class="form-control" value="{{ Input::old('cc_code') }}" placeholder="$">
			</div>
		</div>
		
		<div class="form-group" style="margin:30px 0px;">
			<div class="col-md-1 col-md-offset-4" style="padding-left:50px;">
				<input id="agreed" name="agreed" value="1" type="checkbox">
			</div>
			<label class="col-md-3 control-labl" for="agreed">I agree to the terms and conditions</label>
		</div>
		
		<div class="form-group">
			<div class="col-md-3 col-md-offset-5">
				<button class="btn btn-primary">Submit Payment</button>
			</div>
		</div>
	<fieldset>
</form>

@stop