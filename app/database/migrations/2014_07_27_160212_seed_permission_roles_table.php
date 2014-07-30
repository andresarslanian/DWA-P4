<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
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

		$view_incidents = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'view_incidents')
                            ->first()
                            ->id;                            

		$view_replacements = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'view_replacements')
                            ->first()
                            ->id;                            

		$export_data = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'export_data')
                            ->first()
                            ->id;                            

		$create_incidents = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'create_incidents')
                            ->first()
                            ->id;                            
		$create_replacements = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'create_replacements')
                            ->first()
                            ->id;                            

		$modify_incident = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'modify_incident')
                            ->first()
                            ->id;                            

		$upload_lamps = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'upload_lamps')
                            ->first()
                            ->id;                                                                                                                                                                                                    

		$create_users_for_company = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'create_users_for_company')
                            ->first()
                            ->id;                            

              $modify_users_for_company = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'modify_users_for_company')
                            ->first()
                            ->id;                            

              $view_users_for_company = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'view_users_for_company')
                            ->first()
                            ->id;                            

		$view_all_incidents = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'view_all_incidents')
                            ->first()
                            ->id;                            

		$view_all_replacements = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'view_all_replacements')
                            ->first()
                            ->id;                            

		$create_all_users = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'create_all_users')
                            ->first()
                            ->id;                            

		$create_companies = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'create_companies')
                            ->first()
                            ->id;                            

		$view_companies = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'view_companies')
                            ->first()
                            ->id;                            

		$view_all_users = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'view_all_users')
                            ->first()
                            ->id;                            

		$modify_companies = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'modify_companies')
                            ->first()
                            ->id;                                                                                                                                                                                                                                                            

		$modify_all_users = DB::table('permissions')
                            ->select('id')
                            ->where('name', 'modify_all_users')
                            ->first()
                            ->id;                                                                                                                                                                                                                                                            

		DB::table('permission_role')->insert(
			array(
				array('permission_id' => $view_incidents, 'role_id' => $viewer_role),
				array('permission_id' => $view_replacements, 'role_id' => $viewer_role),
				array('permission_id' => $export_data, 'role_id' => $viewer_role),
				//------------------------------------------------------------------------------//
				array('permission_id' => $view_incidents, 'role_id' => $user_role),
				array('permission_id' => $view_replacements, 'role_id' => $user_role),
				array('permission_id' => $export_data, 'role_id' => $user_role),				
				array('permission_id' => $create_incidents, 'role_id' => $user_role),
				array('permission_id' => $create_replacements, 'role_id' => $user_role),
				array('permission_id' => $modify_incident, 'role_id' => $user_role),				
				array('permission_id' => $upload_lamps, 'role_id' => $user_role),	
				//------------------------------------------------------------------------------//
				array('permission_id' => $view_incidents, 'role_id' => $admin_role),
				array('permission_id' => $view_replacements, 'role_id' => $admin_role),
				array('permission_id' => $export_data, 'role_id' => $admin_role),				
				array('permission_id' => $create_incidents, 'role_id' => $admin_role),
				array('permission_id' => $create_replacements, 'role_id' => $admin_role),
				array('permission_id' => $modify_incident, 'role_id' => $admin_role),				
				array('permission_id' => $upload_lamps, 'role_id' => $admin_role),		
				array('permission_id' => $create_users_for_company, 'role_id' => $admin_role),
                            array('permission_id' => $modify_users_for_company, 'role_id' => $admin_role),
                            array('permission_id' => $view_users_for_company, 'role_id' => $admin_role),
				array('permission_id' => $view_all_incidents, 'role_id' => $admin_role),				
				array('permission_id' => $view_all_replacements, 'role_id' => $admin_role),	
				//------------------------------------------------------------------------------//
				array('permission_id' => $view_incidents, 'role_id' => $super_admin),
				array('permission_id' => $view_replacements, 'role_id' => $super_admin),
				array('permission_id' => $export_data, 'role_id' => $super_admin),				
				array('permission_id' => $create_incidents, 'role_id' => $super_admin),
				array('permission_id' => $create_replacements, 'role_id' => $super_admin),
				array('permission_id' => $modify_incident, 'role_id' => $super_admin),				
				array('permission_id' => $upload_lamps, 'role_id' => $super_admin),		
				array('permission_id' => $create_users_for_company, 'role_id' => $super_admin),
				array('permission_id' => $modify_users_for_company, 'role_id' => $super_admin),
                            array('permission_id' => $view_users_for_company, 'role_id' => $super_admin),
				array('permission_id' => $view_all_incidents, 'role_id' => $super_admin),				
				array('permission_id' => $view_all_replacements, 'role_id' => $super_admin),
				array('permission_id' => $create_all_users, 'role_id' => $super_admin),				
				array('permission_id' => $create_companies, 'role_id' => $super_admin),		
				array('permission_id' => $view_companies, 'role_id' => $super_admin),
				array('permission_id' => $view_all_users, 'role_id' => $super_admin),
				array('permission_id' => $modify_companies, 'role_id' => $super_admin),				
				array('permission_id' => $modify_all_users, 'role_id' => $super_admin),																								
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
		DB::table('permission_role')->delete();
	}

}
