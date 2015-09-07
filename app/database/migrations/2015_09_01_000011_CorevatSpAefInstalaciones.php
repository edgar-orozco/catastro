<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatSpAefInstalaciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

DROP TRIGGER IF EXISTS aef_instalaciones_before ON aef_instalaciones;
DROP FUNCTION IF EXISTS aef_instalaciones_before();
CREATE FUNCTION aef_instalaciones_before() RETURNS TRIGGER AS $$
	BEGIN
		new.factor_resultante = new.factor_edad * new.factor_conservacion;
		
		new.valor_neto = new.valor_nuevo * new.factor_resultante;
		
		new.valor_parcial = new.cantidad * new.valor_neto;

		RETURN NEW;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aef_instalaciones_before BEFORE INSERT OR UPDATE ON aef_instalaciones FOR EACH ROW EXECUTE PROCEDURE aef_instalaciones_before();
COMMENT ON FUNCTION aef_instalaciones_before() IS '';


DROP TRIGGER IF EXISTS aef_instalaciones_after ON aef_instalaciones;
DROP FUNCTION IF EXISTS aef_instalaciones_after();
CREATE FUNCTION aef_instalaciones_after() RETURNS TRIGGER AS $$
	DECLARE
		v_idavaluoenfoquefisico INTEGER;
		sum_valor_parcial NUMERIC(20,4);
		
	BEGIN
		IF ( TG_OP = 'INSERT' OR TG_OP = 'UPDATE' ) THEN 
			v_idavaluoenfoquefisico = new.idavaluoenfoquefisico;
		ELSIF (TG_OP = 'DELETE') THEN
			v_idavaluoenfoquefisico = old.idavaluoenfoquefisico;
		END IF;

		SELECT SUM(valor_parcial) INTO sum_valor_parcial FROM aef_instalaciones WHERE idavaluoenfoquefisico = v_idavaluoenfoquefisico;
		
		IF ( sum_valor_parcial IS NULL ) THEN
			sum_valor_parcial = 0;
		END IF;
		
		UPDATE avaluo_enfoque_fisico SET subtotal_instalaciones_especiales = sum_valor_parcial, 
			total_valor_fisico = valor_terreno + valor_construccion + subtotal_area_condominio + sum_valor_parcial 
				WHERE idavaluoenfoquefisico = v_idavaluoenfoquefisico;
		RETURN NULL;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aef_instalaciones_after AFTER INSERT OR UPDATE OR DELETE ON aef_instalaciones FOR EACH ROW EXECUTE PROCEDURE aef_instalaciones_after();
COMMENT ON FUNCTION aef_instalaciones_after() IS '';

EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aef_instalaciones_before ON aef_instalaciones;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aef_instalaciones_before();");

		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aef_instalaciones_after ON aef_instalaciones;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aef_instalaciones_after();");

	}

}
