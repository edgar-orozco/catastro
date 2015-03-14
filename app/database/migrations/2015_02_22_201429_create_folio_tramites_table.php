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
            $table->integer('municipio_id');
            $table->integer('folio')->default(1);
            $table->timestamps();
            $table->foreign('municipio_id')->references('gid')->on('municipios');
            $table->unique(['municipio_id', 'folio']);
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
