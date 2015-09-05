<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatSpAefTerrenos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

DROP TRIGGER IF EXISTS aef_terrenos_before ON aef_terrenos;
DROP FUNCTION IF EXISTS aef_terrenos_before();
CREATE FUNCTION aef_terrenos_before() RETURNS TRIGGER AS $$
	DECLARE
		v_idavaluo INTEGER;
		v_superficie_total_terreno NUMERIC(20,4);
		v_valor_aplicado_m2 NUMERIC(20,4);
		v_indiviso_terreno NUMERIC(20,4);
	BEGIN
		SELECT idavaluo INTO v_idavaluo FROM avaluo_enfoque_fisico WHERE  idavaluoenfoquefisico = new.idavaluoenfoquefisico;
		SELECT superficie_total_terreno, indiviso_terreno INTO v_superficie_total_terreno, v_indiviso_terreno FROM avaluo_inmueble WHERE idavaluo = v_idavaluo;
		SELECT valor_aplicado_m2 INTO v_valor_aplicado_m2 FROM avaluo_enfoque_mercado WHERE idavaluo = v_idavaluo;
		
		new.superficie = v_superficie_total_terreno;
		new.factor_resultante = new.irregular * new.top * new.frente * new.forma * new.otros;
		
		new.valor_unitario_neto = v_valor_aplicado_m2 * new.factor_resultante;
		
		new.valor_parcial = new.superficie * new.valor_unitario_neto;
		
		new.indiviso = v_indiviso_terreno;
		
		RETURN NEW;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aef_terrenos_before BEFORE INSERT OR UPDATE ON aef_terrenos FOR EACH ROW EXECUTE PROCEDURE aef_terrenos_before();
COMMENT ON FUNCTION aef_terrenos_before() IS '';

--
DROP TRIGGER IF EXISTS aef_terrenos_after ON aef_terrenos;
DROP FUNCTION IF EXISTS aef_terrenos_after();
CREATE FUNCTION aef_terrenos_after() RETURNS TRIGGER AS $$
	DECLARE
		v_idavaluoenfoquefisico INTEGER;
		sum_valor_parcial NUMERIC(20,4);
		
	BEGIN
		IF ( TG_OP = 'INSERT' OR TG_OP = 'UPDATE' ) THEN 
			v_idavaluoenfoquefisico = new.idavaluoenfoquefisico;
		ELSIF (TG_OP = 'DELETE') THEN
			v_idavaluoenfoquefisico = old.idavaluoenfoquefisico;
		END IF;
		
		SELECT SUM(valor_parcial) INTO sum_valor_parcial FROM aef_terrenos WHERE idavaluoenfoquefisico = v_idavaluoenfoquefisico;
		
		IF ( sum_valor_parcial IS NULL ) THEN
			sum_valor_parcial = 0;
		END IF;
		
		UPDATE avaluo_enfoque_fisico SET valor_terreno = sum_valor_parcial, total_valor_fisico = sum_valor_parcial + valor_construccion + subtotal_area_condominio + subtotal_instalaciones_especiales WHERE idavaluoenfoquefisico = v_idavaluoenfoquefisico;

		RETURN NULL;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aef_terrenos_after AFTER INSERT OR UPDATE OR DELETE ON aef_terrenos FOR EACH ROW EXECUTE PROCEDURE aef_terrenos_after();
COMMENT ON FUNCTION aef_terrenos_after() IS '';

EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS avaluo_enfoque_mercado_after ON avaluo_enfoque_mercado;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS avaluo_enfoque_mercado_after();");

		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS avaluo_enfoque_mercado_after ON avaluo_enfoque_mercado;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS avaluo_enfoque_mercado_after();");

	}

}
