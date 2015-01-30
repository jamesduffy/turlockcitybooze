<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesValues extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$role = new Role();
		$role->name = 'list_events';
		$role->description = 'List events';
		$role->save();

		$role = new Role();
		$role->name = 'create_event';
		$role->description = 'Create events';
		$role->save();

		$role = new Role();
		$role->name = 'edit_event';
		$role->description = 'Edit events';
		$role->save();

		$role = new Role();
		$role->name = 'publish_event';
		$role->description = 'Publish events';
		$role->save();

		$role = new Role();
		$role->name = 'delete_event';
		$role->description = 'Delete event';
		$role->save();

		$role = new Role();
		$role->name = 'list_venues';
		$role->description = 'List venues';
		$role->save();

		$role = new Role();
		$role->name = 'create_venue';
		$role->description = 'Create venue';
		$role->save();

		$role = new Role();
		$role->name = 'edit_venue';
		$role->description = 'Edit venue';
		$role->save();

		$role = new Role();
		$role->name = 'publish_venue';
		$role->description = 'Publish venue';
		$role->save();

		$role = new Role();
		$role->name = 'delete_venue';
		$role->description = 'Delete venue';
		$role->save();

		$role = new Role();
		$role->name = 'list_pages';
		$role->description = 'List pages';
		$role->save();

		$role = new Role();
		$role->name = 'create_page';
		$role->description = 'Create page';
		$role->save();

		$role = new Role();
		$role->name = 'edit_page';
		$role->description = 'Edit page';
		$role->save();

		$role = new Role();
		$role->name = 'publish_page';
		$role->description = 'Publish page';
		$role->save();

		$role = new Role();
		$role->name = 'delete_page';
		$role->description = 'Delete page';
		$role->save();

		$role = new Role();
		$role->name = 'list_users';
		$role->description = 'List users';
		$role->save();

		$role = new Role();
		$role->name = 'edit_self';
		$role->description = 'Edit themselves';
		$role->save();

		$role = new Role();
		$role->name = 'edit_users';
		$role->description = 'Edit other users';
		$role->save();

		$role = new Role();
		$role->name = 'list_settings';
		$role->description = 'List settings';
		$role->save();

		$role = new Role();
		$role->name = 'create_setting';
		$role->description = 'Create a setting';
		$role->save();

		$role = new Role();
		$role->name = 'edit_setting';
		$role->description = 'Edit setting';
		$role->save();

		$role = new Role();
		$role->name = 'delete_setting';
		$role->description = 'Delete setting';
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
