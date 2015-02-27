<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FunctionSpGetPredios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql= <<<FinSP
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
RETURNS TABLE (clave VARCHAR, propietario TEXT, municipio VARCHAR, direccion TEXT, impuesto NUMERIC, valor_catastral NUMERIC, anio_periodo VARCHAR, adeudo NUMERIC, status VARCHAR) 
AS 
$$
DECLARE
	v_consulta	TEXT;
	v_where TEXT DEFAULT 'WHERE';
BEGIN
	v_consulta := ' 
	SELECT  pf.clave  clave
				 , sp_get_propietarios(pf.clave) propietario
				 , cm.nombre_municipio municipio
				 , TRIM(''Sin domicilio, función en construcción'') direccion
				 , pf.impuesto impuesto
				 , pf.valor_catastral valor_catastral
				 , sp_get_anio_ejercicio(pf.clave) anio_periodo
				 , ad.total adeudo
				 , (SELECT ef.cve_status
						  FROM ejecucion_fiscal ef
						 WHERE ef.clave = pf.clave
						) status
			FROM (((fiscal pf LEFT JOIN predios pr ON (substr(pf.clave, 8,15) = pr.clave))
				 LEFT JOIN municipios cm ON (substr(pf.clave,4,3) = cm.municipio))
				LEFT JOIN (SELECT ep.clave
												, SUM(ep.impuesto) total
							FROM emision_predial ep
						 WHERE ep.tipo_emision = ''REZAGO'' -- el normal es impuesto 	
							 AND ep.ref_pago IS NULL
							 AND ep.cod_cancelado IS NULL 
							 AND ep.codigo_pago IS NULL
						 GROUP BY ep.clave) ad ON (pf.clave = ad.clave)) ';

	IF p_clave <> '' THEN 		
		v_consulta := v_consulta ||v_where||' pf.clave = '''||p_clave||'''';
	  v_where := 'AND';
	END IF;

	IF p_id_municipio <> '' THEN 
		v_consulta := v_consulta ||v_where||' cm.municipio = '''||p_id_municipio||'''';
	  v_where := 'AND';
	END IF;

	IF p_valor_inicial <> '' AND p_valor_final = '' THEN
	-- Si solo envia el valor inicial, se retornan los mayor o igual
		v_consulta := v_consulta ||v_where||' AND pf.valor_catastral >= '||p_valor_inicial;
	  v_where := 'AND';
	ELSIF p_valor_inicial <> '' AND p_valor_final <> '' THEN
	-- Si envia ambos, se retornan el rango
		v_consulta := v_consulta ||v_where||' pf.valor_catastral >= '||p_valor_inicial;
		v_consulta := v_consulta ||' AND pf.valor_catastral <= '||p_valor_final;	  
	  v_where := 'AND';

	ELSIF p_valor_inicial = '' AND p_valor_final <> '' THEN
		v_consulta := v_consulta ||v_where||'  pf.valor_catastral <= '||p_valor_final;
	  v_where := 'AND';
	END IF;

  IF p_nombre_propietario <> '' THEN
		v_consulta := v_consulta  ||v_where||' pf.clave IN (SELECT pp.clave 
																										 FROM propietarios pp
																											  , personas pr
																									  WHERE pp.id_propietario = pr.id_p
																										  AND pr.nombrec
																													LIKE ''%''||UPPER('''||p_nombre_propietario||''')||''%'')';

	END IF;

	v_consulta := v_consulta ||' LIMIT 100';

	RETURN QUERY EXECUTE v_consulta;

END;
$$
LANGUAGE 'plpgsql' VOLATILE;
FinSP;
DB::connection()->getPdo()->exec($sql);
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
