<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateFolioTramite2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        Schema::dropIfExists('folio_tramites');

        Schema::create('folio_tramites', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('municipio',3);
            $table->integer('anio');
            $table->integer('folio')->default(1);
            $table->timestamps();
            $table->foreign('municipio')->references('municipio')->on('municipios');
            $table->unique(['municipio', 'anio', 'folio']);
        });


    }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('folio_tramites');
    }

}
