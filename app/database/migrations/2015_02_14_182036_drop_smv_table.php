<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropSmvTable extends Migration {

	/**
	 * Se elimina esta tabla de primer ejemplo por que ya se realizó una mejor.
	 *
	 * @return void
	 */
	public function up()
	{
        if(Schema::hasTable('smv'))
        {
            Schema::drop('smv');
        }
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::create('smv', function(Blueprint $table)
        {
            $table->increments('id');

            //Año de vigencia
            $table->integer('anio');
            //Clave de la entidad federativa
            $table->string('entidad')->nullable();
            //ID del municipio
            $table->integer('municipio')->nullable();
            //Area de aplicación
            $table->string('area');
            //Monto del salario minimo vigente
            $table->decimal('monto',8,2);

            $table->timestamps();
        });
	}

}
