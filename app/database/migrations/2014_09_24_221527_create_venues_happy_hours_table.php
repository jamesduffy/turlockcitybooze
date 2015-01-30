<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuesHappyHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('venues_happy_hours', function($table){
			$table->increments('id');
		    $table->softDeletes();
		    $table->timestamps();

		    $table->integer('venue_id')->unsigned();
			$table->foreign('venue_id')->references('id')->on('venues');

		    $table->integer('day_of_week')->unsigned();
		    $table->integer('start_hour')->unsigned();
		    $table->integer('end_hour')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('venues_happy_hours');
	}

}
