<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$role = new Role();
		$role->name = 'list_posts';
		$role->description = 'List posts';
		$role->save();

		$role = new Role();
		$role->name = 'create_post';
		$role->description = 'Create post';
		$role->save();

		$role = new Role();
		$role->name = 'edit_post';
		$role->description = 'Edit post';
		$role->save();

		$role = new Role();
		$role->name = 'publish_post';
		$role->description = 'Publish post';
		$role->save();

		$role = new Role();
		$role->name = 'delete_post';
		$role->description = 'Delete post';
		$role->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
