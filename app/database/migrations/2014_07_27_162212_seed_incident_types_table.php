<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedIncidentTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('incident_types')->insert(
			array(
				array('description' => "Light not working"),
				array('description' => "No energy"),
				array('description' => "Missing components"),
				array('description' => "Verification"),
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
		DB::table('incident_types')->delete();
	}

}
