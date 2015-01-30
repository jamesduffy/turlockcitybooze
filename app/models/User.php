<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
     * Get the roles a user has
     */
    public function roles()
    {
        return $this->belongsToMany('Role', 'users_roles');
    }
 
    /**
     * Find out if User is an employee, based on if has any roles
     *
     * @return boolean
     */
    public function isStaff()
    {
        $roles = $this->roles->toArray();
        return !empty($roles);
    }
 
    /**
     * Find out if user has a specific role
     *
     * $return boolean
     */
    public function can($check)
    {
        return in_array($check, array_fetch($this->roles->toArray(), 'name'));
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

    public function profile_image()
    {
        return $this->hasOne('Uploads', 'id', 'profile_image_id');
    }

}
