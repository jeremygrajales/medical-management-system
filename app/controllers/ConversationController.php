<?php

class ConversationController extends Controller {

	public function create($recipient=null)
	{
		$user = Confide::user();
		$users = array();
		$userModels = null;
		if($user->isStaff()) {
			$userModels = DB::table('doctor_patient')->where('doctor_patient.staff_id', '=', $user->id)->join('user', 'doctor_patient.user_id', '=', 'user.id')->select('user.id', 'first_name', 'last_name')->get();
			$users[''] = "-- Select a Patient --";
		}
		else {
			$userModels = DB::table('doctor_patient')->where('doctor_patient.user_id', '=', $user->id)->join('user', 'doctor_patient.staff_id', '=', 'user.id')->select('user.id', 'first_name', 'last_name')->get();
			$users[''] = "-- Select a Doctor --";	
		}
		
		// Create users array
		foreach($userModels as $userModel) {
			if($user->isStaff())
				$users[$userModel->id] = $userModel->first_name . " " . $userModel->last_name;
			else
				$users[$userModel->id] = "Dr. " . $userModel->first_name . " " . $userModel->last_name;
		}
		
		if(Request::isMethod('GET')) {
			return View::make('home/conversation/create', compact('user', 'users', 'recipient'));
		}
		elseif(Request::isMethod('POST')) {
			$messages = array();
			$validator = Validator::make(
				Input::all(),
				array(
					'user_id' => 'required',
					'subject' => 'required',
					'message' => 'required',
				),
				array(
					'user_id.required' => 'You must select a recipient.',
					'subject.required' => 'You must include a subject.',
					'messages.required' => 'You must include a message.',
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
				$conversation = new Conversation();
				$conversation->fill(Input::all());
				$conversation->sender = $user->id;
				$conversation->receiver = Input::get('user_id');
				$conversation->save();
				return Redirect::route('conversation.show.all');
			}
			else {
				// Flash data to session vars to repopulate form later
				Input::flash();
				
				// Compile error messages
				$messages = implode($messages);
				
				return Redirect::route('conversation.create')->with(array('message' => 'Error:<br>' . $messages, 'message_type' => 'error'));
			}
		}
	}
			
	public function show($conversation) {
		$user = Confide::user();
		$comments = Comment::where('conversation_id', '=', $conversation->id)->orderBy('created_at', 'asc')->get();
		$conversation->sender = User::find($conversation->sender);
		$conversation->receiver = User::find($conversation->receiver);
		foreach($comments as $comment) {
			$comment->user = User::find($comment->user_id);
		}
		return View::make('home/conversation/show', compact('user', 'conversation', 'comments'));
	}
	
	public function showAll() {
		$user = Confide::user();
		$conversations = Conversation::where('sender', '=', $user->id)->orWhere('receiver', '=', $user->id)->orderBy('created_at', 'desc')->get();
		foreach($conversations as $conversation) {
			$conversation->sender = User::find($conversation->sender);
			$conversation->receiver = User::find($conversation->receiver);
		}
		return View::make('home/conversation/show-all', compact('user', 'conversations'));
	}
	
	public function createComment($conversation) {
		$user = Confide::user();
		$comment = new Comment();
		$comment->conversation_id = $conversation->id;
		$comment->user_id = $user->id;
		$comment->fill(Input::all());
		$comment->save();
		return Redirect::route('conversation.show', array($conversation->id));
	}
}
