@extends('home.layouts.master')


@section('content')


{{ Form::model($appointment, array('route' => array('appointment.edit', $appointment->id), 'method' => 'post')) }}

<a href="{{ URL::route('appointment.status.edit', array($appointment->id, 'status=cancelled')) }}" class="btn btn-sm btn-danger">Cancel Appointment</a>

<div class="form-group">
{{ Form::label('', 'Time of Appointment:') }}
<span class="date">{{ date("l, F jS, Y", strtotime($appointment->timestamp)) }}</span>
<span class="time">{{ date("g:i A", strtotime($appointment->timestamp)) }}</span>
</div>

<div class="form-group">
{{ Form::label('staff', 'Doctor:') }}
{{ Form::select('staff', $staff) }}
</div>

<div class="form-group">
{{ Form::label('constraints', 'Reason for appointment:') }}
Is there a particular condition that you need to be treated for?<br>
{{ Form::textarea('constraints') }}<br>
</div>

<div class="form-group">
{{ Form::label('constraints', 'Rescheduling Contstraints:') }}
If the selected time and date is not available, do you have alternative preferred times and/or dates?<br>
{{ Form::textarea('constraints') }}<br>
</div>

<div class="form-group">
<label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <button class="btn btn-primary">Submit</button>
  </div>
</div>

{{ Form::close() }}

@stop