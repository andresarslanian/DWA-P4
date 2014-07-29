<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('incidents', function($table) {


			# AI, PK
			$table->increments('id');

			# created_at, updated_at columns
			$table->timestamps();

			# General data...
			$table->string('address');
			$table->string('house_number');
			$table->string('picket_number');
			$table->string('hw_address');
			$table->text('description')->nullable()->default(null);

			# FK
			$table->integer('type_id')->unsigned(); 								# type of incident	
			$table->integer('lamp_type_id')->unsigned()->nullable()->default(null); 							# lamp type of incident	
			$table->integer('reporter_id')->unsigned(); 							# who reports the incident
			$table->integer('owner_id')->unsigned(); 								# to whom it assigns it
  			$table->integer('action_id')->unsigned()->nullable()->default(null);   	# what action was taken
			$table->integer('state_id')->unsigned(); 								# in what state the incident is

			# Define foreign keys...
			$table->foreign('type_id')->references('id')->on('incident_types');	
			$table->foreign('lamp_type_id')->references('id')->on('lamp_types');	
			$table->foreign('reporter_id')->references('id')->on('users');
			$table->foreign('owner_id')->references('id')->on('companies');						
			$table->foreign('action_id')->references('id')->on('actions');
			$table->foreign('state_id')->references('id')->on('states');

			

//A) Reportar Incidente: En el cual tiene que pedirte calle, altura, nro de piquete, hw address, tipo de luminaria, mantenedor, falla/anomalía detectada. Y que una vez que se haga submit el mantenedor reciba una notificación por mail. Estaría bueno que este incidente tenga un ID para poder seguirlo y que tenga un estado. Open - In-progress y Closed. Entonce una vez que el mantendor recibe, entra a la pagina lo pone in-progress. Y que despues puedan modificar este incidente y poner Closed - y que en un campo puedan elegir entre LUMINARIA REEMPLAZADA, ENERGIA REESTABLECIDA, CODIGO DE BARRA INCORRECTO.
	        

	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('incidents');
	}

}
