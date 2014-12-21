<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		

		Schema::create('users', function($table) {

	    	$table->increments('id');
		    $table->string('email')->unique(); //user email must be unique
		    $table->string('remember_token',100);//holds token that gets passed through blade
		    $table->string('password');
		    $table->string('first_name');
		    $table->string('last_name');
		    $table->string('picture_url'); //so users can have profile pictures...time allowing
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
		Schema::drop('users');		//removes users table
	}

}
