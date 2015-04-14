<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaGetDatosPre extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$existe = DB::select("select proname,pg_get_function_arguments(oid) from pg_proc where proname ='sp_get_datos_pre'");
                if(count($existe) > 0) {

                	DB::statement("DROP FUNCTION sp_get_datos_pre(IN p_clave TEXT, IN municipio TEXT, IN entidad TEXT)");
									}
		$funtion= <<<FinSP
		CREATE OR REPLACE FUNCTION sp_get_datos_pre (
	IN p_clave TEXT, IN municipio TEXT, IN entidad TEXT
) 
RETURNS TABLE (tipo_predio VARCHAR, niveles INTEGER, folio VARCHAR, superficie_terreno NUMERIC, uso_construccion INTEGER) 
AS 
$$
DECLARE
	v_consulta	TEXT;
BEGIN
	v_consulta := ' 
		  SELECT tipo_predio, niveles, folio, superficie_terreno, uso_construccion
 from predios 
WHERE clave_catas='''||p_clave||''' 
and municipio='''||municipio||''' 
and entidad='''||entidad||'''
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
		$sql = "DROP FUNCTION IF EXISTS sp_get_datos_pre();";
		DB::connection()->getPdo()->exec($sql);
	}

}
