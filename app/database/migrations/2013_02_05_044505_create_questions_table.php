<?php

use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Questions` table
		Schema::create('questions', function($table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->integer('questionnair_id')->unsigned()->index();
			$table->text('content');
			$table->timestamps();
			$table->foreign('questionnair_id')->references('id')->on('questionnairs')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the `Questions` table
		Schema::drop('questions');
	}

}
