<?php
// This is some example code for your controller
// each method corresponds to your use cases
// each method (also, "Action") should respond to at least GET requests (and when needed, POST requests).
// Examples are below.

class BillingController extends Controller {
	
	//Patient only
	public function showPatientBalance($patient=null) {
		
		$user = Confide::user();
		if(!$user->isStaff())
			$patient = $user;
		
		$acct_id = DB::table('account')->where('patient_id', '=', $patient->id)->select('id')->get()[0]->id;
		$account = Account::find($acct_id);
		$payments = DB::table('payment')->where('payment.acct_id', '=', $acct_id)->leftJoin('procedure', 'procedure.acct_id', '=', 'payment.created_at')->select('payment.id', 'payment.created_at', 'procedure.provider', 'procedure.description', 'procedure.charge', 'payment.amount');
		$accountEntries = DB::table('procedure')->where('procedure.acct_id', '=', $acct_id)->leftJoin('payment', 'payment.acct_id', '=', 'procedure.created_at')->select('procedure.id', 'procedure.created_at', 'procedure.provider', 'procedure.description', 'procedure.charge', 'payment.amount')->union($payments)->orderBy('created_at')->get();
		
		// 1.) use sql join table Payment, Procedure desc from date
		//$date
		//$provider
		//$description
		//$charge
		//$payment
		//$balanceAfterEachPayment
		//$totalDue
		
		$entries = array();
		$currentBalance = 0;
		$index = 0;
		foreach($accountEntries as $accountEntry) {
			$entries[$index] = (object)array();
			$entry = $entries[$index];
			$index++;
			$entry->date = $accountEntry->created_at;
			$entry->provider = isset($accountEntry->provider)?$accountEntry->provider:'-';
			$entry->description = isset($accountEntry->description)?$accountEntry->description:'Thank you for your payment';
			$entry->charge = !is_null($accountEntry->charge)?$accountEntry->charge:'-';
			$entry->payment = !is_null($accountEntry->amount)?$accountEntry->amount:'-';
			$currentBalance = $currentBalance + $entry->charge + (-1*$entry->payment);
			$entry->balance = $currentBalance;
		}
		$balance = $currentBalance;
		$account->balance = $balance;
		$account->save();
		
		return View::make('home/billing/show-patient-balance', compact('user', 'entries', 'balance'));
	}
	
	//Staff only
	public function showOutstandingCharges() {
		
		$user = Confide::user();
		$accounts = null;
		
		if(Request::isMethod('GET')) {
			// send user to view search for charges outstanding
			return View::make('home/billing/show-outstanding-charges', compact('user', 'accounts'));
		}
		elseif(Request::isMethod('POST')) {
			// update balances
			
			// Search for account by name
			if(Input::has('list_all')) {
				$accounts = Account::where('balance', '>', 0)->get();
			}
			elseif(Input::has('first_name') || Input::has('last_name')) {
				$patient_id = User::where('first_name', '=', trim(Input::get('first_name')))->where('last_name', '=', trim(Input::get('last_name')))->lists('id');
				if(sizeof($patient_id) > 0)
					$accounts = Account::where('patient_id', '=', $patient_id[0])->where('balance', '>', 0)->get();
			}
			elseif(Input::has('email')) {
				$patient_id = User::where('email', '=', trim(Input::get('email')))->lists('id');
				if(sizeof($patient_id) > 0)
					$accounts = Account::where('patient_id', '=', $patient_id[0])->where('balance', '>', 0)->get();
			}
			// Make accounts null if it is empty
			$accounts = sizeof($accounts)!=0?$accounts:null;
			
			if(!is_null($accounts)) {
				foreach($accounts as $account) {
					$account->user = User::find($account->patient_id);
				}
			}
			
			//search for charges outstanding and will return all patients with a balance > 0
			// they can either search an individual account or all patients with balances > 0	
			/*
			example
			Last name			First name			Amount due
			Orduno				Raul				$20.00
			Z					Jay					$25,0000	
			*/
			
			return View::make('home/billing/show-outstanding-charges', compact('user', 'accounts'));
		}
	}
	//Staff only 
	public function showPayments() {
		$user = Confide::user();
		$from = date('Y-m-d H:i:s', strtotime(Input::get('from')));
		$to = date('Y-m-d H:i:s', strtotime(Input::get('to')));
		$payments = Payment::where('created_at', '>=', $from)->where('created_at', '<=', $to)->orderBy('created_at', 'desc')->get();
		
		// Make payments null if it is empty
		$payments = sizeof($payments)!=0?$payments:null;
		if(!is_null($payments)) {
			foreach($payments as $payment) {
				$payment->user = User::find($payment->user_id);
			}
		}
		return View::make('home/billing/show-payments', compact('user', 'payments'));
	}
	
	//Patient only
	public function makePayment() {
		
		
		$user = Confide::user();
		// GET
		if(Request::isMethod('GET')) {
			// send user to view 'make-payment'
			return View::make('home/billing/make-payment', compact('user'));
		}
		// POST
		elseif(Request::isMethod('POST')) {
			$validator = Validator::make(
				Input::all(),
				array(
					'name' => 'required',
					'cc_type' => 'required',
					'cc_num' => 'required',
					'cc_code' => 'required',
					'cc_exp_date' => 'required',
					'amount' => 'required',
					'agreed' => 'required'
				),
				array(
					'name.required' => 'Name required.',
					'cc_type.required' => 'Card type required.',
					'cc_num.required' => 'Card number required.',
					'cc_code.required' => 'Card code required.',
					'cc_exp_date.required' => 'Expirate date required.',
					'amount.required' => 'Payment ammount required.',
					'agreed.required' => 'You must agree to terms and conditions.'
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
				$payment = new Payment();
				$payment->user_id = $user->id;
				$payment->acct_id = DB::table('account')->where('patient_id', '=', $user->id)->select('id')->get()[0]->id;
				$payment->fill(Input::all());
				$payment->save();
				// return confirmation view
				return View::make('home/billing/confirmation', compact('user'));
			}
			else {
				// Flash data to session vars to repopulate form later
				Input::flash();
				
				// Compile error messages
				$messages = implode($messages);
				
				return Redirect::route('billing.make-payment')->with(array('message' => 'Error:<br>' . $messages, 'message_type' => 'error'));
			}
		}
	}
}
?>