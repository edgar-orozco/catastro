<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaDatosReimpresion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$existe = DB::select("select proname,pg_get_function_arguments(oid) from pg_proc where proname ='sp_get_datos_predio'");
                if(count($existe) > 0) {

                	DB::statement("DROP FUNCTION sp_get_datos_predio(p_clave text)");
									}

		$predios= <<<FinSP
	CREATE OR REPLACE FUNCTION sp_get_datos_predio (
	IN p_clave TEXT
) 
RETURNS TABLE (clave VARCHAR, propietario TEXT, municipio VARCHAR, direccion TEXT, impuesto NUMERIC, valor_catastral NUMERIC, anio_periodo VARCHAR, adeudo NUMERIC) 
AS 
$$
DECLARE
	v_consulta	TEXT;
BEGIN
	v_consulta := ' 
	SELECT  pf.clave  clave
				 , sp_get_propietarios(pf.clave) propietario
				 , cm.nombre_municipio municipio
				 , TRIM(''Sin domicilio función en construcción'') direccion
				 , pf.impuesto impuesto
				 , pf.valor_catastral valor_catastral
				 , sp_get_anio_ejercicio(pf.clave) anio_periodo
				 , COALESCE(ad.total,0) adeudo
			FROM (((fiscal pf LEFT JOIN predios pr ON (substr(pf.clave, 8,15) = pr.clave))
				   LEFT JOIN municipios cm ON (substr(pf.clave,4,3) = cm.municipio))
				   LEFT JOIN (SELECT ep.clave
						    					 , SUM(ep.impuesto) total
												FROM emision_predial ep
											 WHERE ep.tipo_emision = ''REZAGO'' -- el normal es impuesto 	
												 AND ep.ref_pago IS NULL
												 AND ep.cod_cancelado IS NULL 
												 AND ep.codigo_pago IS NULL
											 GROUP BY ep.clave) ad ON (pf.clave = ad.clave))
where pf.clave = '''||p_clave||'''';



	RETURN QUERY EXECUTE v_consulta;

END;
$$
LANGUAGE 'plpgsql' VOLATILE;
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
		$sql = "DROP FUNCTION IF EXISTS sp_get_datos_predio();";
		DB::connection()->getPdo()->exec($sql);
	}

}
