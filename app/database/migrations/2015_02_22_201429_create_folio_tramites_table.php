<?php
/**
 * Tabla de folios de tramites por municipio.
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFolioTramitesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folio_tramites', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('municipio', 3);
            $table->integer('folio')->default(1);
            $table->timestamps();
            $table->foreign('municipio')->references('municipio')->on('municipios');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('folio_tramites');
    }

}
