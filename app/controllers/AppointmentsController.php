<?php

class AppointmentsController extends Controller {

	public function create()
	{
		$user = Confide::user();
		if(Request::isMethod('GET')) {
			$staffMembers = DB::table('doctor_patient')->where('doctor_patient.user_id', '=', $user->id)->join('user', 'doctor_patient.staff_id', '=', 'user.id')->join('staff', 'staff.user_id', '=', 'user.id')->select('user.id', 'first_name', 'last_name', 'position')->get();
			$staff = array();
			$staff[''] = "-- Select a Doctor --";
			foreach($staffMembers as $staffMember) {
				$staff[$staffMember->id] = "Dr. " . $staffMember->first_name . " " . $staffMember->last_name . " " . "(" . $staffMember->position . ")";
			}
			return View::make('home/appointments/create', compact('staff', 'user'));
		}
		elseif(Request::isMethod('POST')) {
			$messages = array();
			$validator = Validator::make(
				Input::all(),
				array(
					'date' => 'required|after:'. date('Y-m-d') .'',
					'time' => 'required',
					'staff_id' => 'required',
					'reason' => 'required',
				),
				array(
					'date.required' => 'You must specify a date for the appointment.',
					'date.after' => 'You must specify a more future date.',
					'time.required' => 'You must specify a time for the appointment.',
					'staff_id.required' => 'You must select a doctor.',
					'reason.required' => 'You must describe a reason for your appointment.',
				)
			);
			
			// Get other errors
			if($validator->fails()) {
				$messageBag = $validator->messages();
				foreach ($messageBag->all(':message<br>') as $message) {
					$messages[] = $message;
				}
			}
			
			if(empty($messages)) {
				// Create a new Appointment with the given data
				$appointment = new Appointment();
				$appointment->fill(Input::all());
				$appointment->patient_id = $user->id;
				$appointment->timestamp = date('Y-m-d H:i:s', strtotime(Input::get('date') . " " . Input::get('time')));
				$appointment->status = 'unconfirmed';
				$appointment->save();
				return Redirect::route('appointment.show.all');
			}
			else {
				// Flash data to session vars to repopulate form later
				Input::flash();
				
				// Compile error messages
				$messages = implode($messages);
				
				return Redirect::route('appointment.create')->with(array('message' => 'Error:<br>' . $messages, 'message_type' => 'error'));
			}
		}
	}
			
	public function show($appointment) {
		$user = Confide::user();
		$staffMembers = DB::table('appointment')
									->join('doctor_patient', 'doctor_patient.user_id', '=', 'appointment.patient_id')
									->join('staff', 'staff.user_id', '=', 'doctor_patient.staff_id')
									->join('user', 'user.id', '=', 'staff.user_id')
									->where('appointment.id', '=', $appointment->id)
									->select('user.id', 'user.first_name', 'user.last_name', 'position')
									->get();
		
		//$staffMembers = DB::table('doctor_patient')->where('doctor_patient.user_id', '=', $user->id)->join('user', 'doctor_patient.staff_id', '=', 'user.id')->join('staff', 'staff.user_id', '=', 'user.id')->select('user.id', 'first_name', 'last_name', 'position')->get();
		$staff = array();
		foreach($staffMembers as $staffMember) {
			$staff[$staffMember->id] = "Dr. " . $staffMember->first_name . " " . $staffMember->last_name . " " . "(" . $staffMember->position . ")";
		}
		
		return View::make('home/appointments/show', compact('user', 'appointment', 'staff'));
	}
	
	public function showAll($requestID=null) {
		$user = Confide::user();
		$patient = Patient::find($requestID);
		$patient = Patient::join('user', 'user.id', '=', 'patient.user_id')->where('patient.user_id', '=', $user->id)->first();
		if($user->isStaff() && $requestID !== null) { // If weare requesting a patient's appointments and we are Staff
			$appointments = Appointment::where('patient_id', '=', $requestID)->get();
			$patient = Patient::join('user', 'user.id', '=', 'patient.user_id')->where('patient.user_id', '=', $requestID)->first();
		}
		else {
			$appointments = Appointment::where('patient_id', '=', $user->id)->get();
		}
		foreach($appointments as $appointment) {
			$doctor = User::find($appointment->staff_id);
			$appointment->doctor = $doctor->first_name . ' ' . $doctor->last_name;
		}
		return View::make('home/appointments/show-all', compact('user', 'appointments', 'patient'));
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
