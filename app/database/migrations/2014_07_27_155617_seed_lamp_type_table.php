<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedLampTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('lamp_types')->insert(
			array(
				array('description' => "225W"),
				array('description' => "110W"),
				array('description' => "80W"),
				array('description' => "Metronomist"),
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
		DB::table('lamp_types')->delete();
	}

}
