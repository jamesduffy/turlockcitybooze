<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilesPermissions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$role = new Role();
		$role->name = 'list_files';
		$role->description = 'List files';
		$role->save();

		$role = new Role();
		$role->name = 'upload_file';
		$role->description = 'Upload file';
		$role->save();

		$role = new Role();
		$role->name = 'delete_file';
		$role->description = 'Delete file';
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
