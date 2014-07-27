<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedUserRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$admin_role = DB::table('roles')
                            ->select('id')
                            ->where('role', 'admin')
                            ->first()
                            ->id;

		$user_role = DB::table('roles')
                            ->select('id')
                            ->where('role', 'user')
                            ->first()
                            ->id;

		$viewer_role = DB::table('roles')
                            ->select('id')
                            ->where('role', 'viewer')
                            ->first()
                            ->id;

		$user1 = DB::table('users')
                            ->select('id')
                            ->where('firstname', 'Andres')
                            ->first()
                            ->id;                            
		$user2 = DB::table('users')
                            ->select('id')
                            ->where('firstname', 'Robert')
                            ->first()
                            ->id;                            
		$user3 = DB::table('users')
                            ->select('id')
                            ->where('firstname', 'Mark')
                            ->first()
                            ->id;                            
		$user4 = DB::table('users')
                            ->select('id')
                            ->where('firstname', 'Mary')
                            ->first()
                            ->id;                
		
		DB::table('user_roles')->insert(
			array(
				array('user_id' => $user1, 'role_id' => $admin_role),
				array('user_id' => $user2, 'role_id' => $user_role),
				array('user_id' => $user3, 'role_id' => $user_role),
				array('user_id' => $user4, 'role_id' => $viewer_role),

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
		DB::table('user_roles')->delete();
	}

}
