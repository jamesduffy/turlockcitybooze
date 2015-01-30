<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function($table){
			$table->increments('id');
		    $table->softDeletes();
		    $table->timestamps();

		    $table->enum('status', array('draft', 'private', 'published'));

		    $table->string('title');
		    $table->string('slug');

		    $table->text('body_markdown')->nullable();
		    $table->text('body_html')->nullable();

		    $table->integer('featured_image_id')->unsigned()->nullable();
			$table->foreign('featured_image_id')->references('id')->on('files');

			$table->integer('created_by_id')->unsigned()->nullable();
			$table->foreign('created_by_id')->references('id')->on('users');

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
		Schema::dropIfExists('posts');
	}

}
