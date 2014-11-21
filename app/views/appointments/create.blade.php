@extends('layouts.master')


@section('content')

{{ Form::open(array('class' => 'form-horizontal', 'route' => 'appointment.create', 'method' => 'post')) }}
<fieldset>

<div class="form-group">
	<label class="col-md-4 control-label" for="textinput">Date of Appointment:</label>  
	<div class="col-md-4 date input-group">
		<input type="text" class="form-control"><span class="input-group-addon">
		<i class="glyphicon glyphicon-th" style="font-size:20px"></i></span>
	</div>
</div>


<div class="form-group has-feedback">
	<label class="col-md-4 control-label" for="timepicker1">Time of Appointment:</label>  
	<div class="col-md-4 input-group time">
		<input id="timepicker1" type="text" class="form-control input-small">
		<span class="addon"><i class="glyphicon glyphicon-time form-control-feedback"></i></span>
	</div>
</div>

<div class="form-group has-feedback">
	<label class="col-md-4 control-label" for="timepicker1">Doctor:</label>  
	<div class="col-md-4">
		<input id="doctor" type="text" class="form-control input-small">
	</div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="reason">Reason for appointment:</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="reason" name="reason"></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="contstraints">Rescheduling Constraints:</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="contstraints" name="contstraints"></textarea>
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
	$('.date').datepicker({
		format: "mm/dd/yyyy",
		weekStart: 0,
		autoclose: true,
		todayHighlight: true
	});
	
	$('.time').timepicker({
		minuteStep: 30
	});
});


@stop