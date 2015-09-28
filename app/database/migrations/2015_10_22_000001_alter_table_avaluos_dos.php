<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAvaluosDos extends Migration {

	/**
	 * Run the migrations.
	 * 
	 * @return void
	 */
	public function up() {
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ALTER COLUMN latitud TYPE VARCHAR(300);");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ALTER COLUMN longitud TYPE VARCHAR(300);");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ALTER COLUMN altitud TYPE VARCHAR(300);");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ADD COLUMN tp_coordenada BOOLEAN;");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ADD COLUMN sistema_coordenadas VARCHAR(50);");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ADD COLUMN datum VARCHAR(50);");
		
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_predial = '000-U-000000' WHERE trim(cuenta_predial) = '';");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral = '00-000-000-0000-000000' WHERE trim(cuenta_catastral) = '';");
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ALTER COLUMN latitud TYPE VARCHAR(50);");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ALTER COLUMN longitud TYPE VARCHAR(50);");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos ALTER COLUMN altitud TYPE VARCHAR(50);");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos DROP COLUMN tp_coordenada;");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos DROP COLUMN sistema_coordenadas;");
		DB::connection('corevat')->getPdo()->exec("ALTER TABLE avaluos DROP COLUMN datum;");
	}

}
