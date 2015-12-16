<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatSpAefConstruccionesDos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

--
DROP TRIGGER IF EXISTS aef_construcciones_before ON aef_construcciones;
DROP FUNCTION IF EXISTS aef_construcciones_before();
CREATE FUNCTION aef_construcciones_before() RETURNS TRIGGER AS $$
	DECLARE
		v_idavaluo INTEGER;
		v_superficie_construccion NUMERIC(20,4);
	BEGIN
		SELECT idavaluo INTO v_idavaluo FROM avaluo_enfoque_fisico WHERE  idavaluoenfoquefisico = new.idavaluoenfoquefisico;
		SELECT superficie_construccion INTO v_superficie_construccion FROM avaluo_inmueble WHERE idavaluo = v_idavaluo;
		--new.superficie_m2 = v_superficie_construccion;
		new.factor_resultante = new.factor_edad * new.factor_conservacion;
		new.valor_neto = new.valor_nuevo * new.factor_resultante;
		new.valor_parcial_construccion = new.superficie_m2 * new.valor_neto;
		RETURN NEW;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aef_construcciones_before BEFORE INSERT OR UPDATE ON aef_construcciones FOR EACH ROW EXECUTE PROCEDURE aef_construcciones_before();
COMMENT ON FUNCTION aef_construcciones_before() IS '';

--
DROP TRIGGER IF EXISTS aef_construcciones_after ON aef_construcciones;
DROP FUNCTION IF EXISTS aef_construcciones_after();
CREATE FUNCTION aef_construcciones_after() RETURNS TRIGGER AS $$
	DECLARE
		v_idavaluoenfoquefisico INTEGER;
		sum_valor_parcial_construccion NUMERIC(20,4);
		sum_superficie_m2 NUMERIC(20,4);
		
	BEGIN
		IF ( TG_OP = 'INSERT' OR TG_OP = 'UPDATE' ) THEN 
			v_idavaluoenfoquefisico = new.idavaluoenfoquefisico;
		ELSIF (TG_OP = 'DELETE') THEN
			v_idavaluoenfoquefisico = old.idavaluoenfoquefisico;
		END IF;
		
		SELECT SUM(valor_parcial_construccion), SUM(superficie_m2) INTO sum_valor_parcial_construccion, sum_superficie_m2 
		FROM aef_construcciones WHERE idavaluoenfoquefisico = v_idavaluoenfoquefisico;
		
		IF ( sum_valor_parcial_construccion IS NULL) THEN
			sum_valor_parcial_construccion = 0;
		END IF;
		
		IF ( sum_superficie_m2 IS NULL) THEN
			sum_superficie_m2 = 0;
		END IF;
		
		UPDATE avaluo_enfoque_fisico SET valor_construccion = sum_valor_parcial_construccion, total_metros_construccion = sum_superficie_m2,
		total_valor_fisico = valor_terreno + sum_valor_parcial_construccion + subtotal_area_condominio + subtotal_instalaciones_especiales
		WHERE idavaluoenfoquefisico = v_idavaluoenfoquefisico;
		
		RETURN NULL;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aef_construcciones_after AFTER INSERT OR UPDATE OR DELETE ON aef_construcciones FOR EACH ROW EXECUTE PROCEDURE aef_construcciones_after();
COMMENT ON FUNCTION aef_construcciones_after() IS '';


EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aef_construcciones_before ON aef_construcciones;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aef_construcciones_before();");

		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aef_construcciones_after ON aef_construcciones;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aef_construcciones_after();");

	}

}
