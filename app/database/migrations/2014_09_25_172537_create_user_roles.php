<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(
            'roles',
            function ($table) {
                $table->increments('id');
                $table->softDeletes();
		    	$table->timestamps();
                
                $table->string('name');
                $table->text('description');
            }
        );

        Schema::create(
            'users_roles',
            function ($table) {
                $table->increments('id');
                $table->softDeletes();
		    	$table->timestamps();
		    	
                $table->integer('user_id');
                $table->integer('role_id');
            }
        );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('roles');
		Schema::dropIfExists('users_roles');
	}

}
