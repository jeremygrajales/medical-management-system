<?php

class PatientController extends Controller {

	public function create()
	{
		$user = Confide::user();
		//throw new Exception($user);
		if(Request::isMethod('GET')) {
			$patient = Patient::find($user->id);
			return View::make('home/patient/create', compact('user', 'patient'));
		}
		elseif(Request::isMethod('POST')) {
			// Create a new Appointment with the given data
			$user = Confide::user();
			$user->fill(Input::all());
			$user->save();
			
			// If patient already exists in system
			$patient = Patient::find($user->id);
			if($patient != null) {
				// Retreive Patient
				
			}
			else {
				// Create a new Patient
				$patient = new Patient();
				$patient->fill(Input::all());
				//$patient->dob = new Date();
				$patient->user_id = $user->id;
				$patient->save();
			}
			return Redirect::route('home.index');
		}
	}
}
