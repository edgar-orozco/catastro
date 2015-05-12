<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluoZona extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('avaluo_zona', function(Blueprint $table) {
			$table->increments('idavaluozona');
			$table->integer('idavaluo');
			$table->smallInteger('is_agua_potable')->default(0);
			$table->smallInteger('is_guarniciones')->default(0);
			$table->smallInteger('is_drenaje')->default(0);
			$table->smallInteger('is_banqueta')->default(0);
			$table->smallInteger('is_electricidad')->default(0);
			$table->smallInteger('is_telefono')->default(0);
			$table->smallInteger('is_pavimentacion')->default(0);
			$table->smallInteger('is_transporte_publico')->default(0);
			$table->smallInteger('is_alumbrado_publico')->default(0);
			$table->smallInteger('is_otro_servicio')->default(0);
			$table->string('otro_servicio_municipal', 300)->default('');
			$table->smallInteger('is_escuela')->default(0);
			$table->smallInteger('is_iglesia')->default(0);
			$table->smallInteger('is_banco')->default(0);
			$table->smallInteger('is_comercio')->default(0);
			$table->smallInteger('is_hospital')->default(0);
			$table->smallInteger('is_parque')->default(0);
			$table->smallInteger('is_transporte')->default(0);
			$table->smallInteger('is_gasolinera')->default(0);
			$table->smallInteger('is_mercado')->default(0);
			$table->smallInteger('is_otro_equipamiento')->default(0);
			$table->string('cobertura', 250)->default('');
			$table->string('otro_equipamiento', 300)->default('');
			$table->integer('nivel_equipamiento')->default(0);
			$table->integer('idclasificacionzona');
			$table->integer('idproximidadurbana');
			$table->string('construc_predominante', 500);
			$table->string('vias_acceso_importante', 500);

			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idavaluo')->references('idavaluo')->on('avaluos')->onUpdate('cascade');
			$table->foreign('idclasificacionzona')->references('idclasificacionzona')->on('cat_clasificacion_zona')->onUpdate('cascade');
			$table->foreign('idproximidadurbana')->references('idproximidadurbana')->on('cat_proximidad_urbana')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS avaluo_zona CASCADE;");
	}

}
