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
			$table->string('name');
			$table->string('cc_type');
			$table->string('cc_num', 16);
			$table->integer('cc_code');
			$table->date('cc_exp_date');
			$table->decimal('amount', 8, 2);
			$table->timestamps();
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
