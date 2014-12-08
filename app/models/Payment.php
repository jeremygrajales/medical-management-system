<?php

class Payment extends Eloquent  {

	protected $table = 'payment';
	protected $fillable = array('name', 'cc_type', 'cc_num', 'cc_code', 'cc_exp_date', 'amount');
	
}
