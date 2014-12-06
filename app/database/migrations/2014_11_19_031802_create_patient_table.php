<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patient', function($table) {
			$table->integer('user_id');
			$table->primary('user_id');
			$table->string('ssn');
			$table->date('dob');
			$table->string('address');
			$table->string('city');
			$table->string('state');
			$table->string('zip');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('patient');
	}

}
