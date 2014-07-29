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
				array('type' => "225W"),
				array('type' => "110W"),
				array('type' => "80W"),
				array('type' => "Metronomist"),
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
