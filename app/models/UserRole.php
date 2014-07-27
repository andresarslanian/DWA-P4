<?php 

class UserRole extends Eloquent { 

	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');
	
	# Relationship method...
    public function user() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('User');
    }
    public function role() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('Role');
    }
    
}