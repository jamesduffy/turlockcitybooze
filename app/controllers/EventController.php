<?php

class EventController extends BaseController {

	public function getIndex()
	{
		$pagination_count = DB::table('settings')->where('key', 'pagination_count')->pluck('value');

		$data['events'] = Levent::with('author', 'feature_image')
				->where('status', 'published')
				->where('end_time', '>', time())
				->orderBy('start_time', 'asc')
				->paginate($pagination_count);

		return View::make('events.list', $data);
	}

	public function getDetail($id, $name)
	{
		$data['event'] = Levent::with('author', 'feature_image', 'venue')
				->where('events.id', $id)
				->first();

		if( $data['event']->status !== 'published')
			return Response::view('errors.missing', array(), 404);

		return View::make('events.detail', $data);
	}
	
}
