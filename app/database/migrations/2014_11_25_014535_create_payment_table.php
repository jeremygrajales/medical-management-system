<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payment', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('acct_id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('cc_type');
			$table->integer('cc_num');
			$table->integer('cc_code');
			$table->date('cc_exp_date');
			$table->decimal('amount', 8, 2);
			$table->timestamp('date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payment');
	}

}
