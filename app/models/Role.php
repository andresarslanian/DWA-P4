<?php 

class Role extends Eloquent { 

	public $timestamps = false;
	
	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');
	
	# Relationship method...
    public function user_roles() {
	    
	    # Tags belongs to many Books
	    return $this->hasMany('UserRoles');
    }
    
}