<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('venues', function($table){
			$table->increments('id');
		    $table->softDeletes();
		    $table->timestamps();

		    $table->string('name');

		    $table->enum('status', array('draft', 'private', 'published'));

		    $table->text('body_markdown');
		    $table->text('body_html');

		    $table->string('street');
		    $table->string('city');
		    $table->string('state');
		    $table->string('zip');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('venues');
	}

}
