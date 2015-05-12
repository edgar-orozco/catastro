<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluoInmueble extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('avaluo_inmueble', function(Blueprint $table) {
			$table->increments('idavaluoinmueble');
			$table->integer('idavaluo');
			$table->string('croquis', 200);
			$table->string('fachada', 200);
			$table->string('medidas_colindancias', 500);
			$table->integer('idusossuelo')->default(0);
			$table->text('servidumbre_restricciones');
			$table->text('descripcion_inmueble');
			$table->integer('numero_niveles_unidad')->default(1);
			$table->integer('unidades_rentables_escritura')->default(1);
			$table->string('cimentacion', 300);
			$table->string('estructura', 300);
			$table->string('muros', 300);
			$table->string('entrepisos', 300);
			$table->string('techos', 300);
			$table->string('bardas', 300);
			$table->integer('id_cimentacion')->default(0);
			$table->integer('id_estructura')->default(0);
			$table->integer('id_muro')->default(0);
			$table->integer('id_entrepiso')->default(0);
			$table->integer('id_techo')->default(0);
			$table->integer('id_barda')->default(0);

			$table->string('recamaras0', 50);
			$table->string('recamaras1', 50);
			$table->string('recamaras2', 50);
			$table->integer('id_recamara0')->default(0);
			$table->integer('id_recamara1')->default(0);
			$table->integer('id_recamara2')->default(0);
			
			$table->string('estancia_comedor0', 50);
			$table->string('estancia_comedor1', 50);
			$table->string('estancia_comedor2', 50);
			$table->integer('id_estancia_comedor0')->default(0);
			$table->integer('id_estancia_comedor1')->default(0);
			$table->integer('id_estancia_comedor2')->default(0);
			
			$table->string('banos0', 50);
			$table->string('banos1', 50);
			$table->string('banos2', 50);
			$table->integer('id_bano0')->default(0);
			$table->integer('id_bano1')->default(0);
			$table->integer('id_bano2')->default(0);
			
			$table->string('escaleras0', 50);
			$table->string('escaleras1', 50);
			$table->string('escaleras2', 50);
			$table->integer('id_escalera0')->default(0);
			$table->integer('id_escalera1')->default(0);
			$table->integer('id_escalera2')->default(0);
			
			$table->string('cocina0', 50);
			$table->string('cocina1', 50);
			$table->string('cocina2', 50);
			$table->integer('id_cocina0')->default(0);
			$table->integer('id_cocina1')->default(0);
			$table->integer('id_cocina2')->default(0);
			
			$table->string('patio_servicio0', 50);
			$table->string('patio_servicio1', 50);
			$table->string('patio_servicio2', 50);
			$table->integer('id_patio_servicio0')->default(0);
			$table->integer('id_patio_servicio1')->default(0);
			$table->integer('id_patio_servicio2')->default(0);
			
			$table->string('estacionamiento0', 50);
			$table->string('estacionamiento1', 50);
			$table->string('estacionamiento2', 50);
			$table->integer('id_estacionamiento0')->default(0);
			$table->integer('id_estacionamiento1')->default(0);
			$table->integer('id_estacionamiento2')->default(0);
			
			$table->string('fachada0', 50);
			$table->string('fachada1', 50);
			$table->string('fachada2', 50);
			$table->integer('id_fachada0')->default(0);
			$table->integer('id_fachada1')->default(0);
			$table->integer('id_fachada2')->default(0);
			
			$table->string('hidraulico_sanitarias', 150);
			$table->string('electricas', 150);
			$table->string('carpinteria', 150);
			$table->string('herreria', 150);
			$table->decimal('superficie_total_terreno', 14, 4)->default(0.0000);
			$table->decimal('indiviso_terreno', 14, 4)->default(0.0000);
			$table->decimal('superficie_terreno', 14, 4)->default(0.0000);
			$table->decimal('indiviso_areas_comunes', 14, 4)->default(0.0000);
			$table->decimal('superficie_construccion', 14, 4)->default(0.0000);
			$table->decimal('indiviso_accesoria', 14, 4)->default(0.0000);
			$table->decimal('superficie_escritura', 14, 4)->default(0.0000);
			$table->decimal('superficie_vendible', 14, 4)->default(0.0000);

			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idavaluo')->references('idavaluo')->on('avaluos')->onUpdate('cascade');
			$table->foreign('idusossuelo')->references('idusossuelos')->on('cat_usos_suelos')->onUpdate('cascade');
			$table->foreign('id_cimentacion')->references('idcimentacion')->on('cat_cimentaciones')->onUpdate('cascade');
			$table->foreign('id_estructura')->references('idestructura')->on('cat_estructuras')->onUpdate('cascade');
			$table->foreign('id_muro')->references('idmuro')->on('cat_muros')->onUpdate('cascade');
			$table->foreign('id_entrepiso')->references('identrepiso')->on('cat_entrepisos')->onUpdate('cascade');
			$table->foreign('id_techo')->references('idtecho')->on('cat_techos')->onUpdate('cascade');
			$table->foreign('id_barda')->references('idbarda')->on('cat_bardas')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS avaluo_inmueble CASCADE;");
	}

}
