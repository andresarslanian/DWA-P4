<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedAssignedRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		$u1 = DB::table('users')
		->select('id')
		->where('firstname', 'Andres')
		->first()
		->id;
		$u2 = DB::table('users')
		->select('id')
		->where('firstname', 'Robert')
		->first()
		->id;
		$u3 = DB::table('users')
		->select('id')
		->where('firstname', 'Mark')
		->first()
		->id;		
		$u4 = DB::table('users')
		->select('id')
		->where('firstname', 'Mary')
		->first()
		->id;

		$super_admin = DB::table('roles')
		->select('id')
		->where('name', 'Super Admin')
		->first()
		->id;

		$admin_role = DB::table('roles')
		->select('id')
		->where('name', 'Admin')
		->first()
		->id;

		$user_role = DB::table('roles')
		->select('id')
		->where('name', 'User')
		->first()
		->id;

		$viewer_role = DB::table('roles')
		->select('id')
		->where('name', 'Viewer')
		->first()
		->id;
		DB::table('assigned_roles')->insert(
			array(
				array('user_id' => $u1,  'role_id'=> $super_admin),
				array('user_id' => $u2,  'role_id'=> $user_role),
				array('user_id' => $u3,  'role_id'=> $admin_role),
				array('user_id' => $u4,  'role_id'=> $viewer_role),
				)	
			);	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('assigned_roles')->delete();
	}

}
