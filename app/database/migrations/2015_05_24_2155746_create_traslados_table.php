<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrasladosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('traslados', function($table)
        {
            $table->increments('id');
            $table->string('clave');
            $table->string('cuenta');
            $table->integer('usuario_id');
            $table->integer('notaria_id');
            $table->integer('vendedor_id');
            $table->string('vendedor_tipo');
            $table->integer('comprador_id');
            $table->string('comprador_tipo');
            $table->decimal('superficie_vendida',10,2);
            $table->decimal('superficie_construccion_vendida',10,2);
            $table->text('medidas_colindancias');
            $table->date('escritura_fecha')->nullable();
            $table->integer('escritura_registro')->nullable();
            $table->integer('escritura_predio')->nullable();
            $table->integer('escritura_folio')->nullable();
            $table->integer('escritura_volumen')->nullable();
            $table->date('escritura_impuesto_desde')->nullable();
            $table->date('escritura_impuesto_hasta')->nullable();

            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('notaria_id')->references('id_notaria')->on('notarias');
            $table->foreign('vendedor_id')->references('id_p')->on('personas');
            $table->foreign('comprador_id')->references('id_p')->on('personas');



        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::dropIfExists('traslados');
	}

}
