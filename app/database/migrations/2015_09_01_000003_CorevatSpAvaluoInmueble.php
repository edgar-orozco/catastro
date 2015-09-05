<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatSpAvaluoInmueble extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

DROP TRIGGER IF EXISTS avaluo_inmueble_after ON avaluo_inmueble;
DROP FUNCTION IF EXISTS avaluo_inmueble_after();
CREATE FUNCTION avaluo_inmueble_after() RETURNS TRIGGER AS $$
	DECLARE
		v_idavaluo INTEGER;
		v_idavaluoenfoquefisico INTEGER;
	BEGIN
		SELECT idavaluoenfoquefisico INTO v_idavaluoenfoquefisico FROM avaluo_enfoque_fisico WHERE idavaluo = new.idavaluo;
		
		IF (old.superficie_total_terreno != new.superficie_total_terreno) THEN
			UPDATE aef_terrenos SET superficie = new.superficie_total_terreno WHERE idavaluoenfoquefisico = v_idavaluoenfoquefisico;
		END IF;
		IF (old.superficie_construccion != new.superficie_construccion) THEN
			UPDATE aef_construcciones SET superficie_m2 = new.superficie_construccion WHERE idavaluoenfoquefisico = v_idavaluoenfoquefisico;
		END IF;
		IF (old.superficie_vendible != new.superficie_vendible) THEN
			UPDATE avaluo_enfoque_mercado SET superficie_construida = new.superficie_vendible WHERE idavaluo = new.idavaluo;
		END IF;
		RETURN NULL;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER avaluo_inmueble_after AFTER UPDATE ON avaluo_inmueble FOR EACH ROW EXECUTE PROCEDURE avaluo_inmueble_after();
COMMENT ON FUNCTION avaluo_inmueble_after() IS '';

EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS avaluo_inmueble_after ON avaluo_inmueble;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS avaluo_inmueble_after();");
	}

}
