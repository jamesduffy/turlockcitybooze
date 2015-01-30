<?php
namespace Manage;
use BaseController;

use Auth;
use DB;
use Form;
use Hash;
use Input;
use Redirect;
use Request;
use Uploads;
use Validator;
use View;

use Role;
use Markdown;
use User;

class UsersController extends BaseController {

	public function getIndex()
	{
		if(! Auth::user()->can('list_users'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$pagination_count = DB::table('settings')->where('key', 'pagination_count')->pluck('value');
		
		$data['users'] = DB::table('users')
					->orderBy('last_name')
					->paginate($pagination_count);
		
		return View::make('manage.users.list', $data);
	}

	public function getEdit($id)
	{
		$data['user'] = User::findOrFail( $id );
		$data['profile_image'] = Uploads::find($data['user']->profile_image_id);

		if( Auth::id() == $data['user']->id ) {
			if (! Auth::user()->can('edit_self')) {
				return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
			}
		} elseif (! Auth::user()->can('edit_users')) {
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
		}

		return View::make('manage.users.edit', $data);
	}

	public function postEdit()
	{
		$user = User::findOrFail( Input::get('id') );

		if( Auth::id() == $user->id ) {
			if (! Auth::user()->can('edit_self')) {
				return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
			}
		} elseif (! Auth::user()->can('edit_users')) {
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
		}

		$rules = array(
				'id' => 'required|exists:users',
				'email' => 'required',
				'first_name' => 'required',
				'last_name' => 'required',
				'twitter_username' => '',
				'about_markdown' => ''
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/users/edit/'.Input::get('id'))->withErrors($validator);
		}

		if ( Input::hasFile('profile_image') )
		{
			$file = new Uploads;
			$file->filename = str_random(12).'.'.Input::file('profile_image')->getClientOriginalExtension();
			$file->original_name = Input::file('profile_image')->getClientOriginalName();
			$file->mime_type = Input::file('profile_image')->getMimeType();
			$file->size = Input::file('profile_image')->getSize();
			$file->save();

			Input::file('profile_image')->move(public_path().'/files/', $file->filename);

			$user->profile_image_id = $file->id;
		}

		$user->email = Input::get('email');
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->twitter_username = Input::get('twitter_username');
		$user->about_markdown = Input::get('about_markdown');
		$user->about_html = Markdown::string( Input::get('about_markdown') );
		$user->save();

		return Redirect::to('manage/users/edit/'.$user->id)->with('message', 'User has been updated!');
	}

	public function getPasswordUpdate($id)
	{
		$data['user'] = User::findOrFail( $id );

		if( Auth::id() == $data['user']->id ) {
			if (! Auth::user()->can('edit_self')) {
				return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
			}
		} elseif (! Auth::user()->can('edit_users')) {
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
		}

		return View::make('manage.users.updatepassword', $data);
	}

	public function postPasswordUpdate()
	{
		$rules = array(
				'id' => 'required|exists:users',
				'password' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/users/edit/'.Input::get('id'))->withErrors($validator);
		}

		$user = User::findOrFail( Input::get('id') );

		if( Auth::user()->id == $user->id ) {
			if (! Auth::user()->can('edit_self')) {
				return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
			}
		} elseif (! Auth::user()->can('edit_users')) {
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
		}

		$user->password = Hash::make(Input::get('password'));
		$user->save();

		return Redirect::to('manage/users/edit/'.$user->id)->with('message', 'User\'s password has been updated!');
	}

	public function getCreate()
	{
		if(! Auth::user()->can('edit_users'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		return View::make('manage.users.create');
	}

	public function postCreate()
	{
		if(! Auth::user()->can('edit_users'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$rules = array(
				'email' => 'required|unique:users,email',
				'first_name' => 'required',
				'last_name' => 'required',
				'password' => 'required',
				'twitter_username' => '',
				'about_markdown' => ''
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/users/create')->withErrors($validator);
		}

		$user = new User;
		$user->email = Input::get('email');
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');		
		$user->password = Hash::make(Input::get('password'));
		$user->twitter_username = Input::get('twitter_username');
		$user->about_markdown = Input::get('about_markdown');
		$user->about_html = Markdown::string( Input::get('about_markdown') );
		$user->save();

		return Redirect::to('manage/users/edit/'.$user->id)->with('message', 'User has been created!');
	}

	public function getPermissions($user_id)
	{
		if(! Auth::user()->can('edit_users'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['user'] = User::findOrFail( $user_id );
		$data['roles'] = Role::all(); 

		return View::make('manage.users.permissions', $data);
	}

	public function postPermissions()
	{
		if(! Auth::user()->can('edit_users'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$roles = Role::all();

		$rules = array(
				'id' => 'required|exists:users'
			);

		foreach ($roles as $role) {
			if(Input::has($role->id))
			{
				DB::table('users_roles')->insert(
					array('user_id' => Input::get('id'), 'role_id' => $role->id)
				);
			}
			else {
				DB::table('users_roles')
					->where('user_id', '=', Input::get('id'))
					->where('role_id', '=', $role->id)
					->delete();
			}
		}

		return Redirect::to('manage/users/edit/'.Input::get('id'))->with('message', 'User\'s permissions have been updated.');
	}

	public function getDelete()
	{
		if(! Auth::user()->can('edit_users'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
	}

	public function getTrash()
	{
		if(! Auth::user()->can('edit_users'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['users'] = User::onlyTrashed()->get();

		return View::make('manage.users.list', $data);
	}

	public function getRestore()
	{
		if(! Auth::user()->can('edit_users'))
			return Redirect::to('manage/dashboard')->with('message', 'You do not have permission to perform this action.');
	}

}
