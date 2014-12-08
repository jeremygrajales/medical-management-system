<?php

class Patient extends Eloquent  {

	protected $table = 'patient';
	protected $fillable = array('ssn', 'dob', 'address', 'city', 'state', 'zip');
	public $timestamps = false;
	protected $primaryKey = 'user_id';
}
