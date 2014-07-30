<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('roles')->insert(
			array(
				array('name' => 'Super Admin'),
				array('name' => 'Admin'),
				array('name' => 'User'),
				array('name' => 'Viewer'),                                
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
		DB::table('roles')->delete();
	}

}
