<?php
namespace Manage;
use BaseController;

use Auth;
use DB;
use Input;
use Markdown;
use Redirect;
use Request;
use Validator;
use View;

use Beer;
use Uploads;

class BeersController extends BaseController {

	private $rules = array(
		'status' => 'required',
		'created_by_id' => '',

		'body_markdown' => '',

		'name' => '',
		'brewery' => '',

		'body_markdown' => '',

		'style' => '',
		'abv' => '',
		'ibu' => '',

		'seasonal' => '',
		'bottle' => '',
		'draft' => '',

		'overall_appearance' => '',
		'head_size' => '',
		'head_texture' => '',
		'head_color' => '',
		'head_duration' => '',
		'lacing' => '',
		'body' => '',
		'particles' => '',
		'color' => '',

		'overall_aroma' => '',

		'malt' => '',
		'malt_bread' => '',
		'malt_cookie' => '',
		'malt_molasses' => '',
		'malt_caramel' => '',
		'malt_grain' => '',
		'malt_hay' => '',
		'malt_straw' => '',
		'malt_cereal' => '',
		'malt_chocolate' => '',
		'malt_coffee' => '',
		'malt_toffee' => '',
		'malt_toasted' => '',
		'malt_roasted' => '',
		'malt_burnt' => '',
		'malt_nutty' => '',
		'malt_meal' => '',

		'hops' => '',
		'hops_flowers' => '',
		'hops_perfume' => '',
		'hops_herbs' => '',
		'hops_celery' => '',
		'hops_grass' => '',
		'hops_pine' => '',
		'hops_spruce' => '',
		'hops_resin' => '',
		'hops_citris' => '',
		'hops_grapefruit' => '',
		'hops_orange' => '',
		'hops_lemon' => '',
		'hops_lime' => '',

		'yeast' => '',
		'yeast_dough' => '',
		'yeast_sweat' => '',
		'yeast_horse_blanket' => '',
		'yeast_barnyard' => '',
		'yeast_leather' => '',
		'yeast_soap' => '',
		'yeast_cheese' => '',
		'yeast_meat' => '',
		'yeast_broth' => '',
		'yeast_earth' => '',
		'yeast_musty' => '',
		'yeast_leaves' => '',

		'alcohol' => '',
		'misc_banana' => '',
		'misc_bubble_gum' => '',
		'misc_clove' => '',
		'misc_grape' => '',
		'misc_rasin' => '',
		'misc_plum' => '',
		'misc_prune' => '',
		'misc_date' => '',
		'misc_apple' => '',
		'misc_pear' => '',
		'misc_peach' => '',
		'misc_pineapple' => '',
		'misc_cherry' => '',
		'misc_raspberry' => '',
		'misc_cassis' => '',
		'misc_wine' => '',
		'misc_port' => '',
		'misc_cask' => '',
		'misc_wood' => '',
		'misc_toffee' => '',
		'misc_butter' => '',
		'misc_butterscotch' => '',
		'misc_smoke' => '',
		'misc_tar' => '',
		'misc_charcoal' => '',
		'misc_soy_sauce' => '',
		'misc_licorice' => '',
		'misc_cola' => '',
		'misc_honey' => '',
		'misc_brown_sugar' => '',
		'misc_mayple_syrup' => '',
		'misc_vanilla' => '',
		'misc_pepper' => '',
		'misc_allspice' => '',
		'misc_nutmeg' => '',
		'misc_cinnamon' => '',
		'misc_coriander' => '',
		'misc_ginger' => '',
		'misc_tobacco' => '',
		'misc_dust' => '',
		'misc_chalk' => '',
		'misc_vegetable' => '',
		'misc_cooked_corn' => '',
		'misc_cardboard' => '',
		'misc_paper' => '',
		'misc_medicine' => '',
		'misc_solvent' => '',
		'misc_bandage' => '',
		'misc_skunk' => '',
		'misc_sour_milk' => '',
		'misc_vinegar' => '',
		'misc_rotten_eggs' => '',

		'palate' => '',
		'palate_body' => '',
		'palate_texture' => '',
		'palate_carbonation' => '',
		'palate_finish' => '',

		'flavor' => '',
		'flavor_duration' => '',
		'flavor_sweet' => '',
		'flavor_acidic' => '',
		'flavor_bitter' => '',
		'other' => '',

		'overall' => ''
	);

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

