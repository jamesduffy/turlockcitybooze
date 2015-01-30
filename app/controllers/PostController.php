<?php

class PostController extends BaseController {

	public function getIndex()
	{
		$pagination_count =
			DB::table('settings')
				->where('key', 'pagination_count')
				->pluck('value');

		$data['posts'] =
			Post::with('author', 'feature_image')
				->where('status', 'published')
				->orderBy('created_at', 'desc')
				->paginate($pagination_count);
		
		return View::make('posts.list', $data);
	}

	public function getDetail($id, $slug)
	{
		$data['post'] =
			Post::with('author.profile_image', 'feature_image')
				->where('id', $id)
				->where('status', 'published')
				->first();

		if( count($data['post']) < 1 )
			return Response::view('errors.missing', array(), 404);

		if( urldecode($slug) !== $data['post']->title ) {
			return Redirect::action('PostController@getDetail',
				array(
					'id' 	=> $data['post']->id,
					'slug'	=> urlencode($data['post']->title)
				));
		}

		return View::make('posts.detail', $data);
	}
	
}
