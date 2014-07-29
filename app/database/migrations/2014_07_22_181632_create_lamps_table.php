<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLampsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

	    Schema::create('lamps', function($table) {

			# AI, PK
			$table->increments('id');

			# created_at, updated_at columns
			$table->timestamps();

			# General data...
	        $table->string('serial')->unique();
	        $table->string('description')->nullable()->default(null);   

			# FK
			$table->integer('type_id')->unsigned(); 	# type of light

			# Define foreign keys...
			$table->foreign('type_id')->references('id')->on('lamp_types');						             
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lamps');
	}

}
