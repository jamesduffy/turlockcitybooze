<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedBy extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('events', function($table){
			$table->integer('created_by_id')->unsigned()->nullable();
			$table->foreign('created_by_id')->references('id')->on('users');
		});

		Schema::table('venues', function($table){
			$table->integer('created_by_id')->unsigned()->nullable();
			$table->foreign('created_by_id')->references('id')->on('users');
		});

		Schema::table('beers', function($table){
			$table->integer('created_by_id')->unsigned()->nullable();
			$table->foreign('created_by_id')->references('id')->on('users');
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
			$table->dropColumn('created_by_id');
		});

		Schema::table('venues', function($table){
			$table->dropColumn('created_by_id');
		});

		Schema::table('beers', function($table){
			$table->dropColumn('created_by_id');
		});
	}

}
