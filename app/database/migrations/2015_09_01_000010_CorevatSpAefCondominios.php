<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatSpAefCondominios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

DROP TRIGGER IF EXISTS aef_condominios_before ON aef_condominios;
DROP FUNCTION IF EXISTS aef_condominios_before();
CREATE FUNCTION aef_condominios_before() RETURNS TRIGGER AS $$
	DECLARE
		v_idavaluo INTEGER;
		v_superficie_construccion NUMERIC(20,4);
		v_indiviso_areas_comunes  NUMERIC(14,4);
	BEGIN
		SELECT idavaluo INTO v_idavaluo FROM avaluo_enfoque_fisico WHERE  idavaluoenfoquefisico = new.idavaluoenfoquefisico;
		SELECT indiviso_areas_comunes INTO v_indiviso_areas_comunes FROM avaluo_inmueble WHERE idavaluo = v_idavaluo;
		
		IF ( v_indiviso_areas_comunes IS NULL ) THEN
			v_indiviso_areas_comunes = 0;
		END IF;
		new.indiviso = v_indiviso_areas_comunes;
		
		new.factor_resultante = new.factor_edad * new.factor_conservacion;
		
		IF ( new.indiviso = 0 ) THEN
			new.valor_parcial = 0;
		ELSE
			new.valor_parcial = ( new.cantidad * new.valor_nuevo * new.factor_resultante * 100 ) / new.indiviso;
		END IF;
		
		RETURN NEW;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aef_condominios_before BEFORE INSERT OR UPDATE ON aef_condominios FOR EACH ROW EXECUTE PROCEDURE aef_condominios_before();
COMMENT ON FUNCTION aef_condominios_before() IS '';


DROP TRIGGER IF EXISTS aef_condominios_after ON aef_condominios;
DROP FUNCTION IF EXISTS aef_condominios_after();
CREATE FUNCTION aef_condominios_after() RETURNS TRIGGER AS $$
	DECLARE
		v_idavaluoenfoquefisico INTEGER;
		sum_valor_parcial NUMERIC(20,4);
		
	BEGIN
		IF ( TG_OP = 'INSERT' OR TG_OP = 'UPDATE' ) THEN 
			v_idavaluoenfoquefisico = new.idavaluoenfoquefisico;
		ELSIF (TG_OP = 'DELETE') THEN
			v_idavaluoenfoquefisico = old.idavaluoenfoquefisico;
		END IF;
		
		SELECT SUM(valor_parcial) INTO sum_valor_parcial FROM aef_condominios WHERE idavaluoenfoquefisico = v_idavaluoenfoquefisico;
		
		IF ( sum_valor_parcial IS NULL ) THEN
			sum_valor_parcial = 0;
		END IF;
		
		UPDATE avaluo_enfoque_fisico SET subtotal_area_condominio = sum_valor_parcial, 
			total_valor_fisico = valor_terreno + valor_construccion + sum_valor_parcial + subtotal_instalaciones_especiales 
				WHERE idavaluoenfoquefisico = v_idavaluoenfoquefisico;
		
		RETURN NULL;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aef_condominios_after AFTER INSERT OR UPDATE OR DELETE ON aef_condominios FOR EACH ROW EXECUTE PROCEDURE aef_condominios_after();
COMMENT ON FUNCTION aef_condominios_after() IS '';


EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aef_condominios_before ON aef_condominios;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aef_condominios_before();");

		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aef_condominios_after ON aef_condominios;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aef_condominios_after();");

	}

}
