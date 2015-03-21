<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaSpAnioVencido extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$existe = DB::select("select proname,pg_get_function_arguments(oid) from pg_proc where proname ='sp_get_anios_vencidos'");
                if(count($existe) > 0) {

                	DB::statement("DROP FUNCTION sp_get_anios_vencidos(IN p_clave TEXT)");
									}
		$funtion= <<<FinSP
		CREATE OR REPLACE FUNCTION sp_get_anios_vencidos (
	IN p_clave TEXT
) 
RETURNS TABLE (anio TEXT, adeudo NUMERIC) 
AS 
$$
DECLARE
	v_consulta	TEXT;
BEGIN
	v_consulta := ' 
		  SELECT 
to_char(anio,''yyyy'')
,SUM(impuesto)
 from emision_predial ep
where clave='''||p_clave||''' 
GROUP BY to_char(anio,''yyyy'') 
ORDER BY 1 
 ';

	

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
		//
	}

}
