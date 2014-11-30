<?php

class AppointmentsController extends Controller {

	public function create()
	{
		$user = Confide::user();
		if(Request::isMethod('GET')) {
			$staffMembers = DB::table('doctor_patient')->where('doctor_patient.user_id', '=', $user->id)->join('user', 'doctor_patient.staff_id', '=', 'user.id')->join('staff', 'staff.user_id', '=', 'user.id')->select('user.id', 'first_name', 'last_name', 'position')->get();
			$staff = array();
			foreach($staffMembers as $staffMember) {
				$staff[$staffMember->id] = "Dr. " . $staffMember->first_name . " " . $staffMember->last_name . " " . "(" . $staffMember->position . ")";
			}
			return View::make('home/appointments/create', compact('staff'));
		}
		elseif(Request::isMethod('POST')) {
			// Create a new Appointment with the given data
			$appointment = new Appointment();
			$appointment->fill(Input::all());
			$appointment->patient_id = $user->id;
			$appointment->timestamp = date('Y-m-d H:i:s', strtotime(Input::get('date') . " " . Input::get('time')));
			$appointment->status = 'unconfirmed';
			$appointment->save();
			return Redirect::route('appointment.show.all');
		}
	}
	
	public function show($appointment) {
		$staffMembers = Staff::join('user', 'staff.user_id', '=', 'user.id')->select('user_id', 'first_name', 'last_name')->where('position', '=', 'doctor')->get();
		$staff = array();
		foreach($staffMembers as $staffMember) {
			$staff[$staffMember->user_id] = $staffMember->first_name . " " . $staffMember->last_name;
		}
		return View::make('home/appointments/show', compact('appointment', 'staff'));
	}
	
	public function showAll() {
		$user = Confide::user();
		$appointments = Appointment::where('patient_id', '=', $user->id)->get();
		foreach($appointments as $appointment) {
			$doctor = User::find($appointment->staff_id);
			$appointment->doctor = $doctor->first_name . ' ' . $doctor->last_name;
		}
		return View::make('home/appointments/show-all', compact('appointments'));
	}
	
	public function edit() {
	
		return View::make('home/appointments/edit', compact('reason', 'constraints'));
	}
	
	public function changeStatus($appointment) {
		$status = Input::get('status');
		$appointment->status = $status;
		$appointment->save();		
		return Redirect::route('appointment.show', array($appointment->id));
	}
}
