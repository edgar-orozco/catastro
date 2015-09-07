<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatSpAvaluos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

--
DROP TRIGGER IF EXISTS avaluos_after ON avaluos;
DROP FUNCTION IF EXISTS avaluos_after();
CREATE FUNCTION avaluos_after() RETURNS TRIGGER AS $$
	DECLARE
	BEGIN
		INSERT INTO avaluo_zona (idavaluo) VALUES (new.idavaluo);
		
		INSERT INTO avaluo_inmueble (idavaluo) VALUES (new.idavaluo);
		
		INSERT INTO avaluo_enfoque_mercado (idavaluo) VALUES (new.idavaluo);
		
		INSERT INTO avaluo_enfoque_fisico (idavaluo) VALUES (new.idavaluo);
		
		INSERT INTO avaluo_conclusiones (idavaluo) VALUES (new.idavaluo);
		
		INSERT INTO avaluo_fotos_planos (idavaluo) VALUES (new.idavaluo);
		
		RETURN NULL;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER avaluos_after AFTER INSERT ON avaluos FOR EACH ROW EXECUTE PROCEDURE avaluos_after();
COMMENT ON FUNCTION avaluos_after() IS '';


EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS avaluos_after ON avaluos;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS avaluos_after();");
	}

}
