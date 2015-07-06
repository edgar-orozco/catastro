<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitante extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            if(!Schema::hasTable('solicitante'))
            {
                Schema::create('solicitante',function(Blueprint $table)
                {
                    $table->bigIncrements('id_solicitante');
                    $table->string('apellido_paterno',255)->nullable();
                    $table->string('apellido_materno',255)->nullable();
                    $table->string('nombres',255)->nullable();
                    $table->string('nombrec',255)->nullable();
                    $table->string('rfc',30)->nullable();
                    $table->string('curp',30)->nullable();
                    $table->date('fecha_ingr')->nullable();
                    $table->integer('id_tipo')->nullable();
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
            Schema::table('solicitante', function(Blueprint $table)
                {
                Schema::dropTable('solicitante');
                });
	}

}
