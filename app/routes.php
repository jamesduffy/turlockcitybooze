<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('prefix' => 'manage', 'before' => 'auth'), function() {
	// Force using secure connection when not local
	if (! App::environment('local')) {
		if( ! Request::secure()) {
	        return Redirect::secure(Request::path());
	    }
	}

	Route::controller('beers', 'Manage\BeersController');
	Route::controller('events', 'Manage\EventsController');
	Route::controller('venues', 'Manage\VenuesController');
	Route::controller('posts', 'Manage\PostsController');
	Route::controller('pages', 'Manage\PagesController');
	Route::controller('files', 'Manage\FilesController');
	Route::controller('users', 'Manage\UsersController');
	Route::controller('settings', 'Manage\SettingsController');

	Route::get('dashboard', 'Manage\DashboardController@getIndex');
    
    Route::get('/', function(){
		return Redirect::to('manage/dashboard');
	});
});

Route::group(array('prefix' => 'api'), function(){

	// Beers
	Route::get('beers', 'Api\BeersController@getList');
	Route::get('beers/{beer_id}', 'Api\BeersController@getBeerById');
	Route::post('beers/{beer_id}', 'Api\BeersController@postBeerById');
	Route::get('beers/{beer_id}', 'Api\BeersController@');
	Route::get('beers/{beer_id}', 'Api\BeersController@');
	Route::get('beers/{beer_id}', 'Api\BeersController@');
	Route::get('beers/{beer_id}', 'Api\BeersController@');
	Route::get('beers/{beer_id}', 'Api\BeersController@');
	Route::get('beers/{beer_id}', 'Api\BeersController@');
	Route::get('beers/{beer_id}', 'Api\BeersController@');
	Route::get('beers/{beer_id}', 'Api\BeersController@');

	// Events


	// Pages


	// Posts 


	// Users
	Route::get('users', 'Api\UsersController@getList');
	Route::get('users/{user_id}', 'Api\UsersController@getUserById');
	Route::post('users/{user_id}', 'Api\UsersController@postUserById');
	Route::get('users/{user_id}/avatar', 'Api\UsersController@getAvatar');
	Route::post('users/{user_id}/avatar', 'Api\UsersController@postAvatar');
	Route::get('users/{user_id}/beers', 'Api\UserController@getBeers');
	Route::get('users/{user_id}/events', 'Api\UserController@getEvents');
	Route::get('users/{user_id}/posts', 'Api\UserController@getPosts');
	Route::get('users/{user_id}/venues', 'Api\UserController@getVenues');
});

Route::get('login', 'UserController@getLogin');
Route::post('login', 'UserController@postLogin');
Route::get('logout', 'UserController@getLogout');

Route::get('author/{id}/{first_name?}-{last_name?}', 'UserController@getDetail');

Route::controller('events', 'EventController');
Route::controller('venues', 'VenueController');

Route::get('page/{slug}', 'PageController@getIndex');

Route::get('news', 'PostController@getIndex');
Route::get('post/{id}/{slug?}', 'PostController@getDetail');

Route::get('beer/{id}/{slug?}', 'BeerController@getDetail');
Route::get('beers', 'BeerController@getIndex');

Route::get('sitemap', 'SitemapController@getIndex');
Route::get('/', 'HomeController@getIndex');

// Custom 404 Page
App::missing(function($exception){
    return Response::view('errors.missing', array(), 404);
});
