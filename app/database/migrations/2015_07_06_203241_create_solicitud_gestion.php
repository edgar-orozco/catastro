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
	Schema::dropIfExists('solicitud_gestion');
        
        Schema::create('solicitud_gestion',function(Blueprint $table)
                {
                    $table->Increments('id');
                    $table->integer('solicitante_id')->nullable();
                    $table->integer('tramite_id')->nullable();
                    $table->integer('municipio')->nullable();
                    $table->string('clave',255)->nullable();
                    $table->string('seguimiento',6)->nullable();
                    $table->date('create_at')->nullable();
                    $table->date('updated_at')->nullable();
                    
                });
        
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('solicitud_gestion');
	}

}
