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
		$t1 = DB::table('lamp_types')
                            ->select('id')
                            ->where('type', '225W')
                            ->first()
                            ->id;

		$t2 = DB::table('lamp_types')
                            ->select('id')
                            ->where('type', '110W')
                            ->first()
                            ->id;

		DB::table('lamps')->insert(
			array(
				array( 'serial' => '1223', 'description' => "Greenway 128", 'type_id' => $t1),
				array( 'serial' => "1224", 'description' => "Greenway 128", 'type_id' => $t2),
				array( 'serial' => "1225", 'description' => "Greenway 128", 'type_id' => $t1),
				array( 'serial' => "1226", 'description' => "Greenway 128", 'type_id' => $t2),
				array( 'serial' => "1227", 'description' => "Greenway 128", 'type_id' => $t1),
				array( 'serial' => "1228", 'description' => "Greenway 128", 'type_id' => $t2),
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
