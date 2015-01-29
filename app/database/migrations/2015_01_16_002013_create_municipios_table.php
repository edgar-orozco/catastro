<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('municipios')) {

            Schema::create('municipios', function (Blueprint $table) {
                $table->string('entidad', 2);
                $table->string('municipio', 3);
                $table->text('nom_mpo');
                $table->text('nom_cabecera');
                $table->primary('municipio');
            });
        }

        if (!Schema::hasTable('user_municipio')) {

            Schema::create('user_municipio', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('usuario_id');
                $table->string('municipio_id', 3);
                $table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('municipio_id')->references('municipio')->on('municipios')->onUpdate('cascade')->onDelete('cascade');
                $table->unique(['usuario_id', 'municipio_id']);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_municipio');
        Schema::drop('municipios');
    }
}
