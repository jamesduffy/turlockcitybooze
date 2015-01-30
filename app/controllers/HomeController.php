<?php

class HomeController extends BaseController {

	public function getIndex()
	{
		$data['curr_happy_hours'] =
			DB::table('venues_happy_hours')
				->select('venues.*', 'files.filename', 'venues_happy_hours.start_hour', 'venues_happy_hours.end_hour')
				->where('day_of_week', date('w'))
				->where('start_hour', '<=', date('G'))
				->where('end_hour', '>', date('G'))
				->where('venues.status', 'published')
				->join('venues', 'venues_happy_hours.venue_id', '=', 'venues.id')
				->leftJoin('files', 'venues.featured_image_id', '=', 'files.id')
				->get();

		$data['recent_news'] =
			Post::with('feature_image')
				->where('status', 'published')
				->orderBy('created_at', 'desc')
				->take(3)
				->get();

		$data['reviewed_beers'] =
			Beer::where('status', 'published')
				->orderBy('created_at', 'desc')
				->take(3)
				->get();

		$data['upcoming_events'] =
			Levent::with('feature_image')
				->where('status', 'published')
				->where('end_time', '>', time())
				->orderBy('start_time', 'asc')
				->orderBy('created_at', 'desc')
				->take(3)
				->get();

		return View::make('homepage', $data);
	}

}
