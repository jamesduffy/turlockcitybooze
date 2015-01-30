<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('beers', function($table){
			$table->increments('id');
		    $table->softDeletes();
		    $table->timestamps();

		    $table->string('name');
		    $table->string('brewery');
		    
		    $table->text('body_markdown');
		    $table->text('body_html');
		    
		    $table->string('style');
		    $table->string('abv');
		    $table->string('ibu');

		    $table->boolean('seasonal');
		    $table->boolean('bottle');
		    $table->boolean('draft');
		   
		    $table->enum('overall_appearance', array('1', '2', '3', '4', '5'));
		    $table->enum('head_size', array('spare', 'small', 'average', 'large', 'huge'));
		    $table->enum('head_texture', array('rocky', 'creamy', 'frothy', 'fizzy'));
		    $table->enum('head_color', array('white', 'off-white', 'light-brown', 'dark'));
		    $table->enum('head_duration', array('lasting', 'diminishing')); 
		    $table->enum('lacing', array('excellent', 'good', 'fair', 'spare'));
		    $table->enum('body', array('clear', 'sparkling', 'flat', 'cloudy', 'hazy', 'murky', 'muddy'));
		    $table->enum('particles', array('lightly cloudy', 'cloudy', 'heavily particulate', 'muddy'));
		    $table->enum('color', array('light', 'dark', 'yellow', 'amber', 'orange', 'red', 'brown', 'ruby', 'black', 'tawny'));
		    
		    $table->enum('overall_aroma', array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'));
		    
		    $table->enum('malt', array('light', 'average', 'heavy', 'harsh'));
		    $table->boolean('malt_bread');
		    $table->boolean('malt_cookie');
		    $table->boolean('malt_molasses');
		    $table->boolean('malt_caramel');
		    $table->boolean('malt_grain');
		    $table->boolean('malt_hay');
		    $table->boolean('malt_straw');
		    $table->boolean('malt_cereal');
		    $table->boolean('malt_chocolate');
		    $table->boolean('malt_coffee');
		    $table->boolean('malt_toffee');
		    $table->boolean('malt_toasted');
		    $table->boolean('malt_roasted');
		    $table->boolean('malt_burnt');
		    $table->boolean('malt_nutty');
		    $table->boolean('malt_meal');
		    
		    $table->enum('hops', array('light', 'average', 'heavy', 'harsh'));
		    $table->boolean('hops_flowers');
		    $table->boolean('hops_perfume');
		    $table->boolean('hops_herbs');
		    $table->boolean('hops_celery');
		    $table->boolean('hops_grass');
		    $table->boolean('hops_pine');
		    $table->boolean('hops_spruce');
		    $table->boolean('hops_resin');
		    $table->boolean('hops_citris');
		    $table->boolean('hops_grapefruit');
		    $table->boolean('hops_orange');
		    $table->boolean('hops_lemon');
		    $table->boolean('hops_lime');
		    
		    $table->enum('yeast', array('light', 'average', 'heavy', 'harsh'));
		    $table->boolean('yeast_dough');
		    $table->boolean('yeast_sweat');
		    $table->boolean('yeast_horse_blanket');
		    $table->boolean('yeast_barnyard');
		    $table->boolean('yeast_leather');
		    $table->boolean('yeast_soap');
		    $table->boolean('yeast_cheese');
		    $table->boolean('yeast_meat');
		    $table->boolean('yeast_broth');
		    $table->boolean('yeast_earth');
		    $table->boolean('yeast_musty');
		    $table->boolean('yeast_leaves');

		    $table->enum('alcohol', array('light', 'average', 'heavy'));
		    $table->boolean('misc_banana');
		    $table->boolean('misc_bubble_gum');
		    $table->boolean('misc_clove');
		    $table->boolean('misc_grape');
		    $table->boolean('misc_rasin');
		    $table->boolean('misc_plum');
		    $table->boolean('misc_prune');
		    $table->boolean('misc_date');
		    $table->boolean('misc_apple');
		    $table->boolean('misc_pear');
		    $table->boolean('misc_peach');
		    $table->boolean('misc_pineapple');
		    $table->boolean('misc_cherry');
		    $table->boolean('misc_raspberry');
		    $table->boolean('misc_cassis');
		    $table->boolean('misc_wine');
		    $table->boolean('misc_port');
		    $table->boolean('misc_cask');
		    $table->boolean('misc_wood');
		    $table->boolean('misc_toffee');
		    $table->boolean('misc_butter');
		    $table->boolean('misc_butterscotch');
		    $table->boolean('misc_smoke');
		    $table->boolean('misc_tar');
		    $table->boolean('misc_charcoal');
		    $table->boolean('misc_soy_sauce');
		    $table->boolean('misc_licorice');
		    $table->boolean('misc_cola');
		    $table->boolean('misc_honey');
		    $table->boolean('misc_brown_sugar');
		    $table->boolean('misc_mayple_syrup');
		    $table->boolean('misc_vanilla');
		    $table->boolean('misc_pepper');
		    $table->boolean('misc_allspice');
		    $table->boolean('misc_nutmeg');
		    $table->boolean('misc_cinnamon');
		    $table->boolean('misc_coriander');
		    $table->boolean('misc_ginger');
		    $table->boolean('misc_tobacco');
		    $table->boolean('misc_dust');
		    $table->boolean('misc_chalk');
		    $table->boolean('misc_vegetable');
		    $table->boolean('misc_cooked_corn');
		    $table->boolean('misc_cardboard');
		    $table->boolean('misc_paper');
		    $table->boolean('misc_medicine');
		    $table->boolean('misc_solvent');
		    $table->boolean('misc_bandage');
		    $table->boolean('misc_skunk');
		    $table->boolean('misc_sour_milk');
		    $table->boolean('misc_vinegar');
		    $table->boolean('misc_rotten_eggs');

		    $table->enum('palate', array('1', '2', '3', '4', '5'));
		    $table->enum('palate_body', array('light', 'medium', 'full'));
		    $table->enum('palate_texture', array('thin', 'oily', 'creamy', 'sticky', 'alcoholic', 'thick', 'minerals', 'gritty'));
		    $table->enum('palate_carbonation', array('fizzy', 'lively', 'average', 'soft', 'flat'));
		    $table->enum('palate_finish', array('metallic', 'chalky', 'astringent', 'bitter'));

		    $table->enum('flavor', array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'));
		    $table->enum('flavor_duration', array('short', 'average', 'long'));
		    $table->enum('flavor_sweet', array('light', 'moderate', 'heavy', 'harsh'));
		    $table->enum('flavor_acidic', array('light', 'moderate', 'heavy', 'harsh'));
		    $table->enum('flavor_bitter', array('light', 'moderate', 'heavy', 'harsh'));
		    $table->enum('other', array('vinegar', 'sour_milk', 'salty', 'minerals'));

		    $table->enum('overall', array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('beers');
	}

}
