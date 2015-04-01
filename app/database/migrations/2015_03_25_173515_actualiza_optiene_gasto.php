<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActualizaOptieneGasto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$existe = DB::select("select proname,pg_get_function_arguments(oid) from pg_proc where proname ='sp_optiene_gasto'");
                if(count($existe) > 0) {
                    DB::statement("DROP FUNCTION IF EXISTS sp_optiene_gasto( IN p_gid TEXT, IN monto TEXT)");
                }
    $funtion= <<<FinSP
    CREATE OR REPLACE FUNCTION sp_optiene_gasto (
 IN p_gid TEXT,
 IN monto TEXT
) 
RETURNS TABLE (procentaje NUMERIC) 
AS 
$$
DECLARE
 v_consulta TEXT;
BEGIN

v_consulta := ' 
SELECT 
((gastos_ejecucion_porcentaje  * '||monto||')/100) as  porcentaje
FROM configuracion_municipal 
WHERE municipio ='''||p_gid||'''';

RETURN QUERY EXECUTE v_consulta;

END;
$$
LANGUAGE 'plpgsql' VOLATILE;
FinSP;
DB::connection()->getPdo()->exec($funtion);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$sql = "DROP FUNCTION IF EXISTS sp_optiene_gasto();";
		DB::connection()->getPdo()->exec($sql);
	}

}
