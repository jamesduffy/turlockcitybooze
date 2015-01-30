<?php
namespace Manage;
use BaseController;

use Auth;
use Input;
use Redirect;
use View;

use Uploads;

class FilesController extends BaseController {

	public function getIndex()
	{
		if(! Auth::user()->can('list_files'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['files'] = Uploads::all();

		return View::make('manage.files.list', $data);
	}

	public function getUpload()
	{
		if(! Auth::user()->can('upload_file'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		return View::make('manage.files.upload');
	}

	public function postUpload()
	{
		if(! Auth::user()->can('upload_file'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		if ( Input::hasFile('file') )
		{
			$file = new Uploads;
			$file->filename = str_random(12).'.'.Input::file('file')->getClientOriginalExtension();
			$file->mime_type = Input::file('file')->getMimeType();
			$file->size = Input::file('file')->getSize();
			$file->save();

			Input::file('file')->move(public_path().'/files/', $file->filename);
		}

		return Redirect::to('manage/files');
	}

	public function getDelete()
	{
		if(! Auth::user()->can('delete_file'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
	}

}