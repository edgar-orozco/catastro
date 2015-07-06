<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudGestion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            if(!Schema::hasTable('solicitud_gestion'))
            {
                Schema::create('solicitud_gestion',function(Blueprint $table)
                {
                    $table->bigIncrements('id_solicitud');
                    $table->integer('id_solicitante')->nullable();
                    $table->integer('id_tramite')->nullable();
                    $table->integer('municipio')->nullable();
                    $table->string('clave',255)->nullable();
                    $table->string('seguimiento',6)->nullable();
                    $table->date('create_at')->nullable();
                    $table->date('updated_at')->nullable();
                    
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
            Schema::drop('solicitud_gestion');
	}

}
