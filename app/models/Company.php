<?php 

class Company extends Eloquent { 

	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');
	
	# Relationship method...
    public function users() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('User');
    }
    
}