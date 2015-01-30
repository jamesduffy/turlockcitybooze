<?php

class BeerController extends BaseController {

	private $aromas = array(
		'malt' => array(
			array('name' => 'malt', 'description' => 'Malt'),
			array('name' => 'malt_bread', 'description' => 'Bread'),
			array('name' => 'malt_cookie', 'description' => 'Cookie'),
			array('name' => 'malt_molasses', 'description' => 'Molasses'),
			array('name' => 'malt_caramel', 'description' => 'Caramel'),
			array('name' => 'malt_grain', 'description' => 'Grain'),
			array('name' => 'malt_hay', 'description' => 'Hay'),
			array('name' => 'malt_straw', 'description' => 'Straw'),
			array('name' => 'malt_cereal', 'description' => 'Cereal'),
			array('name' => 'malt_chocolate', 'description' => 'Chocolate'),
			array('name' => 'malt_toffee', 'description' => 'Toffee'),
			array('name' => 'malt_toasted', 'description' => 'Toasted'),
			array('name' => 'malt_roasted', 'description' => 'Roasted'),
			array('name' => 'malt_burnt', 'description' => 'Burnt'),
			array('name' => 'malt_nutty', 'description' => 'Nutty'),
			array('name' => 'malt_meal', 'description' => 'Meal')
		),
		'hops' => array(
			array('name' => 'hops_flowers', 'description' => 'Folwers'),
			array('name' => 'hops_perfume', 'description' => 'Perfume'),
			array('name' => 'hops_herbs', 'description' => 'Herbs'),
			array('name' => 'hops_celery', 'description' => 'Celery'),
			array('name' => 'hops_grass', 'description' => 'Grass'),
			array('name' => 'hops_pine', 'description' => 'Pine'),
			array('name' => 'hops_spruce', 'description' => 'Spruce'),
			array('name' => 'hops_resin', 'description' => 'Resin'),
			array('name' => 'hops_citris', 'description' => 'Citris'),
			array('name' => 'hops_grapefruit', 'description' => 'Grapefruit'),
			array('name' => 'hops_orange', 'description' => 'Orange'),
			array('name' => 'hops_lemon', 'description' => 'Lemon'),
			array('name' => 'hops_lime', 'description' => 'Lime')
		),
		'yeast' => array(
			array('name' => 'yeast_dough', 'description' => 'Dough'),
			array('name' => 'yeast_sweat', 'description' => 'Sweat'),
			array('name' => 'yeast_horse_blanket', 'description' => 'Horse Blanket'),
			array('name' => 'yeast_barnyard', 'description' => 'Barnyard'),
			array('name' => 'yeast_leather', 'description' => 'Leather'),
			array('name' => 'yeast_soap', 'description' => 'Soap'),
			array('name' => 'yeast_cheese', 'description' => 'Cheese'),
			array('name' => 'yeast_meat', 'description' => 'Meat'),
			array('name' => 'yeast_broth', 'description' => 'Broth'),
			array('name' => 'yeast_earth', 'description' => 'Earth'),
			array('name' => 'yeast_musty', 'description' => 'Musty'),
			array('name' => 'yeast_leaves', 'description' => 'Leaves')
		),
		'misc' => array(
			array('name' => 'misc_banana', 'description' => 'Banana'),
			array('name' => 'misc_bubble_gum', 'description' => 'Bubble Gum'),
			array('name' => 'misc_clove', 'description' => 'Clove'),
			array('name' => 'misc_grape', 'description' => 'Grape'),
			array('name' => 'misc_rasin', 'description' => 'Rasin'),
			array('name' => 'misc_plum', 'description' => 'Plum'),
			array('name' => 'misc_prune', 'description' => 'Prune'),
			array('name' => 'misc_date', 'description' => 'Date'),
			array('name' => 'misc_apple', 'description' => 'Apple'),
			array('name' => 'misc_pear', 'description' => 'Pear'),
			array('name' => 'misc_peach', 'description' => 'Peach'),
			array('name' => 'misc_pineapple', 'description' => 'Pineapple'),
			array('name' => 'misc_cherry', 'description' => 'Cherry'),
			array('name' => 'misc_raspberry', 'description' => 'Raspberry'),
			array('name' => 'misc_cassis', 'description' => 'Cassis'),
			array('name' => 'misc_wine', 'description' => 'Wine'),
			array('name' => 'misc_port', 'description' => 'Port'),
			array('name' => 'misc_cask', 'description' => 'Cask'),
			array('name' => 'misc_wood', 'description' => 'Wood'),
			array('name' => 'misc_toffee', 'description' => 'Toffee'),
			array('name' => 'misc_butter', 'description' => 'Butter'),
			array('name' => 'misc_butterscotch', 'description' => 'Butterscotch'),
			array('name' => 'misc_smoke', 'description' => 'Smoke'),
			array('name' => 'misc_tar', 'description' => 'Tar'),
			array('name' => 'misc_charcoal', 'description' => 'Charcoal'),
			array('name' => 'misc_soy_sauce', 'description' => 'Soy Sauce'),
			array('name' => 'misc_licorice', 'description' => 'Licorice'),
			array('name' => 'misc_cola', 'description' => 'Cola'),
			array('name' => 'misc_honey', 'description' => 'Honey'),
			array('name' => 'misc_brown_sugar', 'description' => 'Brown Sugar'),
			array('name' => 'misc_mayple_syrup', 'description' => 'Mayple Syrup'),
			array('name' => 'misc_vanilla', 'description' => 'Vanilla'),
			array('name' => 'misc_pepper', 'description' => 'Pepper'),
			array('name' => 'misc_allspice', 'description' => 'Allspice'),
			array('name' => 'misc_nutmeg', 'description' => 'Nutmeg'),
			array('name' => 'misc_cinnamon', 'description' => 'Cinnamon'),
			array('name' => 'misc_coriander', 'description' => 'Coriander'),
			array('name' => 'misc_ginger', 'description' => 'Ginger'),
			array('name' => 'misc_tobacco', 'description' => 'Tobacco'),
			array('name' => 'misc_dust ', 'description' => 'Dust'),
			array('name' => 'misc_chalk', 'description' => 'Chalk'),
			array('name' => 'misc_vegetable', 'description' => 'Vegetable'),
			array('name' => 'misc_cooked_corn', 'description' => 'Cooked Corn'),
			array('name' => 'misc_cardboard', 'description' => 'Cardboard'),
			array('name' => 'misc_paper', 'description' => 'Paper'),
			array('name' => 'misc_medicine', 'description' => 'Medicine'),
			array('name' => 'misc_solvent', 'description' => 'Solvent'),
			array('name' => 'misc_bandage', 'description' => 'Bandage'),
			array('name' => 'misc_skunk', 'description' => 'Skunk'),
			array('name' => 'misc_sour_milk', 'description' => 'Sour Milk'),
			array('name' => 'misc_vinegar', 'description' => 'Vinegar'),
			array('name' => 'misc_rotten_eggs', 'description' => 'Rotten Eggs')
		)
	);

