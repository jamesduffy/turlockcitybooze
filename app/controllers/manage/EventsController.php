<?php
namespace Manage;
use BaseController;

use Auth;
use DB;
use Input;
use Markdown;
use Redirect;
use Request;
use Uploads;
use Validator;
use View;

use Levent;

class EventsController extends BaseController {

	private $rules = array(
				'title' => 'required',
				'status' => 'required',

				'street' => '',
				'city' => '',
				'state' => '',
				'zip' => '',
				
				'start_time' => 'sometimes|date',
				'end_time' => 'sometimes|date',
				
				'body_markdown' => ''
			);

	public function getIndex()
	{
		if(! Auth::user()->can('list_events'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$pagination_count = DB::table('settings')->where('key', 'pagination_count')->pluck('value');

		$data['events'] = Levent::with('author', 'feature_image', 'venue')
			->orderBy('start_time', 'asc')
			->paginate($pagination_count);

		return View::make('manage.events.list', $data);
	}

	public function getCreate()
	{
		if(! Auth::user()->can('create_event'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
		
		$data['users'] 		= $this->getAuthors();
		$data['statuses'] 	= $this->getStatuses();
		$data['venues'] 	= $this->getVenues();

		return View::make('manage.events.create', $data);
	}

	public function postCreate()
	{
		if(! Auth::user()->can('create_event'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$validator = Validator::make(Input::all(), $this->rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/events/create')->withErrors($validator);
		}

		$event = new Levent;
		$event->title = Input::get('title');
		$event->status = Input::get('status');
		$event->created_by_id = Input::get('created_by');
		
		$event->street = Input::get('street');
		$event->city = Input::get('city');
		$event->state = Input::get('state');
		$event->zip = Input::get('zip');
		
		$event->start_time = strtotime(Input::get('start_time'));
		$event->end_time = strtotime(Input::get('end_time'));

		$event->body_markdown = Input::get('body_markdown');
		$event->body_html = Markdown::string( Input::get('body_markdown') );

		if ( Input::hasFile('featured_image') )
		{
			$file = new Uploads;
			$file->filename = str_random(12).'.'.Input::file('featured_image')->getClientOriginalExtension();
			$file->original_name = Input::file('featured_image')->getClientOriginalName();
			$file->mime_type = Input::file('featured_image')->getMimeType();
			$file->size = Input::file('featured_image')->getSize();
			$file->save();

			Input::file('featured_image')->move(public_path().'/files/', $file->filename);

			$event->featured_image_id = $file->id;
		}

		$event->save();

		return Redirect::to('manage/events/edit/'.$event->id)->with('message', 'Event has been created!');
	}

	public function getEdit()
	{
		if(! Auth::user()->can('edit_event'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['users']		= $this->getAuthors();
		$data['statuses']	= $this->getStatuses();
		$data['venues'] 	= $this->getVenues();

		$data['event'] = Levent::findOrFail( Request::segment(4) );

		if( ($data['event']->status == 'published') AND (! Auth::user()->can('publish_event')) )
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to edit a published event.');

		$data['featured_image'] = Uploads::find($data['event']->featured_image_id);

		return View::make('manage.events.edit', $data);
	}

	public function postEdit()
	{
		if(! Auth::user()->can('edit_event'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$event = Levent::findOrFail( Input::get('id') );

		$validator = Validator::make(Input::all(), $this->rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/events/edit/'.Input::get('id'))->withErrors($validator);
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

			$event->featured_image_id = $file->id;
		}

		$event->title = Input::get('title');
		$event->status = Input::get('status');
		$event->created_by_id = Input::get('created_by');

		if (Input::get('venue_id') > 0) {
			$event->venue_id = Input::get('venue_id');
		} else {
			$event->venue_id = null;
		}

		$event->street = Input::get('street');
		$event->city = Input::get('city');
		$event->state = Input::get('state');
		$event->zip = Input::get('zip');
		
		$event->start_time = strtotime(Input::get('start_time'));
		$event->end_time = strtotime(Input::get('end_time'));

		$event->body_markdown = Input::get('body_markdown');
		$event->body_html = Markdown::string( Input::get('body_markdown') );

		$event->save();

		return Redirect::to('manage/events')->with('message', $event->title.' has been updated!');
	}

	public function getTrash()
	{
		if(! Auth::user()->can('delete_event'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

	}

	public function getRestore()
	{
		if(! Auth::user()->can('delete_event'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

	}

	public function getDelete()
	{
		if(! Auth::user()->can('delete_event'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

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

	private function getVenues()
	{
		$venues = DB::table('venues')
			->select('id', 'name')
			->orderBy('name')
			->get();

		$data[''] = '';

		foreach ($venues as $venue) {
			$data[$venue->id] = $venue->name;
		}

		return $data;
	}

}