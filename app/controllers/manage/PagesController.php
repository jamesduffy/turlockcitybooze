<?php
namespace Manage;
use BaseController;

use Auth;
use DB;
use Form;
use Input;
use Redirect;
use Request;
use Validator;
use View;

use Markdown;
use Page;

class PagesController extends BaseController {

	public function getIndex()
	{
		if(! Auth::user()->can('list_pages'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$pagination_count = DB::table('settings')->where('key', 'pagination_count')->pluck('value');

		$data['pages'] = DB::table('pages')->paginate($pagination_count);

		return View::make('manage.pages.list', $data);
	}

	public function getCreate()
	{
		if(! Auth::user()->can('create_page'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['statuses'] = array(
				'draft' => 'Draft',
				'private' => 'Private',
				'published' => 'Published'
			);

		return View::make('manage.pages.create', $data);
	}

	public function postCreate()
	{
		if(! Auth::user()->can('create_page'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$rules = array(
				'title' => 'required',
				'slug' => 'required|unique:pages,slug',
				'status' => 'required',
				'body_markdown' => ''
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/pages/create')->withErrors($validator);
		}

		$page = new Page;
		$page->title = Input::get('title');
		$page->slug = Input::get('slug');
		$page->status = Input::get('status');		
		$page->body_markdown = Input::get('body_markdown');
		$page->body_html = Markdown::string( Input::get('body_markdown') );
		$page->save();

		return Redirect::to('manage/pages')->with('message', 'Page has been created!');
	}

	public function getEdit()
	{
		if(! Auth::user()->can('edit_page'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['statuses'] = array(
				'draft' => 'Draft',
				'private' => 'Private',
				'published' => 'Published'
			);

		$data['page'] = Page::findOrFail( Request::segment(4) );

		return View::make('manage.pages.edit', $data);
	}

	public function postEdit()
	{
		if(! Auth::user()->can('edit_page'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$page = Page::findOrFail( Input::get('id') );

		$rules = array(
				'title' => 'required',
				'slug' => 'required|unique:pages,slug,'.$page->id,
				'status' => 'required',
				'body_markdown' => ''
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/users/edit/'.Input::get('id'))->withErrors($validator);
		}

		$page->title = Input::get('title');
		$page->slug = Input::get('slug');
		$page->status = Input::get('status');		
		$page->body_markdown = Input::get('body_markdown');
		$page->body_html = Markdown::string( Input::get('body_markdown') );
		$page->save();

		return Redirect::to('manage/pages')->with('message', $page->title.' page has been updated!');
	}

	public function getDelete()
	{
		if(! Auth::user()->can('delete_page'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

	}
	
}
