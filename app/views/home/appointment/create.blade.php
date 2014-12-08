@extends('home.layouts.master')


@section('content')

{{ Form::open(array('class' => 'form-horizontal', 'route' => 'appointment.create', 'method' => 'post')) }}
<fieldset>

<div class="form-group">
	<label class="col-md-4 control-label" for="textinput">Date of Appointment:</label>  
	<div class="col-md-4 date input-group">
		<input id="date" name="date" type="text" class="form-control" value="{{ Input::old('date') }}"><span class="input-group-addon">
		<i class="glyphicon glyphicon-th" style="font-size:20px"></i></span>
	</div>
</div>


<div class="form-group has-feedback">
	<label class="col-md-4 control-label" for="timepicker1">Time of Appointment:</label>
	<div class="col-md-4 time">
		<input id="time" name="time" type="text" class="form-control input-small" value="{{ Input::old('time') }}">
		<span class="addon"><i class="glyphicon glyphicon-time form-control-feedback"></i></span>
	</div>
</div>

<div class="form-group has-feedback">
	<label class="col-md-4 control-label">Doctor:</label>  
	<div class="col-md-4">
		{{ Form::select('staff_id', $staff, Input::old('staff_id'), array('class' => 'form-control input-small')) }}
	</div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="reason">Reason for appointment:</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="reason" name="reason">{{ Input::old('reason') }}</textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="constraints">Rescheduling Constraints:</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="constraints" name="constraints">{{ Input::old('constraints') }}</textarea>
  </div>
</div>

<div class="form-group">
<label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <button class="btn btn-primary">Submit</button>
  </div>
</div>
 

 </fieldset>
  
{{ Form::close() }}

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