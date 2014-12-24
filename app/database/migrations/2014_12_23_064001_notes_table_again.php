<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotesTableAgain extends Migration {

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

			$table->integer('goals_users_id')->unsigned(); # Important! FK has to be unsigned because the PK it will reference is auto-incrementing
			
			# Define foreign keys...
			$table->foreign('goals_users_id')->references('users_id')->on('goals')->onDelete('cascade');

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
