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

	public static function getIdNamePair() {

		$states    = Array();

		$collection = State::all();	

		$states = [];

	    foreach ($collection as $state) {
	        $states[$state->id] = $state->description;
	    }  

		return $states;	
	}
	    
}