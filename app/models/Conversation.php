<?php

class Conversation extends Eloquent  {

	protected $table = 'conversation';
	protected  $fillable = array('subject', 'message');
	
}
