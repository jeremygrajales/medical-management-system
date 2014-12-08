@extends('home.layouts.master')

@section('content')

<form action="{{ URL::route('billing.show-outstanding-charges') }}" method="post" id="check_charges_outstanding_form" class="form-horizontal">
	<legend>Search Charges Outstanding</legend>	
	<fieldset>

		<div class="form-group">
			<div class="col-md-2 col-md-offset-5">
				<label class="control-label" for="list_all">SELECT ALL</label>&nbsp;
				<input id="list_all" name="list_all" value="1" type="checkbox">
			</div>
		</div>
		
		<div class="form-group">
			<h3 class="col-md-1 col-md-offset-6 text-center">OR</h3>
		</div>
		
		<div class="form-group">
			<label class="col-md-5 control-label" for="first_name">First name:</label>
			<div class="col-md-3">
				<input id="first_name" name="first_name" type="text" class="form-control" value="{{ Input::old('first_name') }}">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-5 control-label" for="first_name">Last name:</label>
			<div class="col-md-3">
				<input id="last_name" name="last_name" type="text" class="form-control" value="{{ Input::old('last_name') }}">
			</div>
		</div>
		
		<div class="form-group">
			<h3 class="col-md-1 col-md-offset-6 text-center">OR</h3>
		</div>
		
		<div class="form-group">
			<label class="col-md-5 control-label" for="first_name">Email:</label>
			<div class="col-md-3">
				<input id="email" name="email" type="text" class="form-control" value="{{ Input::old('email') }}">
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-3 col-md-offset-6">
				<button class="btn btn-primary">Search</button>
			</div>
		</div>

	</fieldset>
</form>

<legend>Results</legend>	

@if(!empty($accounts))
<table class="tabular-data">
	<thead>
		<tr>
			<th>First name</th>
			<th>Last name</th>
			<th>Email</th>
			<th>Amount Due</th>
		</tr>
	</thead>
	<tbody>
		@foreach($accounts as $account)
		<tr>
			<td>{{ $account->user->first_name }}</td>
			<td>{{ $account->user->last_name }}</td>
			<td>{{ $account->user->email }}</td>
			<td>${{ number_format($account->balance, 2, '.', ',') }}</td>
		</tr>
		@endforeach
	</tbody>	
</table>
<div class="page-height"></div>	
@endif

@stop