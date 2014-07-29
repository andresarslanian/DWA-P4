<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends ValidateableEloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	# For validation
	protected $rules = array(
        'firstname' 	=> 'required',
        'lastname'  	=> 'required',
        'email'  		=> 'required|email',
        'company_id'  	=> 'exists:companies,id',
        'password'  	=> 'required',
    );

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


	# Relationship method...
    public function incidents() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('Incident');
    }       

	# Relationship method...
    public function reports() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('Incident');
    }  

	# Relationship method...
    public function company() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('Company');
    }    

    public function roles() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('Role');
    }               
}
