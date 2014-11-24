<?php

class Appointment extends Eloquent  {

	protected $table = 'appointment';
	protected  $fillable = array('staff_id', 'reason', 'constraints');
	
}
