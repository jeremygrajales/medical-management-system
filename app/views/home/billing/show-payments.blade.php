@extends('home.layouts.master')

@section('content')

<form action="{{ URL::route('billing.show-payments') }}" method="post" class="form-horizontal">
	<fieldset>

		<legend>Search for Payments</legend>	
		<br><br>
		<div class="form-group">
			<label class="col-md-4 control-label" for="from">From:</label>  
			<div class="col-md-4 date input-group">
				<input id="from" name="from" type="text" class="form-control" placeholder="mm/dd/yyyy" value="{{ Input::old('from') }}"><span class="input-group-addon">
				<i class="glyphicon glyphicon-th" style="font-size:20px"></i></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label" for="to">To:</label>  
			<div class="col-md-4 date input-group">
				<input id="to" name="to" type="text" class="form-control" placeholder="mm/dd/yyyy" value="{{ Input::old('to') }}"><span class="input-group-addon">
				<i class="glyphicon glyphicon-th" style="font-size:20px"></i></span>
			</div>
		</div>

		<div class="form-group text-center">
				<button class="btn btn-primary" style="width:100px;">Search</button>
		</div>

	</fieldset>
</form>

<legend>Results</legend>

@if(!empty($payments))
<table class="tabular-data">
	<thead>
		<tr>
			<th>First name</th>
			<th>Last name</th>			
			<th>Amount paid</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		@foreach($payments as $payment)
		<tr>
			<td>{{ $payment->user->first_name }}</td>
			<td>{{ $payment->user->last_name }}</td>
			<td>${{ number_format($payment->amount, 2, '.', ',') }}</td>
			<td>{{ $payment->created_at }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
<div class="page-height"></div>	
@endif

@stop

@section('footerScripts')
$(document).ready(function(){
	$('.date').datepicker({
		format: "mm/dd/yyyy",
		weekStart: 0,
		autoclose: true,
		todayHighlight: true
	});
});


@stop