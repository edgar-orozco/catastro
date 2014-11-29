<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateImpuestoPredialFunction extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        $sql = "DROP FUNCTION IF EXISTS impuesto_predial(varchar, DOUBLE PRECISION, int, int);";
        DB::connection()->getPdo()->exec($sql);
        $sql = "DROP FUNCTION IF EXISTS impuesto_predial(varchar, NUMERIC, int, int);";
        DB::connection()->getPdo()->exec($sql);

        $sql = <<<FinFunc
   --Función para calcular el impuesto predial.
    CREATE OR REPLACE FUNCTION impuesto_predial(tipo_predio VARCHAR, valor_catastral NUMERIC(12,2), anioinp INT, mesinp INT)
     RETURNS NUMERIC(10,2) AS $$
    DECLARE
        cf NUMERIC; -- La cuota fija.
        ex NUMERIC; -- El porcentaje sobre excedente.
        li NUMERIC; -- El límite inferior.
        ls NUMERIC; -- El límite superior.
        vf NUMERIC; -- El valor fiscal. (valor_catastral * .20)
        smv NUMERIC; -- El salario mínimo vigente.
        exc NUMERIC; -- El valor excedente (valor fiscal - límite inferior).
        impMinUrbano NUMERIC; --El impuesto minimo anual para urbano.
        impMinRustico NUMERIC; --El impuesto minimo anual para rustico.
        impuesto NUMERIC; --El impuesto predial resultante.
    BEGIN

        smv := 63.77; --TODO: Se debe sacar de una tabla de configuracion de smv
        vf := valor_catastral * 0.2; --TODO: Se debe sacar de una tabla de configuración (el 0.2 que sale de la ley)

        SELECT cuota_fija, pct_excedente, limite_inferior, limite_superior INTO cf, ex, li, ls
        FROM   tasa_predial
        WHERE  limite_inferior <= vf AND limite_superior >= vf AND anio = anioinp and mes = mesinp;

        impMinRustico := 3 * smv; --TODO: Se debe sacar de una tabla de impuesto minimo anual (sale de la ley art 97)
        impMinUrbano := 4 * smv;

        exc = vf - li;

        impuesto := (vf - li) * ex / 100 + cf;

        IF tipo_predio = 'U' AND impuesto < impMinUrbano THEN impuesto := impMinUrbano; END IF;
        IF tipo_predio = 'R' AND impuesto < impMinRustico THEN impuesto := impMinRustico; END IF;

        --RAISE NOTICE 'Tipo: %',$1;
        --RAISE NOTICE 'Min U: %',impMinUrbano;
        --RAISE NOTICE 'Min R: %',impMinRustico;
        --RAISE NOTICE 'cf: %,excd: % psex: % li: %, ls: %, vf: % ', cf, exc, ex, li, ls, vf;
        --RAISE NOTICE ' => (valor_catastral * 0.2 - li) * ex / 100 + cf => (% - %) * % / 100 + % = %', vf, li, ex, cf, impuesto;
        RETURN impuesto;
    END;
    $$ LANGUAGE plpgsql;
FinFunc;
        DB::connection()->getPdo()->exec($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
