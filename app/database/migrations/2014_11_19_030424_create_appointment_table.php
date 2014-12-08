<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointment', function($table) {
			$table->increments('id');
			$table->integer('patient_id');
			$table->integer('staff_id');
			$table->string('reason');
			$table->string('constraints');
			$table->timestamp('timestamp');
			$table->enum('status', array('unconfirmed', 'confirmed', 'visited', 'cancelled'));
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
		Schema::drop('appointment');
	}

}
