<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Beer extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'beers';

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

}
