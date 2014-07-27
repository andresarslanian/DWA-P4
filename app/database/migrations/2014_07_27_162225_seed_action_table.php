<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('actions')->insert(
			array(
				array('description' => "Light replaced"),
				array('description' => "Power Restored"),
				array('description' => "Incorrect Bar Code"),
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
		DB::table('actions')->delete();
	}

}
