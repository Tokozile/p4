<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	//Creating Table

		Schema::create('goals', function($table)

		{

			$table->increments('id');//sets primary key and allows it to auto increment

			$table->timestamps(); //Adds created_at and updated_at columns

			$table->string('name'); //equivalent to varchar

			$table->mediumText('description'); //Add description for goals


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

		Schema::drop('goals');
	}
}
