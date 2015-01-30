<?php

class PageController extends BaseController {

	public function getIndex($slug)
	{
		$data['page'] = DB::table('pages')->where('slug', $slug)->first();

		if (! count($data['page'])) {
			App::abort(404);
		}

		return View::make('pages.view', $data);
	}
	
}
