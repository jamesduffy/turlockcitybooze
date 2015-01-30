<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBeerRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$role = new Role();
		$role->name = 'list_beers';
		$role->description = 'List beers';
		$role->save();

		$role = new Role();
		$role->name = 'create_beer';
		$role->description = 'Create beer';
		$role->save();

		$role = new Role();
		$role->name = 'publish_beer';
		$role->description = 'Publish beer';
		$role->save();

		$role = new Role();
		$role->name = 'delete_beer';
		$role->description = 'Delete beer';
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
