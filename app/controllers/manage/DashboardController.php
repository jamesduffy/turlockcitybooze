<?php
namespace Manage;
use BaseController;

use Redirect;
use View;

class DashboardController extends \BaseController {

	public function getIndex()
	{
		//return Redirect::action('HomeController@getIndex');
		return View::make('manage.dashboard.view');
	}

}