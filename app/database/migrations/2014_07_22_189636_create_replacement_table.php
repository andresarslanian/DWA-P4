<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplacementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('replacements', function($table) {

			# AI, PK
			$table->increments('id');

			# created_at, updated_at columns
			$table->timestamps();

			# General data...
			$table->string('comments')->nullable()->default(null);
			$table->integer('user_id')->unsigned(); 	# who makes the replacement
			$table->integer('incident_id')->unsigned(); # to what incident the replacement corresponds to
			$table->integer('lamp_id')->unsigned(); 	# which is the new lamp

			# Define foreign keys...
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('incident_id')->references('id')->on('incidents');
			$table->foreign('lamp_id')->references('id')->on('lamps');

	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('replacements');
	}

}
