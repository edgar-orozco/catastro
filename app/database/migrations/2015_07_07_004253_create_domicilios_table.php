<?php

/**
 * Se usa para los domicilios de las personas involucradas en los tramites
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomiciliosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('domicilios'))
        {
            Schema::create('domicilios',function(Blueprint $table) {
                $table->increments('id');
                $table->integer('tipo_vialidad_id')->nullable();
                $table->string('vialidad')->nullable();
                $table->string('num_ext')->nullable();
                $table->string('num_int')->nullable();
                $table->integer('tipo_asentamiento_id')->nullable();
                $table->string('asentamiento')->nullable();
                $table->string('cp',5)->nullable();
                $table->string('localidad')->nullable();
                $table->string('municipio', 3)->nullable();
                $table->string('entidad', 2)->nullable();
                $table->string('referencia')->nullable();

                $table->foreign('tipo_vialidad_id')->references('id')->on('tiposvialidad');
                $table->foreign('tipo_asentamiento_id')->references('id')->on('tiposasentamiento');
                $table->foreign('municipio')->references('municipio')->on('municipios');
                $table->foreign('entidad')->references('entidad')->on('entidades');
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
        Schema::dropIfExists('domicilios');
    }

}
