<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatCatFinalidad extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->create('cat_finalidad', function(Blueprint $table) {
			$table->increments('idfinalidad');
			$table->string('finalidad', 100);
			$table->integer('status')->default(1);
			$table->nullableTimestamps();
		});

		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('COMPRAVENTA', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('DONACIÓN', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('REMATE', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('ADJUDICIÓN DE BIENES POR HERENCIA', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('APORTACIÓN A ASOCIACIONES O SOCIEDADES', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('CESIÓN DE DERECHOS', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('FUSIÓN DE SOCIEDADES', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('DACIÓN EN PAGO', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('CONSTITUCIÓN DE USUFRUCTO VITALICIO', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('EXTINCIÓN DEL USUFRUCTO VITALICIO TEMPORAL', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('CESIONES DE DERECHOS ENTRE COPROPIETARIOS', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('ENAJENACIÓN A TRAVÉS DE FIFEICOMISOS', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('PERMUTA', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('DIVISIÓN DE LA COPROPIEDAD', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('DISOLUCIÓN DE LA SOCIEDAD CONYUGAL', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('PAGO DE IMPUESTO DE TRASLACION DE DOMINIO', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('CONOCER EL VALOR COMERCIAL', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('DECLARACIÓN DE OBRA NUEVA', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('DILIGENCIAS JUDICIALES', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('AFECTACIÓN AL INMUEBLE', now());");
		DB::connection('corevat')->getPdo()->exec("INSERT INTO cat_finalidad (finalidad, created_at) VALUES ('CONOCER LA RENTABILIDAD DEL INMUEBLE', now());");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS cat_finalidad CASCADE;");
	}

}
