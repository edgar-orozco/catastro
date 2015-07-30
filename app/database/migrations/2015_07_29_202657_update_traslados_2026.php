<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTraslados2026 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::dropIfExists('traslados');

        Schema::create('traslados', function($table)
        {
            $table->increments('id');
            $table->string('clave');
            $table->string('cuenta');
            $table->integer('folio')->nullable();
            $table->integer('usuario_id');
            $table->text('lugar')->nullable();
            $table->date('fecha')->nullable();
            $table->string('declaracion')->nullable();
            $table->integer('enajenante_id');
            $table->integer('adquiriente_id');
            $table->string('tipo_escritura')->nullable();
            $table->integer('escritura_registro')->nullable();
            $table->integer('escritura_volumen')->nullable();
            $table->date('escritura_fecha')->nullable();
            $table->integer('notario_escritura_id'); //integer FK a la tabla personas se toma de la tabla notarías
            $table->integer('notaria_escritura_id'); //integer FK a la tabla notarias
            $table->string('naturaleza_contrato')->nullable();
            $table->string('ubicacion')->nullable();
            $table->decimal('superficie_terreno', 18,2)->nullable();
            $table->decimal('superficie_construccion', 18,2)->nullable();
            $table->integer('notario_antecedente_id')->nullable(); //integer FK a la tabla personas se toma de la tabla notarías
            $table->integer('notaria_antecedente_id')->nullable(); //integer FK a la tabla notarias
            $table->integer('num_antecedente')->nullable();
            $table->integer('volumen_antecedente')->nullable();
            $table->date('fecha_antecedente')->nullable();
            $table->string('partida_antecedente')->nullable(); //in
            $table->integer('predio_antecedente')->nullable(); //in
            $table->integer('folio_real_antecedente')->nullable(); //in
            $table->integer('volumen_freal_antecedente')->nullable(); //in
            $table->decimal('valor_comercial_antecedente',18,2)->nullable();
            $table->string('valuador_num_ant')->nullable();
            $table->string('folio_avaluo_ant')->nullable();
            $table->string('tipo_vivienda')->nullable();
            $table->decimal('precio_base', 18, 2)->nullable();
            $table->decimal('deduccion', 18, 2)->nullable();
            $table->decimal('base_gravable', 18, 2)->nullable();
            $table->decimal('diferencia_omitida', 18, 2)->nullable();
            $table->decimal('porcentaje_aplicarse', 18, 2)->nullable();
            $table->decimal('impuesto_enterar', 18, 2)->nullable();
            $table->decimal('actualizacion', 18, 2)->nullable();
            $table->decimal('recargos', 18, 2)->nullable();
            $table->decimal('importe_total', 18, 2)->nullable();
            $table->decimal('valor_catastral', 18, 2)->nullable();
            $table->decimal('valor_operacion', 18, 2)->nullable();
            $table->decimal('valor_comercial', 18, 2)->nullable();
            $table->string('valuador_num')->nullable();
            $table->string('folio_avaluo')->nullable();
            $table->string('seguimiento')->nullable();

            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('enajenante_id')->references('id_p')->on('personas');
            $table->foreign('adquiriente_id')->references('id_p')->on('personas');
            $table->foreign('notario_escritura_id')->references('id_p')->on('personas');
            $table->foreign('notaria_escritura_id')->references('id_notaria')->on('notarias');
            $table->foreign('notario_antecedente_id')->references('id_p')->on('personas');
            $table->foreign('notaria_antecedente_id')->references('id_notaria')->on('notarias');

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
	}

}
