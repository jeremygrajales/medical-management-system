<?php

//use Illuminate\Auth\UserTrait;
//use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableTrait;
//use Illuminate\Auth\Reminders\RemindableInterface;

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
//, RemindableInterface {

class User extends Eloquent implements ConfideUserInterface { 

	//use UserTrait, RemindableTrait;
	use ConfideUser;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';
	protected $fillable = array('first_name', 'last_name', 'email');

	public function isStaff() {
		return !is_null(Staff::find($this->id));
	}
}


