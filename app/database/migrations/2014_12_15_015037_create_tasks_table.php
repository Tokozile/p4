<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Creating Table

		Schema::create('tasks', function($table)

		{

			$table->increments('id');//sets primary key and allows it to auto increment
			$table->string('name'); //equivalent to varchar
			$table->timestamps(); //Adds created_at and updated_at columns
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//removes the table...you always have to have an down for an up

		Schema::drop('tasks');
	}

}
