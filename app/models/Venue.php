<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Venue extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'venues';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	/**
     * Get the meta a venue has
     */
    public function meta()
    {
        return $this->belongsToMany('VenueMetaItem', 'venue_meta', 'venue_id', 'venue_meta_items_id');
    }
 
    /**
     * Find out if venue has a specific meta
     *
     * $return boolean
     */
    public function has_meta($check)
    {
        return in_array($check, array_fetch($this->meta->toArray(), 'name'));
    }
 
    /**
     * Get key in array with corresponding value
     *
     * @return int
     */
    private function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value) {
            if ($value == $term) {
                return $key;
            }
        }
 
        throw new UnexpectedValueException;
    }

	public function author()
	{
		return $this->hasOne('User', 'id', 'created_by_id');
	}

	public function feature_image()
	{
		return $this->hasOne('Uploads', 'id', 'featured_image_id');
	}

}
