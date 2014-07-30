<?php 

class Company extends ValidateableEloquent { 
	
	# For validation
	protected $rules = array(
        'name' 	=> 'required',
        'email' => 'required|email',
    );

	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');
	
	# Relationship method...
    public function users() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('User');
    }

	public static function getOwnerIdNamePair() {

		$companies    = Array();

		$collection = Company::all();	

		if (!Auth::check())
			return $companies;

		$companies[]="Select an owner";
		if (Auth::user()->worksFor('Philips')){
			foreach($collection as $company) {
				$companies[$company->id] = $company->name;
			}	
		} else {
			$c = Company::where('name','=','Philips')->first();
			$companies[$c->id] = $c->name;
			$companies[Auth::user()->company->id] = Auth::user()->company->name;
		}

		return $companies;	
	}		        
    
}