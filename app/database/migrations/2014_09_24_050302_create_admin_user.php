<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table) {
			$table->dropColumn(array('first-name', 'last-name'));

			$table->string('first_name');
			$table->string('last_name');
		});

		$user = new User;

		$user->email 		= 'admin@turlockcitybooze.com';
		$user->password 	= Hash::make('Mj)gV2^d6mfD%3FuVsG7');
		$user->first_name 	= 'TCB';
		$user->last_name 	= 'Admin';

		$user->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
	}

}
