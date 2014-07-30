<?php 

class Lamp extends ValidateableEloquent { 

	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');

    public function replacements() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('Replacement');
    }   

	# Relationship method...
    public function type() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('LampType');
    }

	# Relationship method...
    public function state() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('LampState');
    }          
}