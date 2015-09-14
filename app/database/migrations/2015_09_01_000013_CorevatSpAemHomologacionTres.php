<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatSpAemHomologacionTres extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

--
DROP TRIGGER IF EXISTS aem_homologacion_before ON aem_homologacion;
DROP FUNCTION IF EXISTS aem_homologacion_before();
CREATE FUNCTION aem_homologacion_before() RETURNS TRIGGER AS $$
	DECLARE
		v_superficie NUMERIC(15,2); -- LA SUPERFICIE TOTAL DEL INMUEBLE
		v_idavaluo INTEGER;
		v_idaem INTEGER;
	BEGIN
		
		SELECT idavaluoenfoquemercado INTO v_idaem FROM aem_comp_terrenos WHERE idaemcompterreno = new.idaemcompterreno;
		SELECT idavaluo INTO v_idavaluo FROM avaluo_enfoque_mercado WHERE idavaluoenfoquemercado = v_idaem;
		SELECT superficie_total_terreno INTO v_superficie FROM avaluo_inmueble WHERE idavaluo = v_idavaluo;
	
		IF ( v_superficie > 0 ) THEN
			new.superficie = round( power((new.superficie_terreno / v_superficie), 0.166666666666667), 2 );
		END IF;

		new.valor_unitario_resultante_m2 = new.valor_unitario * new.zona * new.ubicacion * new.frente * new.forma * new.superficie * new.valor_unitario_negociable;
		
		RETURN NEW;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aem_homologacion_before BEFORE INSERT OR UPDATE ON aem_homologacion FOR EACH ROW EXECUTE PROCEDURE aem_homologacion_before();
COMMENT ON FUNCTION aem_homologacion_before() IS '';

--
DROP TRIGGER IF EXISTS aem_homologacion_after ON aem_homologacion;
DROP FUNCTION IF EXISTS aem_homologacion_after();
CREATE FUNCTION aem_homologacion_after() RETURNS TRIGGER AS $$
	DECLARE
		v_idaem INTEGER;
		vup NUMERIC(15,2); -- VALOR UNITARIO PROMEDIO
		vap NUMERIC(15,2); -- VALOR APLICABLE PROMEDIO
	BEGIN
		IF ( TG_OP = 'INSERT' OR  TG_OP = 'UPDATE' ) THEN
			SELECT idavaluoenfoquemercado INTO v_idaem FROM aem_comp_terrenos WHERE idaemcompterreno = new.idaemcompterreno;
		ELSIF (TG_OP = 'DELETE') THEN
			SELECT idavaluoenfoquemercado INTO v_idaem FROM aem_comp_terrenos WHERE idaemcompterreno = old.idaemcompterreno;
		END IF;

		SELECT avg(valor_unitario_resultante_m2) INTO vup FROM aem_homologacion WHERE idavaluoenfoquemercado = v_idaem;
		SELECT avg(valor_unitario_resultante_m2) INTO vap FROM aem_homologacion WHERE idavaluoenfoquemercado = v_idaem AND in_promedio = 1;
		IF (vup IS NULL) THEN
			vup := 0;
		END IF;
		IF (vap IS NULL) THEN
			vap := 0;
		END IF;
		
		UPDATE avaluo_enfoque_mercado SET valor_unitario_promedio = vup, valor_aplicado_m2 = round( vap, 2) WHERE idavaluoenfoquemercado = v_idaem;
		
		RETURN NULL;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aem_homologacion_after AFTER INSERT OR UPDATE OR DELETE ON aem_homologacion FOR EACH ROW EXECUTE PROCEDURE aem_homologacion_after();
COMMENT ON FUNCTION aem_homologacion_after() IS '';

EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aem_homologacion_before ON aem_homologacion;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aem_homologacion_before();");

		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aem_homologacion_after ON aem_homologacion;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aem_homologacion_after();");

	}

}
