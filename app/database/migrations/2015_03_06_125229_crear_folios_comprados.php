<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearFoliosComprados extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('folios_comprados'))
            {
            Schema::create('folios_comprados',function(Blueprint $table)
            {            
                $table->increments('id');
                $table->integer('no_oficio_historial')->nullable();
                $table->integer('perito_id');
                $table->integer('numero_folio');
                $table->string('tipo_folio');
                $table->binary('entrega_municipal');
                $table->date('fecha_entrega_m')->nullable();
                $table->binary('entrega_estatal');
                $table->date('fecha_entrega_e')->nullable();
                $table->integer('usuario_id')->nullable();
                $table->integer('municipio_id')->nullable();
                $table->timestamps();
            });
        }//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('folios_comprados');
	}

}
