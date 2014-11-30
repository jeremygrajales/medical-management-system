@extends('home.layouts.master')


@section('content')


{{ Form::model($appointment, array('class' => 'form-horizontal', 'route' => array('appointment.edit', $appointment->id), 'method' => 'post')) }}
<label>Status:</label> <span style="font-weight:bold" class=" @if($appointment->status=='confirmed')text-green @elseif($appointment->status=='unconfirmed'||$appointment->status=='cancelled')text-red @elseif($appointment->status=='visited')text-blue @endif">{{ ucfirst($appointment->status) }}</span>
@if($appointment->status == 'unconfirmed' || $appointment->status == 'confirmed')
	<a href="{{ URL::route('appointment.status.edit', array($appointment->id, 'status=cancelled')) }}" class="btn btn-sm btn-danger">Cancel Appointment</a>
@endif

@if($user->isStaff())
	@if($appointment->status == 'unconfirmed')
	<a href="{{ URL::route('appointment.status.edit', array($appointment->id, 'status=confirmed')) }}" class="btn btn-sm btn-success">Confirm Appointment</a>
	@elseif($appointment->status == 'confirmed')
	<a href="{{ URL::route('appointment.status.edit', array($appointment->id, 'status=visited')) }}" class="btn btn-sm btn-primary">Mark as Visited</a>
	@endif
@endif

@if($user->isStaff() && $appointment->status != 'cancelled' && $appointment->status != 'visited')
	<div class="form-group">
		<label class="col-md-4 control-label" for="textinput">Date of Appointment:</label>  
		<div class="col-md-4 date input-group">
			<input id="date" name="date" type="text" class="form-control" value="{{ date('m/d/Y', strtotime($appointment->timestamp)) }}"><span class="input-group-addon">
			<i class="glyphicon glyphicon-th" style="font-size:20px"></i></span>
		</div>
	</div>
	<div class="form-group has-feedback">
		<label class="col-md-4 control-label" for="timepicker1">Time of Appointment:</label>
		<div class="col-md-4 time">
			<input id="time" name="time" type="text" class="form-control input-small" value="{{ date('h:i A', strtotime($appointment->timestamp)) }}">
			<span class="addon"><i class="glyphicon glyphicon-time form-control-feedback"></i></span>
		</div>
	</div>
@else
	<div class="form-group">
		{{ Form::label('', 'Time of Appointment:') }}
		<span class="date">{{ date("l, F jS, Y", strtotime($appointment->timestamp)) }}</span>
		<span class="time">{{ date("g:i A", strtotime($appointment->timestamp)) }}</span>
	</div>
@endif

@if($user->isStaff() && $appointment->status != 'cancelled' && $appointment->status != 'visited')
	<div class="form-group">
	{{ Form::label('staff', 'Doctor:') }}
	{{ Form::select('staff', $staff, $appointment->staff_id) }}
	</div>
@else
	<label>Doctor:</label> <span>{{ $staff[$appointment->staff_id] }}</span> 		
@endif

{{ Form::label('reason', 'Reason for appointment:') }}
<p>{{ $appointment->reason }}</p>
{{ Form::label('constraints', 'Rescheduling Contstraints:') }}
<p>{{ $appointment->constraints }}</p>

@if($user->isStaff() && $appointment->status != 'cancelled' && $appointment->status != 'visited')
<div class="form-group">
<label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <button class="btn btn-primary">Update</button>
  </div>
</div>
@endif

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