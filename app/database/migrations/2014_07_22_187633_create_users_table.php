<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('users', function($table) {

			# AI, PK
			$table->increments('id');

			# created_at, updated_at columns
			$table->timestamps();

			# Credentials
			$table->string('email')->unique();
			$table->boolean('remember_token');
			$table->string('password');  
			$table->boolean('enabled')->default(true);  

			# General data...
			$table->string('firstname');
			$table->string('lastname');
			$table->string('phone')->nullable()->default(null);

			# FK
			$table->integer('company_id')->unsigned(); # type of incident	

			# Define foreign keys...
			$table->foreign('company_id')->references('id')->on('companies');	

	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
