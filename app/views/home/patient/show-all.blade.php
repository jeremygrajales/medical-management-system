@extends('home.layouts.master')

@section('content')
	@foreach($patients as $patient)
		<div class="patient">
			<span>{{ $patient->first_name }}</span>
			<span>{{ $patient->last_name }}</span>
			<a href="{{ URL::route('appointment.show.all.id', array($patient->id)) }}" class="btn btn-sm btn-primary">Show Appointments</a>
		</div>
	@endforeach
@stop


