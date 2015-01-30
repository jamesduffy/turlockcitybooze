<?php
namespace Manage;
use BaseController;

use Auth;
use DB;
use Input;
use Redirect;
use Uploads;
use Validator;
use View;

use Markdown;
use Post;

class PostsController extends BaseController {

	private $rules = array(
				'title' => 'required',
				'status' => 'required',
				'created_by_id' => 'required|exists:users,id',
				'body_markdown' => ''
			);

	public function getIndex()
	{
		if(! Auth::user()->can('list_posts'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$pagination_count = DB::table('settings')->where('key', 'pagination_count')->pluck('value');

		$data['posts'] = DB::table('posts')
					->select('posts.*', 'users.first_name', 'users.last_name')
					->leftJoin('users', 'posts.created_by_id', '=', 'users.id')
					->orderBy('created_at', 'desc')
					->paginate($pagination_count);

		return View::make('manage.posts.list', $data);
	}

	public function getCreate()
	{
		if(! Auth::user()->can('create_post'))
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

		if( Auth::user()->can('publish_post') ) {
			$data['statuses']['published'] = 'Published';
		}

		return View::make('manage.posts.create', $data);
	}

	public function postCreate()
	{
		if(! Auth::user()->can('create_post'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');


		$validator = Validator::make(Input::all(), $this->rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/posts/create')->withErrors($validator);
		}

		$post = new Post;
		$post->title = Input::get('title');
		$post->status = Input::get('status');
		$post->created_by_id = Input::get('created_by_id');

		$post->body_markdown = Input::get('body_markdown');
		$post->body_html = Markdown::string( Input::get('body_markdown') );

		if ( Input::hasFile('featured_image') )
		{
			$file = new Uploads;
			$file->filename = str_random(12).'.'.Input::file('featured_image')->getClientOriginalExtension();
			$file->original_name = Input::file('featured_image')->getClientOriginalName();
			$file->mime_type = Input::file('featured_image')->getMimeType();
			$file->size = Input::file('featured_image')->getSize();
			$file->save();

			Input::file('featured_image')->move(public_path().'/files/', $file->filename);

			$post->featured_image_id = $file->id;
		}

		$post->save();

		return Redirect::to('manage/posts')->with('message', 'Post has been created!');
	}

	public function getEdit($id)
	{
		if(! Auth::user()->can('edit_post'))
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

		if( Auth::user()->can('publish_post') ) {
			$data['statuses']['published'] = 'Published';
		}

		$data['post'] = Post::findOrFail( $id );

		if( ($data['post']->status == 'published') AND (! Auth::user()->can('publish_post')) )
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to edit a published venue.');

		$data['featured_image'] = Uploads::find($data['post']->featured_image_id);

		return View::make('manage.posts.edit', $data);
	}

	public function postEdit()
	{
		if(! Auth::user()->can('edit_post'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$post = Post::findOrFail( Input::get('id') );

		$validator = Validator::make(Input::all(), $this->rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/posts/edit/'.Input::get('id'))->withErrors($validator);
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

			$post->featured_image_id = $file->id;
		}

		$post->title = Input::get('title');
		$post->status = Input::get('status');
		$post->created_by_id = Input::get('created_by_id');

		$post->body_markdown = Input::get('body_markdown');
		$post->body_html = Markdown::string( Input::get('body_markdown') );
		$post->save();

		return Redirect::to('manage/posts/edit/'.$post->id)->with('message', '"'.$post->title.'" has been updated!');

	}

	public function getDelete($id)
	{

	}

	public function getTrash()
	{

	}

	public function getRestore($id)
	{

	}

}
