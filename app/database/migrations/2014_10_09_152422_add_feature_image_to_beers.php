<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeatureImageToBeers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('beers', function($table){
			$table->integer('featured_image_id')->unsigned()->nullable();
			$table->foreign('featured_image_id')->references('id')->on('files');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('beers', function($table){
			$table->dropColumn('featured_image_id');
		});
	}

}
