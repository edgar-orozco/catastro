<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpObtieneActualizacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$existe = DB::select("select proname,pg_get_function_arguments(oid) from pg_proc where proname ='sp_optiene_actualizacion'");
                if(count($existe) > 0) {

                	DB::statement("DROP FUNCTION sp_optiene_actualizacion(p_clave text)");
									}
		$predios= <<<FinSP
		CREATE OR REPLACE FUNCTION sp_optiene_actualizacion (IN p_clave TEXT)

RETURNS FLOAT

AS
$$
DECLARE
--VARIABLE
r_datos CURSOR FOR SELECT ep.anio, ep.impuesto, ep.ejercicio FROM emision_predial AS ep WHERE ep.clave = ''||p_clave||'';
c_datos record;

v_inpc_a inpc.inpc%type;
v_mes_a INTEGER;
v_anio_a INTEGER;
r_1 FLOAT;
r_2 FLOAT;
res1 FLOAT = 0;



BEGIN
 --Obtengo el año y mes anterior
 select (extract(MONTH from current_date)-1)into v_mes_a;
 select (extract(YEAR from current_date)-1)into v_anio_a;
 --Ontengo el inpc anterior
 select ip.inpc into v_inpc_a
 from inpc as ip
 where ip.mes =  v_mes_a
 and ip.anio = v_anio_a;
--Se hace el recorido de la tabla emision_predial

  FOR c_datos IN r_datos LOOP

    IF c_datos.ejercicio = 1 THEN

      SELECT ((v_inpc_a / ip.inpc)*c_datos.impuesto) - c_datos.impuesto into r_1
      FROM  inpc as ip
      WHERE ip.anio = extract(YEAR  FROM c_datos.anio) AND
         ip.mes = 5;

      res1 := res1 + r_1;
    ELSEIF c_datos.ejercicio = 2 THEN

      SELECT ((v_inpc_a / ip.inpc)*c_datos.impuesto) - c_datos.impuesto INTO r_2
      FROM  inpc as ip
      WHERE ip.anio = extract(YEAR  FROM c_datos.anio) AND
         ip.mes = 11;

      res1 := res1 + r_2;
    END IF;
  END LOOP;


RETURN res1;
END;
$$
LANGUAGE 'plpgsql';
FinSP;
DB::connection()->getPdo()->exec($predios);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$sql = "DROP FUNCTION IF EXISTS sp_optiene_actualizacion();";
		DB::connection()->getPdo()->exec($sql);
	}

}
