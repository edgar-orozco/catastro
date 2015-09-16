<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatSpAemAnalisisDos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

-- CUANDO SE INSERTA O MODIFICA HAY QUE VOLVER A CALCULAR LOS CAMPOS DEL ENFOQUE MERCADO
DROP TRIGGER IF EXISTS aem_analisis_before ON aem_analisis;
DROP FUNCTION IF EXISTS aem_analisis_before();
CREATE FUNCTION aem_analisis_before() RETURNS TRIGGER AS $$
	DECLARE
		v_idavaluo INTEGER;
		v_idaem INTEGER;
		v_idaeminformacion INTEGER;
		v_superficie_vendible NUMERIC(20,4);
		
	BEGIN
		IF ( new.superficie_construccion = 0 ) THEN
			new.valor_unitario_m2 = 0.00;
		ELSE
			new.valor_unitario_m2 = new.precio_venta / new.superficie_construccion;
		END IF;
		
		SELECT idavaluoenfoquemercado INTO v_idaem FROM aem_informacion WHERE idaeminformacion = new.idaeminformacion;
		SELECT idavaluo INTO v_idavaluo FROM avaluo_enfoque_mercado WHERE idavaluoenfoquemercado = v_idaem;
		SELECT superficie_vendible INTO v_superficie_vendible FROM avaluo_inmueble WHERE idavaluo = v_idavaluo;
		
		IF ( v_superficie_vendible = 0 ) THEN
			new.factor_superficie = 0.00;
		ELSE
			new.factor_superficie = round( power( (new.superficie_construccion / v_superficie_vendible), 0.166666666666667), 2);
		END IF;

		new.factor_resultante = new.factor_zona * new.factor_ubicacion * new.factor_superficie * new.factor_edad * new.factor_conservacion * new.factor_negociacion;
		new.valor_unitario_resultante_m2 = new.valor_unitario_m2 * new.factor_resultante;

		RETURN NEW;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aem_analisis_before BEFORE INSERT OR UPDATE ON aem_analisis FOR EACH ROW EXECUTE PROCEDURE aem_analisis_before();
COMMENT ON FUNCTION aem_analisis_before() IS '';

 --
DROP TRIGGER IF EXISTS aem_analisis_after ON aem_analisis;
DROP FUNCTION IF EXISTS aem_analisis_after();
CREATE FUNCTION aem_analisis_after() RETURNS TRIGGER AS $$
	DECLARE
		v_count INTEGER;
		v_promedio_terreno NUMERIC(20, 4);
		v_promedio_construccion NUMERIC(20, 4);
		v_promedio_vu NUMERIC(20, 4);
		v_min_vu NUMERIC(20, 4);
		v_max_vu NUMERIC(20, 4);
		v_promedio_vur NUMERIC(20, 4);
		v_min_vur NUMERIC(20, 4);
		v_max_vur NUMERIC(20, 4);
		
	BEGIN
		-- PRIMERO VALIDAMOS QUE EXISTAN REGISTROS CON LA CONDICION id_promedio = 1
		SELECT COUNT(*) INTO v_count FROM aem_analisis WHERE idavaluoenfoquemercado = new.idavaluoenfoquemercado AND in_promedio = 1;
		IF ( v_count IS NULL OR v_count <= 0) THEN
			v_promedio_terreno := 0.00;
			v_promedio_construccion := 0.00;
			v_promedio_vu := 0.00;
			v_min_vu := 0.00;
			v_max_vu := 0.00;
			v_promedio_vur := 0.00;
			v_min_vur := 0.00;
			v_max_vur := 0.00;
		
		ELSE
	   		-- Obtenemos el Promedio Terreno
			SELECT avg(superficie_terreno) INTO v_promedio_terreno FROM aem_analisis WHERE idavaluoenfoquemercado = new.idavaluoenfoquemercado AND in_promedio = 1;

			-- Obtenemos el Promedio Construccion
			SELECT avg(superficie_construccion) INTO v_promedio_construccion FROM aem_analisis WHERE idavaluoenfoquemercado = new.idavaluoenfoquemercado AND in_promedio = 1;

			-- Obtenemos el Promedio Directo
			SELECT avg(valor_unitario_m2) INTO v_promedio_vu FROM aem_analisis WHERE idavaluoenfoquemercado = new.idavaluoenfoquemercado AND in_promedio = 1;

			-- Obtenemos el Mínimo Directo
			SELECT min(valor_unitario_m2) INTO v_min_vu FROM aem_analisis WHERE idavaluoenfoquemercado = new.idavaluoenfoquemercado AND in_promedio = 1;

			-- Obtenemos el Maximo Directo
			SELECT max(valor_unitario_m2) INTO v_max_vu FROM aem_analisis WHERE idavaluoenfoquemercado = new.idavaluoenfoquemercado AND in_promedio = 1;

			-- Obtenemos el Promedio Resultante
			SELECT avg(valor_unitario_resultante_m2) INTO v_promedio_vur FROM aem_analisis WHERE idavaluoenfoquemercado = new.idavaluoenfoquemercado AND in_promedio = 1;

			-- Obtenemos el Mínimo Resultante
			SELECT min(valor_unitario_resultante_m2) INTO v_min_vur FROM aem_analisis WHERE idavaluoenfoquemercado = new.idavaluoenfoquemercado AND in_promedio = 1;

			-- Obtenemos el Maximo Resultante
			SELECT max(valor_unitario_resultante_m2) INTO v_max_vur FROM aem_analisis WHERE idavaluoenfoquemercado = new.idavaluoenfoquemercado AND in_promedio = 1;
		END IF;
		
		UPDATE avaluo_enfoque_mercado 
		SET promedio_directo = v_promedio_vu, 
			minimo_directo = v_min_vu, 
			maximo_directo = v_max_vu, 
			promedio_analisis = v_promedio_vur, 
			minimo_analisis = v_min_vur, 
			maximo_analisis = v_max_vur,
			valor_comparativo_mercado = round((superficie_construida * v_promedio_vur), -1)
		WHERE idavaluoenfoquemercado = new.idavaluoenfoquemercado;
		RETURN NULL;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aem_analisis_after AFTER INSERT OR UPDATE ON aem_analisis FOR EACH ROW EXECUTE PROCEDURE aem_analisis_after();
COMMENT ON FUNCTION aem_analisis_after() IS '';


EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aem_analisis_before ON aem_analisis;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aem_analisis_before();");

		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aem_analisis_after ON aem_analisis;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aem_analisis_after();");

	}

}