	private $form_selects = array(
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
		if(! Auth::user()->can('list_beers'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$pagination_count = DB::table('settings')->where('key', 'pagination_count')->pluck('value');

		$data['beers'] = DB::table('beers')
			->select('beers.*', 'users.first_name', 'users.last_name')
			->leftJoin('users', 'beers.created_by_id', '=', 'users.id')
			->orderBy('beers.name')
			->paginate($pagination_count);

		return View::make('manage.beers.list', $data);
	}

	public function getCreate()
	{
		if(! Auth::user()->can('create_beer'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['users'] = $this->getAuthors();

		$data['aromas'] = $this->aromas;
		$data['form_selects'] = $this->form_selects;

		$data['statuses'] = $this->GetStatuses();

		return View::make('manage.beers.create', $data);
	}

	public function postCreate()
	{
		if(! Auth::user()->can('create_beer'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$validator = Validator::make(Input::all(), $this->rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/beers/create')->withErrors($validator);
		}

		$beer = new Beer;
		foreach ($this->rules as $name => $rules) {
			$beer->$name = (Input::get($name) ? Input::get($name) : null);
		}
		$beer->body_html = Markdown::string(Input::get('body_markdown'));
		$beer->save();

		return Redirect::to('manage/beers/index')->with('message', 'Beer has been created!');
	}

	public function getEdit($id)
	{
		if(! Auth::user()->can('edit_beer'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['users'] = $this->getAuthors();

		$data['beer'] =
			Beer::with('author', 'feature_image')
				->findOrFail( $id );

		$data['aromas'] = $this->aromas;
		$data['form_selects'] = $this->form_selects;

		$data['statuses'] = $this->getStatuses();

		if( ($data['beer']->status == 'published') AND (! Auth::user()->can('publish_beer')) )
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to edit a published beer.');

		return View::make('manage.beers.edit', $data);
	}

	public function postEdit()
	{
		if(! Auth::user()->can('edit_beer'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$beer = Beer::findOrFail( Input::get('id') );

		$validator = Validator::make(Input::all(), $this->rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/beers/edit/'.Input::get('id'))->withErrors($validator);
		}

		foreach ($this->rules as $name => $rules) {
			$beer->$name = (Input::has($name) ? Input::get($name) : null);
		}

		if ( Input::hasFile('featured_image') )
		{
			$file = new Uploads;
			$file->filename = str_random(12).'.'.Input::file('featured_image')->getClientOriginalExtension();
			$file->original_name = Input::file('featured_image')->getClientOriginalName();
			$file->mime_type = Input::file('featured_image')->getMimeType();
			$file->size = Input::file('featured_image')->getSize();
			$file->save();

			Input::file('featured_image')->move(public_path().'/files/', $file->filename);

			$beer->featured_image_id = $file->id;
		}
		
		$beer->body_html = Markdown::string(Input::get('body_markdown'));
		$beer->save();

		return Redirect::to('manage/beers')->with('message', $beer->name.' has been updated!');
	}

	public function getTrash()
	{
		if(! Auth::user()->can('delete_beer'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

	}

	public function getRestore()
	{
		if(! Auth::user()->can('delete_beer'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

	}

	public function getDelete()
	{
		if(! Auth::user()->can('delete_beer'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

	}

	public function getAuthors()
	{
		$users = DB::table('users')
			->select('id', 'first_name', 'last_name')
			->orderBy('last_name')
			->get();
		foreach ($users as $user) {
			$data[$user->id] = $user->first_name.' '.$user->last_name;
		}

		return $data;
	}

	public function getStatuses()
	{
		$data = array(
				'draft' => 'Draft',
				'private' => 'Private'
			);

		if( Auth::user()->can('publish_beer') ) {
			$data['published'] = 'Published';
		}

		return $data;
	}

}
