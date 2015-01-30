<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('events', function($table){
			$table->dropColumn('start_year');
			$table->dropColumn('start_month');
			$table->dropColumn('start_day');
			$table->dropColumn('start_hour');
			$table->dropColumn('start_minute');

			$table->dropColumn('end_year');
			$table->dropColumn('end_month');
			$table->dropColumn('end_day');
			$table->dropColumn('end_hour');
			$table->dropColumn('end_minute');

			$table->string('start_time', 15);
			$table->string('end_time', 15);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('events', function($table){
			$table->dropColumn('start_time');
			$table->dropColumn('end_time');

			$table->string('start_year', 4);
			$table->string('start_month', 2);
			$table->string('start_day', 2);
			$table->string('start_hour', 2);
			$table->string('start_minute', 2);

			$table->string('end_year', 4);
			$table->string('end_month', 2);
			$table->string('end_day', 2);
			$table->string('end_hour', 2);
			$table->string('end_minute', 2);
		});
	}

}
