<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreMetaToVenues extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(
            'venue_meta_items',
            function ($table) {
                $table->increments('id');
                $table->softDeletes();
		    	$table->timestamps();
                
                $table->string('name');
                $table->text('description');
            }
        );

        Schema::create(
            'venue_meta',
            function ($table) {
                $table->increments('id');
                $table->softDeletes();
		    	$table->timestamps();
		    	
                $table->integer('venue_id');
                $table->integer('venue_meta_items_id');
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
		Schema::dropIfExists('venue_meta');
		Schema::dropIfExists('venue_meta_items');
	}

}