	private $selects = array(
		'head_size' => array('' => '', 'spare' => 'Spare', 'small' => 'Small', 'average' => 'Average', 'large' => 'Large', 'huge' => 'Huge'),
		'head_texture' => array('' => '', 'rocky' => 'Rocky', 'creamy' => 'Creamy', 'frothy' => 'Frothy', 'fizzy' => 'Fizzy'),
		'head_color' => array('' => '', 'white' => 'White', 'off-white' => 'Off-White', 'light-brown' => 'Light Brown', 'dark' => 'Dark'),
		'head_duration' => array('' => '', 'lasting' => 'Lasting', 'diminishing' => 'Diminishing'),
		'lacing' => array('' => '', 'excellent' => 'Excellent', 'good' => 'Good', 'fair' => 'Fair', 'spare' => 'Spare'),
		'body' => array('' => '', 'clear' => 'Clear', 'sparkling' => 'Sparkling', 'flat' => 'Flat', 'cloudy' => 'Cloudy', 'hazy' => 'Hazy', 'murky' => 'Murky', 'muddy' => 'Muddy'),
		'particles' => array('' => '', 'lightly cloudy' => 'Lightly Cloudy', 'cloudy' => 'Cloudy', 'heavily particulate' => 'Heavily Particulate', 'muddy' => 'Muddy'),
		'color' => array('' => '', 'light' => 'Light', 'dark' => 'Dark', 'yellow' => 'Yellow', 'amber' => 'Amber', 'orange' => 'Orange', 'red' => 'Red', 'brown' => 'Brown', 'ruby' => 'Ruby', 'black' => 'Black', 'tawny' => 'Tawny'),

		'malt' => array('' => '', 'light' => 'Light', 'average' => 'Average', 'heavy' => 'Heavy', 'harsh' => 'Harsh'),
		'hops' => array('' => '', 'light' => 'Light', 'average' => 'Average', 'heavy' => 'Heavy', 'harsh' => 'Harsh'),
		'yeast' => array('' => '', 'light' => 'Light', 'average' => 'Average', 'heavy' => 'Heavy', 'harsh' => 'Harsh'),

		'palate_body' => array('' => '', 'light' => 'Light', 'medium' => 'Medium', 'full' => 'Full'),
		'palate_texture' => array('' => '', 'thin' => 'Thin', 'oily' => 'Oily', 'creamy' => 'Creamy', 'sticky' => 'Sticky', 'alcoholic' => 'Alcoholic', 'thick' => 'Thick', 'minerals' => 'Minerals', 'gritty' => 'Gritty'),
		'palate_carbonation' => array('' => '', 'fizzy' => 'Fizzy', 'lively' => 'Lively', 'average' => 'Average', 'soft' => 'Soft', 'flat' => 'Flat'),
		'palate_finish' => array('' => '', 'metallic' => 'Metallic', 'chalky' => 'Chalky', 'astringent' => 'Astringent', 'bitter' => 'Bitter'),

		'flavor_duration' => array('' => '', 'short' => 'Short', 'average' => 'Average', 'long' => 'Long'),
		'flavor_sweet' => array('' => '', 'light' => 'Light', 'moderate' => 'Moderate', 'heavy' => 'Heavy', 'harsh' => 'Harsh'),
		'flavor_acidic' => array('' => '', 'light' => 'Light', 'moderate' => 'Moderate', 'heavy' => 'Heavy', 'harsh' => 'Harsh'),
		'flavor_bitter' => array('' => '', 'light' => 'Light', 'moderate' => 'Moderate', 'heavy' => 'Heavy', 'harsh' => 'Harsh'),

		'other' => array('' => '', 'vinegar' => 'Vinegar', 'sour_milk' => 'Sour Milk', 'salty' => 'Salty', 'minerals' => 'Minerals')
	);

	public function getIndex()
	{
		$pagination_count = DB::table('settings')->where('key', 'pagination_count')->pluck('value');

		$data['beers'] = Beer::with('author', 'feature_image')
				->orderBy('name')
				->paginate($pagination_count);
		
		return View::make('beers.list', $data);
	}

	public function getDetail($id, $slug)
	{
		$data['beer'] = Beer::where('id', $id)->with('author.profile_image')->first();

		$data['aromas'] = $this->aromas;
		$data['selects'] = $this->selects;

		if( count($data['beer']) < 1 )
			return Response::view('errors.missing', array(), 404);

		if( urldecode($slug) !== $data['beer']->name ) {
			return Redirect::action('BeerController@getDetail',
				array(
					'id' 	=> $data['beer']->id,
					'slug'	=> urlencode($data['beer']->title)
				));
		}

		return View::make('beers.detail', $data);
	}
	
}
