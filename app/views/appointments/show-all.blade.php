@extends('layouts.master')


@section('content')

@foreach($appointments as $appointment)
	
	<div class="appointment">
		<span class="description">Appointment with {{ $appointment->doctor }}</span>
		<span class="date">{{ date("l, F jS, Y", strtotime($appointment->timestamp)) }}</span>
		<span class="time">{{ date("g:i A", strtotime($appointment->timestamp)) }}</span>
		<span class="status">{{ ucfirst($appointment->status) }}</span>
		<a href="{{ URL::route('appointment.show', array($appointment->id)) }}" class="btn btn-sm btn-primary">Show</a>
		
	</div>
	
@endforeach


@stop 