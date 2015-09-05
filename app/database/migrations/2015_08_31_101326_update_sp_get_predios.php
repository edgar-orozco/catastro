<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSpGetPredios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$existe = DB::select("select proname,pg_get_function_arguments(oid) from pg_proc where proname ='sp_get_predios'");
        if (count($existe) > 0) {

            DB::statement("DROP FUNCTION IF EXISTS sp_get_predios(IN p_clave TEXT, p_nombre_propietario TEXT,p_valor_inicial TEXT,p_valor_final TEXT,p_id_municipio TEXT,p_id_colonia TEXT,p_calle TEXT,p_codigo_postal TEXT,p_id_estatus TEXT,p_anio_periodo TEXT)");
        }
    $funtion= <<<FinSP
    CREATE OR REPLACE FUNCTION sp_get_predios (
	IN p_clave TEXT,
	IN p_nombre_propietario TEXT,
	IN p_valor_inicial TEXT,
	IN p_valor_final TEXT,
	IN p_id_municipio TEXT,
	IN p_id_colonia TEXT,
	IN p_calle TEXT,
	IN p_codigo_postal TEXT,
	IN p_id_estatus TEXT,
	IN p_anio_periodo TEXT
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
				 , REPLACE(TRIM(dp.ubicacion),'','',''&'') direccion
				 , pf.impuesto impuesto
				 , pf.valor_catastral valor_catastral
				 , sp_get_anio_ejercicio(pf.clave) anio_periodo
				 , COALESCE(ad.total,0) adeudo
			FROM (((fiscal pf LEFT JOIN predios pr ON (substr(pf.clave, 8,15) = pr.clave_catas))
				   
LEFT JOIN municipios cm ON (substr(pf.clave,4,3) = cm.municipio))
INNER JOIN datospredio  dp ON pf.clave = dp.clave
				   LEFT JOIN (SELECT ep.clave
						    					 , SUM(ep.impuesto) total
												FROM emision_predial ep
											 WHERE ep.tipo_emision = ''REZAGO'' -- el normal es impuesto 	
												 AND ep.ref_pago IS NULL
												 AND ep.cod_cancelado IS NULL 
												 AND ep.codigo_pago IS NULL
											 GROUP BY ep.clave) ad ON (pf.clave = ad.clave)) 
			WHERE NOT EXISTS (SELECT 1 
												  FROM ejecucion_fiscal ef 
												 WHERE ef.clave = pf.clave
													 AND ef.f_cancelacion IS NULL
													 AND ef.motivo_cancelacion IS NULL 
													 AND ef.id_ejecutor_cancelacion IS NULL) ';

	IF p_clave <> '' THEN 		
		v_consulta := v_consulta || ' AND pf.clave = '''||p_clave||'''';
	END IF;

	IF p_id_municipio <> '' THEN 
		v_consulta := v_consulta || ' AND  cm.municipio = '''||p_id_municipio||'''';
	END IF;

	IF p_valor_inicial <> '' AND p_valor_final = '' THEN
	-- Si solo envia el valor inicial, se retornan los mayor o igual
		v_consulta := v_consulta ||' AND pf.valor_catastral >= '||p_valor_inicial;
	ELSIF p_valor_inicial <> '' AND p_valor_final <> '' THEN
	-- Si envia ambos, se retornan el rango
		v_consulta := v_consulta ||' AND pf.valor_catastral >= '||p_valor_inicial;
		v_consulta := v_consulta ||' AND pf.valor_catastral <= '||p_valor_final;	  
	ELSIF p_valor_inicial = '' AND p_valor_final <> '' THEN
		v_consulta := v_consulta ||' AND pf.valor_catastral <= '||p_valor_final;
	END IF;

  IF p_nombre_propietario <> '' THEN
		v_consulta := v_consulta  ||' AND pf.clave IN (SELECT pp.clave 
																										 FROM propietarios pp
																											  , personas pr
																									  WHERE pp.id_propietario = pr.id_p
																										  AND UPPER(TRIM(pr.nombres ||'' ''||pr.apellido_paterno||'' ''||pr.apellido_materno))
																													LIKE ''%''||UPPER('''||p_nombre_propietario||''')||''%'')';

	END IF;

	v_consulta := v_consulta ||' LIMIT 100';

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
		$sql = "DROP FUNCTION IF EXISTS sp_get_predios();";
		DB::connection()->getPdo()->exec($sql);
	}

}
