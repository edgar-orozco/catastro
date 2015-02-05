<?php

/**
 *
 * La estructura original que se hizo en el 2014 contemplaba los siguientes campos:
 *
	Table "public.tramites"
	Column     |            Type             | Modifiers
	----------------+-----------------------------+-----------
	id_tr          | integer                     |
	id_propietario | integer                     |
	id_tt          | integer                     |
	id_predio      | integer                     |
	clave          | character varying(15)       |
	folio          | integer                     |
	folio_interno  | integer                     |
	curt           | character varying           |
	id_solicitante | integer                     |
	id_notaria     | integer                     |
	fecha_ingreso  | timestamp without time zone |
	fecha_egr      | timestamp without time zone |
	observaciones  | text                        |
 *
 */


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTramitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Esto es para eliminar la tabla que hicieron por fuera del sistema, de lo contrario no podemos crear la tabla correcta.
		if (Schema::hasTable('tramites'))
		{
			Schema::drop('tramites');
		}




		//Empezamos con una estructura básica en lo que se define finalmente.
		Schema::create('tramites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('clave');
			$table->integer('tipotramite_id');
			$table->integer('usuario_id');
			$table->string('folio');
			$table->timestamps();

			$table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('tipotramite_id')->references('id')->on('tipotramites')->onUpdate('cascade')->onDelete('cascade');
		});

		Schema::create('requisito_tramite', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tramite_id');
			$table->integer('requisito_id');
			$table->integer('usuario_id');
			$table->timestamps();

			$table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('tramite_id')->references('id')->on('tramites')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('requisito_id')->references('id')->on('requisitos')->onUpdate('cascade')->onDelete('cascade');
		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::drop('requisito_tramite');
		Schema::drop('tramites');
	}

}
