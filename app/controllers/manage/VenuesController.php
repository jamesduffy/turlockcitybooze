<?php
namespace Manage;
use BaseController;

use Auth;
use DB;
use Markdown;
use Input;
use Redirect;
use Request;
use Validator;
use View;

use Uploads;
use Venue;
use VenueHappyHour;
use VenueMetaItem;

class VenuesController extends BaseController {

	private $days_of_week = array(
			'0' => 'Sunday',
			'1' => 'Monday',
			'2' => 'Tuesday',
			'3' => 'Wednesday',
			'4' => 'Thursday',
			'5' => 'Friday',
			'6' => 'Saturday'
		);

	private $hours = array(
			'1' => '1am',
			'2' => '2am',
			'3' => '3am',
			'4' => '4am',
			'5' => '5am',
			'6' => '6am',
			'7' => '7am',
			'8' => '8am',
			'9' => '9am',
			'10' => '10am',
			'11' => '11am',
			'12' => '12pm',
			'13' => '1pm',
			'14' => '2pm',
			'15' => '3pm',
			'16' => '4pm',
			'17' => '5pm',
			'18' => '6pm',
			'19' => '7pm',
			'20' => '8pm',
			'21' => '9pm',
			'22' => '10pm',
			'23' => '11pm',
			'24' => '12am',
		);

	private $rules = array(
				'name' => 'required',
				'status' => 'required',

				'street' => '',
				'city' => '',
				'state' => '',
				'zip' => '',
								
				'body_markdown' => ''
			);

