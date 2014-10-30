<?php

use Illuminate\Database\Migrations\Migration;

class CreateImpuestoPredialFunction extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        $sql = <<<FinFunc
    --Función para calcular el impuesto predial.
    CREATE OR REPLACE FUNCTION impuesto_predial(tipo_predio VARCHAR, valor_catastral DOUBLE PRECISION, anioinp INT, mesinp INT)
     RETURNS DOUBLE PRECISION AS $$
    DECLARE
        cf DOUBLE PRECISION; -- La cuota fija. TODO: Se debe pasar a NUMERIC
        ex DOUBLE PRECISION; -- El porcentaje sobre excedente. TODO: Se debe pasar a NUMERIC
        li DOUBLE PRECISION; -- El límite inferior. TODO: Se debe pasar a NUMERIC
        ls DOUBLE PRECISION; -- El límite superior. TODO: Se debe pasar a NUMERIC
        vf DOUBLE PRECISION; -- El valor fiscal. (valor_catastral * .20) TODO: Se debe pasar a NUMERIC
        smv DOUBLE PRECISION; -- El salario mínimo vigente. TODO: Se debe pasar a NUMERIC
        exc DOUBLE PRECISION; -- El valor excedente (valor fiscal - límite inferior). TODO: Se debe pasar a NUMERIC
        impMinUrbano DOUBLE PRECISION; --El impuesto minimo anual para urbano. TODO: Se debe pasar a NUMERIC
        impMinRustico DOUBLE PRECISION; --El impuesto minimo anual para rustico . TODO: Se debe pasar a NUMERIC
        impuesto DOUBLE PRECISION; --El impuesto predial resultante. TODO: Se debe pasar a NUMERIC
    BEGIN

        smv := 63.77; --TODO: Se debe sacar de una tabla de configuracion de smv
        vf := valor_catastral * 0.2; --TODO: Se debe sacar de una tabla de configuración (el 0.2 que sale de la ley)

        SELECT cuota_fija, pct_excedente, limite_inferior, limite_superior INTO cf, ex, li, ls
        FROM   tasa_predial
        WHERE  limite_inferior <= vf AND limite_superior >= vf AND anio = anioinp and mes = mesinp;

        impMinRustico := 3 * smv; --TODO: Se debe sacar de una tabla de impuesto minimo anual (sale de la ley art 97)
        impMinUrbano := 4 * smv;
        exc = vf - li;
        impuesto := (vf - li) * ex + cf;

        IF tipo_predio = 'U' AND impuesto < impMinUrbano THEN impuesto := impMinUrbano; END IF;
        IF tipo_predio = 'R' AND impuesto < impMinRustico THEN impuesto := impMinRustico; END IF;

        --RAISE NOTICE 'Tipo: %',$1;
        --RAISE NOTICE 'Min U: %',impMinUrbano;
        --RAISE NOTICE 'Min R: %',impMinRustico;
        --RAISE NOTICE 'cf: %,excd: % psex: % li: %, ls: %, vf: % ', cf, exc, ex, li, ls, vf;
        --RAISE NOTICE ' => (valor_catastral * 0.2 - li) * ex + cf => (% - %) * % + % = %', vf, li, ex, cf, impuesto;
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
        $sql = "DROP FUNCTION IF EXISTS impuesto_predial(varchar, double precision, int, int);";
        DB::connection()->getPdo()->exec($sql);
	}

}
