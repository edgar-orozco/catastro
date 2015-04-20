<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSpGetPropietarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$propietarios= <<<FinSP
		CREATE OR REPLACE FUNCTION sp_get_propietarios (IN p_clave VARCHAR) 
-- Retorna el año y ejercicio mas antiguo, sino existe aduedo regresa el año actual
RETURNS TEXT LANGUAGE 'plpgsql'
AS 
$$
DECLARE	
	v_cuantos			INTEGER;
	v_propietario	TEXT;

BEGIN
		IF p_clave <> '' or p_clave IS NOT NULL THEN

				SELECT COUNT(*)
					INTO v_cuantos
					FROM propietarios pp
				 WHERE pp.clave = p_clave;

				IF v_cuantos > 1 THEN -- Si tiene mas de un propietario
						SELECT array_to_string(ARRAY_AGG(ps.nombres||' '||ps.apellido_paterno||' '||ps.apellido_materno),' ;') 
							INTO v_propietario
							FROM propietarios pt LEFT JOIN 
									 (SELECT * FROM personas ORDER BY nombres)  ps 
								ON (pt.id_propietario = ps.id_p)
						  WHERE pt.clave = p_clave;				
				ELSE
						SELECT personas.nombrec
							INTO v_propietario
						  FROM propietarios
								 , personas 
						 WHERE propietarios.id_propietario = personas.id_p
							 AND propietarios.clave = p_clave;
				END IF;
				 
		ELSE 
			v_propietario := NULL; 
		END IF;

		RETURN v_propietario;
END;
$$
FinSP;
DB::connection()->getPdo()->exec($propietarios);

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			$propietarios = "DROP FUNCTION IF EXISTS sp_get_propietarios();";
		DB::connection()->getPdo()->exec($propietarios);
	}

}
