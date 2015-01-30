<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Levent extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'events';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	public function author()
	{
		return $this->hasOne('User', 'id', 'created_by_id');
	}

	public function feature_image()
	{
		return $this->hasOne('Uploads', 'id', 'featured_image_id');
	}

	public function venue()
	{
		return $this->hasOne('Venue', 'id', 'venue_id');
	}

}
