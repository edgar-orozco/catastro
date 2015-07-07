<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitante2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('solicitante');
            
	Schema::create('solicitante', function(Blueprint $table)
                {
                    $table->Increments('id');
                    $table->string('apellido_paterno',255)->nullable();
                    $table->string('apellido_materno',255)->nullable();
                    $table->string('nombres',255)->nullable();
                    $table->string('nombrec',255)->nullable();
                    $table->string('rfc',30)->nullable();
                    $table->string('curp',30)->nullable();
                    $table->string('direccion',255)->nullable();
                    $table->string('telefono',10)->nullable();
                    $table->integer('tipo_telefono')->nullable();
                    $table->string('correo',255)->nullable();
                    $table->date('fecha_ingr')->nullable();
                    $table->integer('id_tipo')->nullable();
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('solicitante');
	}

}
