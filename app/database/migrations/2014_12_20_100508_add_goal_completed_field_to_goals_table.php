<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoalCompletedFieldToGoalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('goals', function($table) {
					# Define foreign keys...

			$table->integer('goal_completed');
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			Schema::table('goals', function($table) {
    $table->dropColumn('goal_completed');
		});
	}

}
