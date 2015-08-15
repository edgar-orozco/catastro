<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatUpdateFactoresAef extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$sql = <<<EoFn
            DROP FUNCTION IF EXISTS update_factores_aef();
            CREATE OR REPLACE FUNCTION update_factores_aef() RETURNS void AS $$
            DECLARE
                v_row1 RECORD;
            BEGIN
                -- FACTOR CONSERVACION
                FOR v_row1 IN SELECT idfactorconservacion, factor_conservacion, valor_factor_conservacion FROM cat_factores_conservacion ORDER BY idfactorconservacion LOOP
                    --UPDATE aem_analisis SET fk_conservacion = v_row1.idfactorconservacion WHERE factor_conservacion = v_row1.valor_factor_conservacion;
                    UPDATE aef_construcciones SET fk_conservacion = v_row1.idfactorconservacion WHERE factor_conservacion = v_row1.valor_factor_conservacion;
                    UPDATE aef_terrenos SET fk_top = v_row1.idfactorconservacion WHERE top = v_row1.valor_factor_conservacion;
                END LOOP;

                -- FACTOR FORMA
                FOR v_row1 IN SELECT idfactorforma, valor_factor_forma FROM cat_factores_forma ORDER BY idfactorforma LOOP
                    UPDATE aem_homologacion SET fk_forma = v_row1.idfactorforma WHERE forma = v_row1.valor_factor_forma;
                    UPDATE aef_terrenos SET fk_forma = v_row1.idfactorforma WHERE forma = v_row1.valor_factor_forma;
                END LOOP;

                -- FACTOR FRENTE
                FOR v_row1 IN SELECT idfactorfrente, valor_factor_frente FROM cat_factores_frente ORDER BY idfactorfrente LOOP
                    UPDATE aem_homologacion SET fk_frente = v_row1.idfactorfrente WHERE frente = v_row1.valor_factor_frente;
                    UPDATE aef_terrenos SET fk_frente = v_row1.idfactorfrente WHERE frente = v_row1.valor_factor_frente;
                END LOOP;

                -- FACTOR UBICACION
                FOR v_row1 IN SELECT idfactorubicacion, valor_factor_ubicacion FROM cat_factores_ubicacion ORDER BY idfactorubicacion LOOP
                    UPDATE aem_homologacion SET fk_ubicacion = v_row1.idfactorubicacion WHERE ubicacion = v_row1.valor_factor_ubicacion;
                    UPDATE aem_analisis SET fk_ubicacion = v_row1.idfactorubicacion WHERE factor_ubicacion = v_row1.valor_factor_ubicacion;
                END LOOP;

                -- FACTOR ZONA
                FOR v_row1 IN SELECT idfactorzona, valor_factor_zona FROM cat_factores_zonas ORDER BY idfactorzona LOOP
                    UPDATE aem_homologacion SET fk_zona = v_row1.idfactorzona WHERE zona = v_row1.valor_factor_zona;
                    UPDATE aem_analisis SET fk_zona = v_row1.idfactorzona WHERE factor_zona = v_row1.valor_factor_zona;
                END LOOP;

            END;
            $$ LANGUAGE plpgsql;
EoFn;

		DB::connection('corevat')->getPdo()->exec($sql);
		DB::connection('corevat')->getPdo()->exec("SELECT update_factores_aef()");
		DB::connection('corevat')->getPdo()->exec("DROP FUNCTION IF EXISTS update_factores_aef()");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		$sql = "DROP FUNCTION IF EXISTS update_factores_aef()";
		DB::connection()->getPdo()->exec($sql);
	}

}
