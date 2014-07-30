<?php 

class IncidentType extends Eloquent { 

	public $timestamps = false;
	
	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');
	
	# Relationship method...
    public function incidents() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('Incident');
    }
    

	public static function getIdNamePair() {

		$incidents    = Array();

		$collection = IncidentType::all();	

		$incidents[]="Select a type";

	    foreach ($collection as $incident) {
	        $incidents[$incident->id] = $incident->description;
	    }  

		return $incidents;	
	}
 
}