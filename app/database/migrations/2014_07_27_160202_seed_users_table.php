<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		$philips = DB::table('companies')
                            ->select('id')
                            ->where('name', 'Philips')
                            ->first()
                            ->id;    

		$autotrol = DB::table('companies')
                            ->select('id')
                            ->where('name', 'Autotrol')
                            ->first()
                            ->id;                                                                

		DB::table('users')->insert(
			array(
				array('email' => 'test@mydomain.com', 
					  'password'=>Hash::make('test'), 
					  'firstname'=>'Andres', 
					  'lastname'=>'Arslanian', 
					  'phone'=> '393 929 2993', 
					  'company_id' => $philips),
				array('email' => 'robert.thompson@mycompany.com', 
					  'password'=>Hash::make('test'), 
					  'firstname'=>'Robert', 
					  'lastname'=>'Thompson', 
					  'phone'=> '948 929 2993', 
					  'company_id' => $philips),
				array('email' => 'test@company.com', 
					  'password'=>Hash::make('test'), 
					  'firstname'=>'Mark', 
					  'lastname'=>'Robson', 
					  'phone'=> '654 929 2993', 
					  'company_id' => $autotrol),
				array('email' => 'mary.nice@mycompany.com', 
					  'password'=>Hash::make('test'), 
					  'firstname'=>'Mary', 
					  'lastname'=>'Nice', 
					  'phone'=> '844 929 2993', 
					  'company_id' => $autotrol),					  					  				
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
		DB::table('users')->delete();
	}

}
