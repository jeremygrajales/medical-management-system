<?php

class Comment extends Eloquent  {

	protected $table = 'comment';
	protected  $fillable = array('message');
	
}
