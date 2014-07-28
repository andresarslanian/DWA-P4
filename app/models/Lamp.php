<?php 

class Lamp extends ValidateableEloquent { 

	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');

    public function replacements() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('Replacement');
    }    
}