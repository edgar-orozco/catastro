<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearFoliosHistorial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('folios_historial'))
            {
            Schema::create('folios_historial',function(Blueprint $table)
            {            
                $table->increments('id');
                $table->integer('no_oficio');
                $table->integer('perito_id');
                $table->integer('cantidad_urbanos')->nullable();
                $table->integer('cantidad_rusticos')->nullable();
                $table->float('total_urbano')->nullable();
                $table->float('total_rustico')->nullable();
                $table->float('total');
                $table->integer('folio_urbano_inicio');
                $table->integer('folio_urbano_final');
                $table->integer('folio_rustico_inicio');
                $table->integer('folio_rustico_final');
                $table->date('fecha_solicitud')->nullable();
                $table->date('fecha_oficio')->nullable();
                $table->string('no_recibo',50);
                $table->integer('id_usuario')->nullable();
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
		Schema::drop('folios_historrial');
	}

}
