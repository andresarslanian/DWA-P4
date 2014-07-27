<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedLampsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('lamps')->insert(
			array(
				array( 'serial' => '1223', 'description' => "Greenway 128"),
				array( 'serial' => "1224", 'description' => "Greenway 128"),
				array( 'serial' => "1225", 'description' => "Greenway 128"),
				array( 'serial' => "1226", 'description' => "Greenway 128"),
				array( 'serial' => "1227", 'description' => "Greenway 128"),
				array( 'serial' => "1228", 'description' => "Greenway 128"),
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
		DB::table('lamps')->delete();
	}

}
