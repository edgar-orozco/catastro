<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FunctionSpGetAnioEjercicio extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$anio= <<<FinSP
		CREATE OR REPLACE FUNCTION sp_get_anio_ejercicio (IN p_clave VARCHAR) 
-- Retorna el año y ejercicio mas antiguo, sino existe aduedo regresa el año actual
RETURNS VARCHAR LANGUAGE 'plpgsql'
AS 
$$
DECLARE	
	v_anio 				VARCHAR;
	v_ejercicio 	VARCHAR;
	v_todo				VARCHAR;
BEGIN
		IF p_clave <> '' or p_clave IS NOT NULL THEN
				SELECT to_char(MIN(ep.anio),'YYYY')
						 , MIN(ep.ejercicio)
					INTO v_anio
						 , v_ejercicio
					FROM emision_predial ep
				 WHERE ep.clave = TRIM(p_clave)
					 AND ep.codigo_pago IS NULL 
					 AND ep.cod_cancelado IS NULL 
					 AND ep.ref_pago IS NULL;

				 v_todo := v_anio ||'-'||v_ejercicio;
		ELSE 
			SELECT TO_CHAR(TIMESTAMP,'YYYY') INTO v_todo; 
		END IF;

		RETURN v_todo;
END;
$$
FinSP;
DB::connection()->getPdo()->exec($anio);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$aniod = "DROP FUNCTION IF EXISTS sp_get_anio_ejercicio();";
		DB::connection()->getPdo()->exec($aniod);
	}

}
