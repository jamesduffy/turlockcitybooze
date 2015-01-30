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

use Setting;

class SettingsController extends BaseController {

	public function getIndex()
	{
		if(! Auth::user()->can('list_settings'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['settings'] = DB::table('settings')->orderBy('key', 'asc')->paginate(15);

		return View::make('manage.settings.list', $data);
	}

	public function getCreate()
	{
		if(! Auth::user()->can('create_setting'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		return View::make('manage.settings.create');
	}

	public function postCreate()
	{
		if(! Auth::user()->can('create_setting'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$rules = array(
				'key' => 'required|unique:settings,key',
				'value' => ''
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/settings/create')->withErrors($validator);
		}

		$setting = new Setting;
		$setting->key = Input::get('key');
		$setting->value = Input::get('value');
		$setting->save();

		return Redirect::to('manage/settings');
	}

	public function getEdit()
	{
		if(! Auth::user()->can('edit_setting'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['setting'] = Setting::findOrFail( Request::segment(4) );

		return View::make('manage.settings.edit', $data);
	}

	public function postEdit()
	{
		if(! Auth::user()->can('edit_setting'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$rules = array(
				'id' => 'required|exists:settings',
				'value' => ''
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('settings/edit')->withErrors($validator);
		}

		$setting = Setting::findOrFail( Input::get('id') );
		$setting->value = Input::get('value');
		$setting->save();

		return Redirect::to('manage/settings');
	}

	public function getDelete()
	{
		if(! Auth::user()->can('delete_setting'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$setting = Setting::findOrFail( Request::segment(4) );

		$setting->delete();

		return Redirect::to('manage/settings');
	}

}