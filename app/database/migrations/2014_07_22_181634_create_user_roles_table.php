<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('user_roles', function($table) {

			# AI, PK
			$table->increments('id');

			# FK
			$table->integer('user_id')->unsigned();
			$table->integer('role_id')->unsigned();

			# Define foreign keys...
			$table->foreign('user_id')->references('id')->on('users');	
			$table->foreign('role_id')->references('id')->on('roles');	

	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_roles');
	}

}
