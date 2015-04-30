<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearSupConstruccion extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $existe = DB::select("SELECT proname,pg_get_function_arguments(oid) from pg_proc where proname ='sp_get_supconstruccion'");
        if (count($existe) > 0) {

            DB::statement("DROP FUNCTION IF EXISTS sp_get_supconstruccion(IN clave  TEXT);");
        }
        $funtion = <<<FinSP
		
CREATE OR REPLACE FUNCTION sp_get_supconstruccion(IN clave  TEXT) 

RETURNS FLOAT
AS
$$
DECLARE
consulta FLOAT;
BEGIN
	SELECT SUM(const.sup_const) INTO consulta FROM construcciones as const  WHERE const.clave_catas = clave;


RETURN consulta;
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
        $sql = "DROP FUNCTION IF EXISTS sp_get_supconstruccion();";
        DB::connection()->getPdo()->exec($sql);
    }

}
