<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	
	Schema::create('notes', function($table) {
			
			# AI, PK
			$table->increments('id');
			
			# created_at, updated_at columns
			$table->timestamps();
			
			# General data....
			$table->longText('note');

			$table->integer('goal_id')->unsigned(); # Important! FK has to be unsigned because the PK it will reference is auto-incrementing
			
			# Define foreign keys...
			$table->foreign('goal_id')->references('id')->on('goals');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notes');//removing this table
	}
}
