<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class VenueHappyHour extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'venues_happy_hours';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

}
