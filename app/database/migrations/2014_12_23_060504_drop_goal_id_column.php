<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropGoalIdColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::table('notes', function($table) {
			# Define foreign keys...

			#$table->dropColumn('goal_id');
			$table->dropColumn('goals_users_id');
			#$table->dropForeign('goals_users_id')->references('users_id')->on('goals');
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
