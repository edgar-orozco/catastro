<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatSpAemCompTerrenos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
$sql = <<<EoFn

--
DROP TRIGGER IF EXISTS aem_comp_terrenos_before ON aem_comp_terrenos;
DROP FUNCTION IF EXISTS aem_comp_terrenos_before();
CREATE FUNCTION aem_comp_terrenos_before() RETURNS TRIGGER AS $$
	BEGIN
		IF ( TG_OP = 'INSERT' OR  TG_OP = 'UPDATE' ) THEN
			IF ( new.superficie_terreno = 0 ) THEN
				new.precio_unitario_m2_terreno = 0.00;
			ELSE
				new.precio_unitario_m2_terreno = round(new.precio / new.superficie_terreno, 2);
			END IF;
			
			IF ( new.superficie_construida = 0 ) THEN
				new.precio_unitario_m2_construccion = 0.00;
			ELSE
				new.precio_unitario_m2_construccion = round(new.precio / new.superficie_construida, 2);
			END IF;
			
		END IF;
		RETURN NEW;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aem_comp_terrenos_before BEFORE INSERT OR UPDATE ON aem_comp_terrenos FOR EACH ROW EXECUTE PROCEDURE aem_comp_terrenos_before();
COMMENT ON FUNCTION aem_comp_terrenos_before() IS '';

--
DROP TRIGGER IF EXISTS aem_comp_terrenos_after ON aem_comp_terrenos;
DROP FUNCTION IF EXISTS aem_comp_terrenos_after();
CREATE FUNCTION aem_comp_terrenos_after() RETURNS TRIGGER AS $$
	BEGIN
		IF ( TG_OP = 'INSERT' ) THEN
			INSERT INTO aem_homologacion (idaemcompterreno, idavaluoenfoquemercado, superficie_terreno, valor_unitario, comparable, created_at) 
			VALUES(new.idaemcompterreno, new.idavaluoenfoquemercado, new.superficie_terreno, new.precio_unitario_m2_terreno, new.ubicacion, new.created_at);
		ELSIF (TG_OP = 'UPDATE') THEN
			UPDATE aem_homologacion SET superficie_terreno = new.superficie_terreno, valor_unitario = new.precio_unitario_m2_terreno, comparable = new.ubicacion 
			WHERE idaemcompterreno = new.idaemcompterreno;
		END IF;
		RETURN NEW;
	END;
$$ LANGUAGE plpgsql;
CREATE TRIGGER aem_comp_terrenos_after AFTER INSERT OR UPDATE ON aem_comp_terrenos FOR EACH ROW EXECUTE PROCEDURE aem_comp_terrenos_after();
COMMENT ON FUNCTION aem_comp_terrenos_after() IS '';

EoFn;
		DB::connection('corevat')->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aem_comp_terrenos_before ON aem_comp_terrenos;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aem_comp_terrenos_before();");
		
		DB::connection('corevat')->getPdo()->exec("DROP TRIGGER IF EXISTS aem_comp_terrenos_after ON aem_comp_terrenos;");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS aem_comp_terrenos_after();");
		
	}

}
