<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTraslados2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//


        Schema::dropIfExists('traslado_colindancias');
        Schema::dropIfExists('traslados');

        Schema::create('traslados', function($table)
        {
            $table->increments('id');
            $table->string('clave');
            $table->string('cuenta');
            $table->integer('usuario_id');
            $table->integer('notaria_id');
            $table->integer('enajenante_id');
            $table->string('enajenante_tipo');
            $table->integer('adquiriente_id');
            $table->string('adquiriente_tipo');
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
            $table->text('lugar')->nullable();
            $table->date('fecha')->nullable();
            $table->string('declaracion')->nullable();
            $table->string('tipo_escritura')->nullable();
            $table->integer('notario_escritura_id')->nullable(); //integer FK a la tabla personas se toma de la tabla notarías
            $table->integer('notaria_escritura_id')->nullable(); //integer FK a la tabla notarias
            $table->string('naturaleza_contrato')->nullable();
            $table->integer('notario_antecedente_id')->nullable(); //integer FK a la tabla personas se toma de la tabla notarías
            $table->integer('notaria_antecedente_id')->nullable(); //integer FK a la tabla notarias
            $table->string('valuador_num_ant')->nullable();
            $table->string('folio_avaluo_ant')->nullable();
            //$table->decimal('valor_comercial', 10, 2)->nullable();
            $table->string('tipo_vivienda')->nullable();
           // $table->decimal('valor_comercial', 10, 2)->nullable();
            $table->decimal('precio_base', 10, 2)->nullable();
            $table->decimal('deduccion', 10, 2)->nullable();
            $table->decimal('base_gravable', 10, 2)->nullable();
            $table->decimal('diferencia_omitida', 10, 2)->nullable();
            $table->decimal('porcentaje_aplicarse', 10, 2)->nullable();
            $table->decimal('impuesto_enterar', 10, 2)->nullable();
            $table->decimal('actualizacion', 10, 2)->nullable();
            $table->decimal('recargos', 10, 2)->nullable();
            $table->decimal('importe_total', 10, 2)->nullable();
            $table->decimal('valor_catastral', 10, 2)->nullable();
            $table->decimal('valor_operacion', 10, 2)->nullable();
            $table->decimal('valor_comercial', 10, 2)->nullable();
            $table->string('valuador_num')->nullable();
            $table->string('folio_avaluo')->nullable();
            $table->string('seguimiento')->nullable();

            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('notaria_id')->references('id_notaria')->on('notarias');
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
