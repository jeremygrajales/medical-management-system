<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function($table) {
			$table->increments('id');
			$table->integer('patient_id');
			$table->integer('staff_id');
			$table->string('first_name');
			$table->string('last_name');
			
			$table->string('email')->unique();
            $table->string('username')->unique();
            
			// Confide fields
			$table->string('password');
            $table->string('confirmation_code');
            $table->string('remember_token')->nullable();
            $table->boolean('confirmed')->default(true);
			//$table->string('hash');
			
			$table->timestamp('last_login');
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
		Schema::drop('user');
	}

}
