<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluoEnfoqueFisico extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('avaluo_enfoque_fisico', function(Blueprint $table) {
			$table->increments('idavaluoenfoquefisico');
			$table->integer('idavaluo');
			$table->decimal('tipo_moda', 10, 2)->default(0.00);
			$table->decimal('valor_unitario_promedio', 10, 2)->default(0.00);
			$table->decimal('valor_aplicado_m2', 10, 2)->default(0.00);
			$table->string('conclusion_investigacion_comparables', 500)->default('');
			$table->decimal('valor_terreno', 20, 2)->default(0.00);

			$table->integer('idclasegeneral')->nullable();
			$table->integer('idtipoinmueble')->nullable();
			$table->integer('idestado_conservacion')->nullable();
			$table->integer('idcalidadproyecto')->nullable();

			$table->integer('edad_construccion');
			$table->integer('vida_util');
			$table->integer('numero_niveles');
			$table->integer('nivel_edificio_condominio');

			$table->string('conclusion_investigacion_terreno', 500)->default('');
			$table->string('conclusion_investigacion_construccion', 500)->default('');
			$table->decimal('total_metros_construccion', 20, 2)->default(0.00);
			$table->decimal('valor_construccion', 20, 2)->default(0.00);
			$table->decimal('subtotal_area_condominio', 20, 2)->default(0.00);
			$table->decimal('subtotal_instalaciones_especiales', 20, 2)->default(0.00);
			$table->decimal('total_valor_fisico', 20, 2)->default(0.00);

			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('idavaluo')->references('idavaluo')->on('avaluos')->onUpdate('cascade');
			$table->foreign('idclasegeneral')->references('idclasegeneralinmueble')->on('cat_clase_general_inmueble')->onUpdate('cascade');
			$table->foreign('idtipoinmueble')->references('idtipoinmueble')->on('cat_tipo_inmueble')->onUpdate('cascade');
			$table->foreign('idestado_conservacion')->references('idestadoconservacion')->on('cat_estado_conservacion')->onUpdate('cascade');
			$table->foreign('idcalidadproyecto')->references('idcalidadproyecto')->on('cat_calidad_proyecto')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS avaluo_enfoque_fisico CASCADE;");
	}

}
