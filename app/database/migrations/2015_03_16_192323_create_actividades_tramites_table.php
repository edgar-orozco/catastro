<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActividadesTramitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('actividades_tramites', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('tramite_id');
            $table->integer('tipo_id')->nullable();
            $table->integer('user_id');
            $table->integer('departamento_id')->nullable();
            $table->text('observaciones')->nullable();
			$table->timestamps();

            $table->foreign('tramite_id')->references('id')->on('tramites');
            $table->foreign('tipo_id')->references('id')->on('tipoactividades_tramites');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('departamento_id')->references('id')->on('departamentos_tramites');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('actividades_tramites');
	}

}
