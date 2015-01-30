<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RebuildBeersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('beers');

		Schema::create('beers', function($table){
			$table->increments('id');
		    $table->softDeletes();
		    $table->timestamps();

		    $table->enum('status', array('draft', 'private', 'published'));
		    $table->integer('created_by_id')->unsigned()->nullable();
			$table->foreign('created_by_id')->references('id')->on('users');

		    $table->string('name');
		    $table->string('brewery');
		    
		    $table->text('body_markdown');
		    $table->text('body_html');
		    
		    $table->string('style');
		    $table->string('abv');
		    $table->string('ibu');

		    $table->boolean('seasonal')->nullable();
		    $table->boolean('bottle')->nullable();
		    $table->boolean('draft')->nullable();
		   
		    $table->enum('overall_appearance', array('1', '2', '3', '4', '5'))->nullable();
		    $table->enum('head_size', array('spare', 'small', 'average', 'large', 'huge'))->nullable();
		    $table->enum('head_texture', array('rocky', 'creamy', 'frothy', 'fizzy'))->nullable();
		    $table->enum('head_color', array('white', 'off-white', 'light-brown', 'dark'))->nullable();
		    $table->enum('head_duration', array('lasting', 'diminishing'))->nullable(); 
		    $table->enum('lacing', array('excellent', 'good', 'fair', 'spare'))->nullable();
		    $table->enum('body', array('clear', 'sparkling', 'flat', 'cloudy', 'hazy', 'murky', 'muddy'))->nullable();
		    $table->enum('particles', array('lightly cloudy', 'cloudy', 'heavily particulate', 'muddy'))->nullable();
		    $table->enum('color', array('light', 'dark', 'yellow', 'amber', 'orange', 'red', 'brown', 'ruby', 'black', 'tawny'))->nullable();
		    
		    $table->enum('overall_aroma', array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'))->nullable();
		    
		    $table->enum('malt', array('light', 'average', 'heavy', 'harsh'))->nullable();
		    $table->boolean('malt_bread')->nullable();
		    $table->boolean('malt_cookie')->nullable();
		    $table->boolean('malt_molasses')->nullable();
		    $table->boolean('malt_caramel')->nullable();
		    $table->boolean('malt_grain')->nullable();
		    $table->boolean('malt_hay')->nullable();
		    $table->boolean('malt_straw')->nullable();
		    $table->boolean('malt_cereal')->nullable();
		    $table->boolean('malt_chocolate')->nullable();
		    $table->boolean('malt_coffee')->nullable();
		    $table->boolean('malt_toffee')->nullable();
		    $table->boolean('malt_toasted')->nullable();
		    $table->boolean('malt_roasted')->nullable();
		    $table->boolean('malt_burnt')->nullable();
		    $table->boolean('malt_nutty')->nullable();
		    $table->boolean('malt_meal')->nullable();
		    
		    $table->enum('hops', array('light', 'average', 'heavy', 'harsh'))->nullable();
		    $table->boolean('hops_flowers')->nullable();
		    $table->boolean('hops_perfume')->nullable();
		    $table->boolean('hops_herbs')->nullable();
		    $table->boolean('hops_celery')->nullable();
		    $table->boolean('hops_grass')->nullable();
		    $table->boolean('hops_pine')->nullable();
		    $table->boolean('hops_spruce')->nullable();
		    $table->boolean('hops_resin')->nullable();
		    $table->boolean('hops_citris')->nullable();
		    $table->boolean('hops_grapefruit')->nullable();
		    $table->boolean('hops_orange')->nullable();
		    $table->boolean('hops_lemon')->nullable();
		    $table->boolean('hops_lime')->nullable();
		    
		    $table->enum('yeast', array('light', 'average', 'heavy', 'harsh'))->nullable();
		    $table->boolean('yeast_dough')->nullable();
		    $table->boolean('yeast_sweat')->nullable();
		    $table->boolean('yeast_horse_blanket')->nullable();
		    $table->boolean('yeast_barnyard')->nullable();
		    $table->boolean('yeast_leather')->nullable();
		    $table->boolean('yeast_soap')->nullable();
		    $table->boolean('yeast_cheese')->nullable();
		    $table->boolean('yeast_meat')->nullable();
		    $table->boolean('yeast_broth')->nullable();
		    $table->boolean('yeast_earth')->nullable();
		    $table->boolean('yeast_musty')->nullable();
		    $table->boolean('yeast_leaves')->nullable();

		    $table->enum('alcohol', array('light', 'average', 'heavy'))->nullable();
		    $table->boolean('misc_banana')->nullable();
		    $table->boolean('misc_bubble_gum')->nullable();
		    $table->boolean('misc_clove')->nullable();
		    $table->boolean('misc_grape')->nullable();
		    $table->boolean('misc_rasin')->nullable();
		    $table->boolean('misc_plum')->nullable();
		    $table->boolean('misc_prune')->nullable();
		    $table->boolean('misc_date')->nullable();
		    $table->boolean('misc_apple')->nullable();
		    $table->boolean('misc_pear')->nullable();
		    $table->boolean('misc_peach')->nullable();
		    $table->boolean('misc_pineapple')->nullable();
		    $table->boolean('misc_cherry')->nullable();
		    $table->boolean('misc_raspberry')->nullable();
		    $table->boolean('misc_cassis')->nullable();
		    $table->boolean('misc_wine')->nullable();
		    $table->boolean('misc_port')->nullable();
		    $table->boolean('misc_cask')->nullable();
		    $table->boolean('misc_wood')->nullable();
		    $table->boolean('misc_toffee')->nullable();
		    $table->boolean('misc_butter')->nullable();
		    $table->boolean('misc_butterscotch')->nullable();
		    $table->boolean('misc_smoke')->nullable();
		    $table->boolean('misc_tar')->nullable();
		    $table->boolean('misc_charcoal')->nullable();
		    $table->boolean('misc_soy_sauce')->nullable();
		    $table->boolean('misc_licorice')->nullable();
		    $table->boolean('misc_cola')->nullable();
		    $table->boolean('misc_honey')->nullable();
		    $table->boolean('misc_brown_sugar')->nullable();
		    $table->boolean('misc_mayple_syrup')->nullable();
		    $table->boolean('misc_vanilla')->nullable();
		    $table->boolean('misc_pepper')->nullable();
		    $table->boolean('misc_allspice')->nullable();
		    $table->boolean('misc_nutmeg')->nullable();
		    $table->boolean('misc_cinnamon')->nullable();
		    $table->boolean('misc_coriander')->nullable();
		    $table->boolean('misc_ginger')->nullable();
		    $table->boolean('misc_tobacco')->nullable();
		    $table->boolean('misc_dust')->nullable();
		    $table->boolean('misc_chalk')->nullable();
		    $table->boolean('misc_vegetable')->nullable();
		    $table->boolean('misc_cooked_corn')->nullable();
		    $table->boolean('misc_cardboard')->nullable();
		    $table->boolean('misc_paper')->nullable();
		    $table->boolean('misc_medicine')->nullable();
		    $table->boolean('misc_solvent')->nullable();
		    $table->boolean('misc_bandage')->nullable();
		    $table->boolean('misc_skunk')->nullable();
		    $table->boolean('misc_sour_milk')->nullable();
		    $table->boolean('misc_vinegar')->nullable();
		    $table->boolean('misc_rotten_eggs')->nullable();

		    $table->enum('palate', array('1', '2', '3', '4', '5'))->nullable();
		    $table->enum('palate_body', array('light', 'medium', 'full'))->nullable();
		    $table->enum('palate_texture', array('thin', 'oily', 'creamy', 'sticky', 'alcoholic', 'thick', 'minerals', 'gritty'))->nullable();
		    $table->enum('palate_carbonation', array('fizzy', 'lively', 'average', 'soft', 'flat'))->nullable();
		    $table->enum('palate_finish', array('metallic', 'chalky', 'astringent', 'bitter'))->nullable();

		    $table->enum('flavor', array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'))->nullable();
		    $table->enum('flavor_duration', array('short', 'average', 'long'))->nullable();
		    $table->enum('flavor_sweet', array('light', 'moderate', 'heavy', 'harsh'))->nullable();
		    $table->enum('flavor_acidic', array('light', 'moderate', 'heavy', 'harsh'))->nullable();
		    $table->enum('flavor_bitter', array('light', 'moderate', 'heavy', 'harsh'))->nullable();
		    $table->enum('other', array('vinegar', 'sour_milk', 'salty', 'minerals'))->nullable();

		    $table->enum('overall', array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'))->nullable();
		

		});
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
