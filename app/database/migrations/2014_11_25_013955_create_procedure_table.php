<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('procedure', function($table) {
			$table->increments('id');
			$table->integer('acct_id');
			$table->integer('user_id');
			$table->string('provider');
			$table->text('description');
			$table->decimal('charge', 8, 2);
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
		Schema::drop('procedure');
	}

}
