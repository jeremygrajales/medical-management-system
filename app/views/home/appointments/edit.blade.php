@extends('home.layouts.master')

{{ Form::open(array('route' => 'appointment.request', 'method' => 'post')) }}

Reason for appointment:<br>
Is there a particular condition that you need to be treated for?<br>
{{ Form::textarea('reason', $reason) }}<br>
<br>
Rescheduling Constraints:<br>
If the selected time and date is not available, do you have alternative preferred times and/or dates?<br>
{{ Form::textarea('constraints', $constraints) }}<br>

{{ Form::submit() }}
{{ Form::close() }}