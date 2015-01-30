<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function($table){
			$table->increments('id');
		    $table->softDeletes();
		    $table->timestamps();

		    $table->string('title');

		    $table->enum('status', array('draft', 'private', 'published'));

		    $table->text('body_markdown');
		    $table->text('body_html');

		    $table->string('street');
		    $table->string('city');
		    $table->string('state');
		    $table->string('zip');

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

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('events');
	}

}
