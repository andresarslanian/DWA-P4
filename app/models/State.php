<?php 

class State extends Eloquent { 

	public $timestamps = false;
	
	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');
	
	# Relationship method...
    public function incidents() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('Incident');
    }
    public function replacements() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('Replacement');
    }
    
}