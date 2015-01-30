<?php

class UserController extends \BaseController {

	private $remember_me = false;

	public function getDetail($id) {
		$data['user'] = DB::table('users')
				->select('users.*', 'files.filename')
				->leftJoin('files', 'users.profile_image_id', '=', 'files.id')
				->where('users.id', $id)
				->first();

		if( count($data['user']) < 1)
			return Response::view('errors.missing', array(), 404);

		return View::make('users.detail', $data);
	}

	public function getLogin() {
		return View::make('users.login');
	}

	public function postLogin() {
		if(Input::has('remember_me'))
			$this->remember_me = true;

		if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')), $this->remember_me)) {
			return Redirect::intended('manage');
		} else {
			return Redirect::to('login')
				->with('message', 'Your username or password was incorrect')
				->withInput();
		}
	}

	public function getLogout() {
		Auth::logout();

		return Redirect::action('HomeController@getIndex');
	}

	public function getSignup()
	{

	}

	public function postSignup()
	{
		
	}

}
