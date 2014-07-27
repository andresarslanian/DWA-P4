<?php 

class Replacement extends Eloquent { 

	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');

	# Relationship method...
    public function state() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('State');
    }      

	# Relationship method...
    public function lamp() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('Lamp');
    }       

	# Relationship method...
    public function incident() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('Incident');
    }       

	# Relationship method...
    public function user() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('User');
    }       

            
}