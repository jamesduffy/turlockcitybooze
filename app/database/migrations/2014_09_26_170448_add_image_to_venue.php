<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageToVenue extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('files', function($table){
			$table->increments('id');
		    $table->softDeletes();
		    $table->timestamps();

		    $table->string('filename');
		    $table->string('original_name');

		    $table->string('mime_type');
		    $table->string('size');
		});

		Schema::table('venues', function($table){
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
		Schema::table('venues', function($table){
			$table->dropColumn('featured_image_id');
		});

		Schema::dropIfExists('files');
	}

}
