<?php 

class Incident extends ValidateableEloquent { 

	# For validation
	protected $rules = array(
        'address' 	=> 'required',
        'house_number'  	=> 'required',
        'email'  		=> 'required|email',
        'company_id'  	=> 'required',
        'password'  	=> 'required',
    );


	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');
	
	# Relationship method...
    public function action() {
	    # Tags belongs to many Books
	    return $this->belongsTo('Action');
    }

	# Relationship method...
    public function state() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('State');
    }    


	# Relationship method...
    public function type() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('IncidentType');
    }           
          

	# Relationship method...
    public function reporter() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('User');
    }           

	# Relationship method...
    public function owner() {
	    
	    # Tags belongs to many Books
	    return $this->belongsTo('Company');
    }           
}