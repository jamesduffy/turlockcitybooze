<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function($table){
			$table->increments('id');
		    $table->softDeletes();
		    $table->timestamps();

		    $table->string('title');
		    $table->string('slug');

		    $table->enum('status', array('draft', 'private', 'published'));

		    $table->text('body_markdown');
		    $table->text('body_html');

		    $table->unique('slug');
		    $table->index('slug');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('pages');
	}

}
