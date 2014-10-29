<?php

use Illuminate\Database\Schema\Blueprint;
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

    CREATE OR REPLACE FUNCTION impuesto_predial(VARCHAR, DOUBLE PRECISION, INT, INT)
    --Donde $1 Es el
    RETURNS DOUBLE PRECISION AS $$
        DECLARE
          cf DOUBLE PRECISION; -- La cuota fija. TODO: Se debe pasar a NUMERIC
          ex DOUBLE PRECISION; -- El excedente. TODO: Se debe pasar a NUMERIC
          li DOUBLE PRECISION; -- El límite inferior. TODO: Se debe pasar a NUMERIC
          ls DOUBLE PRECISION; -- El límite superior. TODO: Se debe pasar a NUMERIC
          vf DOUBLE PRECISION; -- El valor fiscal. TODO: Se debe pasar a NUMERIC
          smv DOUBLE PRECISION; -- El salario mínimo vigente. TODO: Se debe pasar a NUMERIC
          impMinUrbano DOUBLE PRECISION; --El impuesto minimo anual para urbano. TODO: Se debe pasar a NUMERIC
          impMinRustico DOUBLE PRECISION; --El impuesto minimo anual para rustico . TODO: Se debe pasar a NUMERIC

          impuesto DOUBLE PRECISION; --El impuesto predial. TODO: Se debe pasar a NUMERIC

          BEGIN

          smv := 63.77; --TODO: Se debe sacar de una tabla de configuracion de smv
          vf := $2 * 0.2; --TODO: Se debe sacar de una tabla de configuración (el 0.2 que sale de la ley)

          SELECT cuota_fija, pct_excedente, limite_inferior, limite_superior INTO cf, ex, li, ls
            FROM   tasa_predial
            WHERE  limite_inferior <= vf AND limite_superior >= vf AND anio=$3 and mes=$4;

          impMinRustico := 3 * smv; --TODO: Se debe sacar de una tabla de impuesto minimo anual (sale de la ley art 97)
          impMinUrbano := 4 * smv;

          impuesto := (vf - li) * ex + cf;
          IF $1 = 'U' AND impuesto < impMinUrbano THEN impuesto := impMinUrbano; END IF;
          IF $1 = 'R' AND impuesto < impMinRustico THEN impuesto := impMinRustico; END IF;
          --RAISE NOTICE 'Tipo: %',$1;
          --RAISE NOTICE 'Min U: %',impMinUrbano;
          --RAISE NOTICE 'Min R: %',impMinRustico;
          RAISE NOTICE 'cf: %, ex: % li: %, ls: %, vf: %', cf, ex, li, ls, vf;
          RETURN impuesto;
    END;
    $$ LANGUAGE plpgsql;
	";
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
        $sql = "DROP PROCEDURE IF EXISTS sp_insert_tag";
        DB::connection()->getPdo()->exec($sql);
	}

}
