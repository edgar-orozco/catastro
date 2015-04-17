<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTramitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('documentos_tramites', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('tramite_id');
            $table->integer('tipotramite_id');
            $table->integer('requisito_id');
            $table->integer('documento_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tramite_id')->references('id')->on('tramites');
            $table->foreign('requisito_id')->references('id')->on('requisitos');
            $table->foreign('tipotramite_id')->references('id')->on('tipotramites');
            $table->foreign('documento_id')->references('id')->on('documentos');
        });

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('documentos_tramites');
	}

}
