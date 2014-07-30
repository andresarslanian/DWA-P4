<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('permissions')->insert(
			array(
				array('name' => 'view_incidents', 'display_name' => 'View Incidents'),
				array('name' => 'view_replacements', 'display_name' => 'View Replacements'),
				array('name' => 'export_data', 'display_name' => 'Export Data'),
				//------------------------------------------------------------------------------//
				array('name' => 'create_incidents', 'display_name' => 'Create Incidents'),
				array('name' => 'create_replacements', 'display_name' => 'Create Replacements'),
				array('name' => 'modify_incident', 'display_name' => 'Modify Incidents'),	
				array('name' => 'upload_lamps', 'display_name' => 'Upload Lamps'), 					 //* For Philips
				//------------------------------------------------------------------------------//
				array('name' => 'create_users_for_company', 'display_name' => 'Create Users For Company'),
				array('name' => 'modify_users_for_company', 'display_name' => 'Modify Users For Company'),
				array('name' => 'view_users_for_company', 'display_name' => 'View Users For Company'),
				array('name' => 'view_all_incidents', 'display_name' => 'View All Incidents'),		 //* For Philips
				array('name' => 'view_all_replacements', 'display_name' => 'View All Replacements'), //* For Philips
				//------------------------------------------------------------------------------//
				array('name' => 'create_all_users', 'display_name' => 'Create All Users'),
				array('name' => 'create_companies', 'display_name' => 'Create Companies'),
				array('name' => 'view_companies', 'display_name' => 'View Companies'),
				array('name' => 'view_all_users', 'display_name' => 'View All Users'),
				array('name' => 'modify_companies', 'display_name' => 'Modify Companies'),
				array('name' => 'modify_all_users', 'display_name' => 'Modify All Users'),
				//------------------------------------------------------------------------------//
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
		DB::table('permissions')->delete();
	}

}
