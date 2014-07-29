<?php 

class LampType extends ValidateableEloquent { 

	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');

    public function lamps() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('Lamp');
    }   

	# Relationship method...
    public function incidents() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('Incident');
    }      
}