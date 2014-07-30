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

	public static function getIdNamePair() {

		$lamp_types    = Array();

		$collection = LampType::all();	

		$lamp_types[]="Select a Lamp Type";

	    foreach ($collection as $lamp) {
	        $lamp_types[$lamp->id] = $lamp->description;
	    }  

		return $lamp_types;	
	}

}