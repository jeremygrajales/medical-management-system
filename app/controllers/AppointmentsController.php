<?php

class AppointmentsController extends BaseController {

	public function create()
	{
		if(Request::isMethod('GET')) {
			$staffMembers = Staff::join('user', 'staff.user_id', '=', 'user.id')->select('user_id', 'first_name', 'last_name'	)->where('position', '=', 'doctor')->get();
			$staff = array();
			foreach($staffMembers as $staffMember) {
				$staff[$staffMember->user_id] = $staffMember->first_name . " " . $staffMember->last_name;
			}
			return View::make('appointments/create', compact('staff'));
		}
		elseif(Request::isMethod('POST')) {
			// Create a new Appointment with the given data
			$appointment = new Appointment();
			$appointment->fill(Input::all());
			$appointment->timestamp = date('Y-m-d H:i:s', strtotime(Input::get('date') . " " . Input::get('time')));
			$appointment->status = 'unconfirmed';
			$appointment->save();
			return View::make('appointments/create');
		}
	}
	
	public function show($appointment) {
		$staffMembers = Staff::join('user', 'staff.user_id', '=', 'user.id')->select('user_id', 'first_name', 'last_name'	)->where('position', '=', 'doctor')->get();
		$staff = array();
		foreach($staffMembers as $staffMember) {
			$staff[$staffMember->user_id] = $staffMember->first_name . " " . $staffMember->last_name;
		}
		return View::make('appointments/show', compact('appointment', 'staff'));
	}
	
	public function showAll() {
		$appointments = Appointment::where('patient_id', '=', '3')->get();
		foreach($appointments as $appointment) {
			$doctor = User::find($appointment->staff_id);
			$appointment->doctor = $doctor->first_name . ' ' . $doctor->last_name;
		}
		return View::make('appointments/show-all', compact('appointments'));
	}
	
	public function edit() {
	
		return View::make('appointments/edit', compact('reason', 'constraints'));
	}
	
	public function changeStatus($appointment) {
		$status = Input::get('status');
		$appointment->status = $status;
		$appointment->save();		
		return Redirect::route('appointment.show', array($appointment->id));
	}
}
