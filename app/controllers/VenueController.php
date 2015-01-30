<?php

class VenueController extends BaseController {

	public function getIndex()
	{
		$pagination_count = DB::table('settings')->where('key', 'pagination_count')->pluck('value');

		$data['venues'] = Venue::with('author', 'feature_image')
				->where('status', 'published')
				->orderBy('name', 'asc')
				->paginate($pagination_count);

		return View::make('venues/list', $data);
	}

	public function getDetail($id, $name)
	{
		$data['venue'] =
			Venue::with('feature_image', 'author', 'meta')
				->where('id', $id)
				->where('status', 'published')
				->first();

		if( count($data['venue']) < 1 )
			return Response::view('errors.missing', array(), 404);

		$data['happy_hours'] = DB::table('venues_happy_hours')
			->where('venue_id', $data['venue']->id)
			->orderBy('day_of_week', 'asc')
			->get();

		return View::make('venues.detail', $data);
	}
	
}
