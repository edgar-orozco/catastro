<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GetDatosPropietarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$existe = DB::select("select proname,pg_get_function_arguments(oid) from pg_proc where proname ='datos_propietarios'");
        if (count($existe) > 0) {

            DB::statement("DROP FUNCTION IF EXISTS datos_propietarios(IN p_clave TEXT)");
        }
        $funtion = <<<FinSP
CREATE OR REPLACE FUNCTION datos_propietarios (IN p_clave TEXT)
RETURNS TEXT 
AS $$
DECLARE
v_cuantos	INTEGER;
v_propietario	TEXT;
v_curp TEXT;

BEGIN
		IF p_clave <> '' or p_clave IS NOT NULL THEN

				SELECT COUNT(*)
					INTO v_cuantos
					FROM propietarios pp
				 WHERE pp.clave = p_clave;

				IF v_cuantos > 1 THEN -- Si tiene mas de un propietario
						SELECT array_to_string(ARRAY_AGG(ps.nombrec),' ;')
							INTO v_propietario
							FROM propietarios pt LEFT JOIN
									 (SELECT * FROM personas ORDER BY nombrec) ps
								ON (pt.id_propietario = ps.id_p)
						  WHERE pt.clave = p_clave;
				ELSE
						SELECT personas.nombres||' '||personas.apellido_paterno||' '||personas.apellido_materno||' '||personas.curp||' '||personas.rfc
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
LANGUAGE plpgsql;
FinSP;
        DB::connection()->getPdo()->exec($funtion);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        $sql = "DROP FUNCTION IF EXISTS datos_propietarios();";
        DB::connection()->getPdo()->exec($sql);
    }

}
