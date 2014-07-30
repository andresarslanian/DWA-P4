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
                            ->where('description', '225W')
                            ->first()
                            ->id;

		$t2 = DB::table('lamp_types')
                            ->select('id')
                            ->where('description', '110W')
                            ->first()
                            ->id;

		$s1 = DB::table('lamp_states')
                            ->select('id')
                            ->where('description', 'New')
                            ->first()
                            ->id;

		$s2 = DB::table('lamp_states')
                            ->select('id')
                            ->where('description', 'In Use')
                            ->first()
                            ->id;                                                        

		$s3 = DB::table('lamp_states')
                            ->select('id')
                            ->where('description', 'Replaced')
                            ->first()
                            ->id;

		DB::table('lamps')->insert(
			array(
				array( 'serial' => '1223', 'description' => "Greenway 128", 'type_id' => $t1, 'state_id' => $s1),
				array( 'serial' => '1215', 'description' => "Greenway 128", 'type_id' => $t1, 'state_id' => $s1),				
				array( 'serial' => '1214', 'description' => "Greenway 128", 'type_id' => $t1, 'state_id' => $s1),
				array( 'serial' => '1213', 'description' => "Greenway 128", 'type_id' => $t1, 'state_id' => $s1),
				array( 'serial' => '1212', 'description' => "Greenway 128", 'type_id' => $t1, 'state_id' => $s1),
				array( 'serial' => '1211', 'description' => "Greenway 128", 'type_id' => $t1, 'state_id' => $s1),
				array( 'serial' => "1224", 'description' => "Greenway 128", 'type_id' => $t2, 'state_id' => $s2),
				array( 'serial' => "1225", 'description' => "Greenway 128", 'type_id' => $t1, 'state_id' => $s3),
				array( 'serial' => "1226", 'description' => "Greenway 128", 'type_id' => $t2, 'state_id' => $s1),
				array( 'serial' => "1227", 'description' => "Greenway 128", 'type_id' => $t1, 'state_id' => $s2),
				array( 'serial' => "1228", 'description' => "Greenway 128", 'type_id' => $t2, 'state_id' => $s3),

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
