<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

	public static function getIdNamePair() {

		$roles    = Array();

		$collection = Role::all();	
		if (!Auth::check())
			return $roles;
		$roles[]="Select a role";
		foreach($collection as $role) {
			if (!Auth::user()->hasRole('Super Admin') && $role->name == 'Super Admin')
				continue;
			if ( Auth::user()->hasRole('User') && $role->name == 'Admin')
				continue;			
			$roles[$role->id] = $role->name;
		}	

		return $roles;	
	}	
}