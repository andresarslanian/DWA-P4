<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('companies')->insert(
			array(
				array('name' => 'Philips', 'email'=>'andres.arslanian@gmail.com', 'phone' => '756 839 2028'),
				array('name' => 'Autotrol', 'email'=>'aarslanian@fas.harvard.edu', 'phone' => '430 349 3994'),
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
		DB::table('companies')->delete();
	}

}
