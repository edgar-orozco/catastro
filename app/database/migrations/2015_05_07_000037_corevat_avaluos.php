<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('avaluos', function(Blueprint $table) {
			$table->increments('idavaluo');
			$table->integer('iduser');
			$table->string('proposito', 250);
			$table->string('finalidad', 250);
			$table->integer('idmunicipio');
			$table->integer('idestado');
			$table->date('fecha_reporte');
			$table->date('fecha_avaluo');
			$table->string('serie', 3)->default('N');
			$table->integer('folio');
			$table->string('foliocoretemp', 20);
			$table->integer('idtipoinmueble');
			$table->string('ubicacion', 300);
			$table->string('conjunto', 150);
			$table->string('colonia', 150);
			$table->string('cp', 6);
			$table->string('latitud', 50);
			$table->string('lat0', 3);
			$table->string('lat1', 2);
			$table->string('lat2', 6);
			$table->string('longitud', 50);
			$table->string('lon0', 3);
			$table->string('lon1', 2);
			$table->string('lon2', 6);
			$table->string('altitud', 50);
			$table->integer('idregimenpropiedad');

			$table->string('cuenta_predial', 10);
			$table->string('cuenta_catastral', 25);
			$table->string('nombre_solicitante', 100);
			$table->string('nombre_propietario', 100);

			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('iduser')->references('iduser')->on('usuarios')->onUpdate('cascade');
			$table->foreign('idmunicipio')->references('idmunicipio')->on('municipios')->onUpdate('cascade');
			$table->foreign('idtipoinmueble')->references('idtipoinmueble')->on('cat_tipo_inmueble')->onUpdate('cascade');
			$table->foreign('idregimenpropiedad')->references('idregimenpropiedad')->on('cat_regimen_propiedad')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS avaluos CASCADE;");
	}

}
