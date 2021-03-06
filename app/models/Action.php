<?php 

class Action extends Eloquent { 

	public $timestamps = false;
	
	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');
	
	# Relationship method...
    public function incidents() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('Incident');
    }
    
	public static function getIdNamePair() {

		$actions    = Array();

		$collection = Action::all();	

		$actions[]="Select an Action";

	    foreach ($collection as $action) {
	        $actions[$action->id] = $action->description;
	    }  

		return $actions;	
	}
  
}