	public function getIndex()
	{
		if(! Auth::user()->can('list_venues'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$pagination_count = DB::table('settings')->where('key', 'pagination_count')->pluck('value');
		
		$data['venues'] = DB::table('venues')
					->select('venues.*', 'users.first_name', 'users.last_name')
					->leftJoin('users', 'venues.created_by_id', '=', 'users.id')
					->orderBy('name', 'asc')
					->paginate($pagination_count);
		
		return View::make('manage.venues.list', $data);
	}

	public function getCreate()
	{
		if(! Auth::user()->can('create_venue'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$users = DB::table('users')
			->select('id', 'first_name', 'last_name')
			->orderBy('last_name')
			->get();
		foreach ($users as $user) {
			$data['users'][$user->id] = $user->first_name.' '.$user->last_name;
		}

		$data['statuses'] = array(
				'draft' => 'Draft',
				'private' => 'Private'
			);

		if( Auth::user()->can('publish_venue') ) {
			$data['statuses']['published'] = 'Published';
		}

		return View::make('manage.venues.create', $data);
	}

	public function postCreate()
	{
		if(! Auth::user()->can('create_venue'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$validator = Validator::make(Input::all(), $this->rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/venues/create')->withErrors($validator);
		}

		$venue = new Venue;
		$venue->name = Input::get('name');
		$venue->status = Input::get('status');
		$venue->created_by_id = Input::get('created_by');
		
		$venue->street = Input::get('street');
		$venue->city = Input::get('city');
		$venue->state = Input::get('state');
		$venue->zip = Input::get('zip');
		
		$venue->body_markdown = Input::get('body_markdown');
		$venue->body_html = Markdown::string( Input::get('body_markdown') );
		$venue->save();

		return Redirect::to('manage/venues')->with('message', 'Venue has been created!');
	}

	public function getEdit($venue_id)
	{
		if(! Auth::user()->can('edit_venue'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['users'] = $this->getAuthors();
		$data['statuses'] = $this->getStatuses();

		$data['venue'] = Venue::with('author', 'feature_image')
				->findOrFail( $venue_id );

		if( ($data['venue']->status == 'published') AND (! Auth::user()->can('publish_venue')) )
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to edit a published venue.');

		$data['happy_hours'] = DB::table('venues_happy_hours')->where('venue_id', $data['venue']->id)->get();

		return View::make('manage.venues.edit', $data);
	}

	public function postEdit()
	{
		if(! Auth::user()->can('edit_venue'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$venue = Venue::findOrFail( Input::get('id') );

		$validator = Validator::make(Input::all(), $this->rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/venues/edit/'.Input::get('id'))->withErrors($validator);
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

			$venue->featured_image_id = $file->id;
		}

		$venue->name = Input::get('name');
		$venue->status = Input::get('status');
		$venue->created_by_id = Input::get('created_by');
		
		$venue->street = Input::get('street');
		$venue->city = Input::get('city');
		$venue->state = Input::get('state');
		$venue->zip = Input::get('zip');
		
		$venue->body_markdown = Input::get('body_markdown');
		$venue->body_html = Markdown::string( Input::get('body_markdown') );
		$venue->save();

		return Redirect::to('manage/venues/edit/'.$venue->id)->with('message', $venue->name.' has been updated!');
	}

	public function getAddHappyHour($venue_id)
	{
		if(! Auth::user()->can('edit_venue'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['venue'] = Venue::findOrFail( $venue_id );
		$data['happy_hours'] = DB::table('venues_happy_hours')->where('venue_id', $data['venue']->id)->get();

		$data['days_of_week'] = $this->days_of_week;
		$data['hours'] = $this->hours;

		return View::make('manage.venues.add_happy_hour', $data);
	}

	public function postAddHappyHour()
	{
		if(! Auth::user()->can('edit_venue'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$venue = Venue::findOrFail( Input::get('venue_id') );

		$rules = array(
				'venue_id' => 'required|exists:venues,id',

				'start_hour' => 'required',
				'end_hour' => 'required'			
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/venues/add-happy-hour/', $venue->id)->withErrors($validator);
		}

		$venue_happy_hour = new VenueHappyHour;
		$venue_happy_hour->venue_id = Input::get('venue_id');
		$venue_happy_hour->day_of_week = Input::get('day_of_week');
		$venue_happy_hour->start_hour = Input::get('start_hour');
		$venue_happy_hour->end_hour = Input::get('end_hour');
				
		$venue_happy_hour->save();

		return Redirect::to('manage/venues/edit/'.$venue->id)->with('message', $venue->name.' has a new happy hour!');
	}

	public function getDeleteHappyHour($happy_hour_id)
	{
		if(! Auth::user()->can('edit_venue'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$venue_happy_hour = VenueHappyHour::findOrFail( $happy_hour_id );

		$venue_happy_hour->delete();

		return Redirect::to('manage/venues/edit/'.$venue_happy_hour->venue_id)->with('message', 'Happy hour has been deleted!');
	}

	public function getEditMeta($venue_id)
	{
		if(! Auth::user()->can('edit_venue'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['venue'] = Venue::findOrFail( $venue_id );
		$data['meta'] = VenueMetaItem::all(); 

		return View::make('manage.venues.meta', $data);
	}

	public function postEditMeta()
	{
		if(! Auth::user()->can('edit_venue'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$meta = VenueMetaItem::all();

		foreach ($meta as $item) {
			if(Input::has($item->id))
			{
				DB::table('venue_meta')->insert(
					array('venue_id' => Input::get('id'), 'venue_meta_items_id' => $item->id)
				);
			}
			else {
				DB::table('venue_meta')
					->where('venue_id', '=', Input::get('id'))
					->where('venue_meta_items_id', '=', $item->id)
					->delete();
			}
		}

		return Redirect::to('manage/venues/edit/'.Input::get('id'))->with('message', 'Venue\'s meta have been updated.');
	}

	public function getTrash()
	{
		if(! Auth::user()->can('delete_venue'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
	}

	public function getRestore()
	{
		if(! Auth::user()->can('delete_venue'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
	}

	public function getDelete($venue_id)
	{
		if(! Auth::user()->can('delete_venue'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		// Delete happy hours for the venue
		$venue_hours_delete = DB::table('venues_happy_hours')->where('venue_id', $venue_id)->delete();

		$venue = Venue::findOrFail($venue_id);
		$venue->delete();

		return Redirect::to('manage/venues')->with('message', 'Venue has been deleted!');
	}

	// -------------------------------------------------------------

	private function getAuthors()
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

	private function getStatuses()
	{
		$data['statuses'] = array(
				'draft' => 'Draft',
				'private' => 'Private'
			);

		if( Auth::user()->can('publish_event') ) {
			$data['published'] = 'Published';
		}

		return $data;
	}

}