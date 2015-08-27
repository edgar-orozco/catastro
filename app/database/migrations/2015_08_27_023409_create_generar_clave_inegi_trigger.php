<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenerarClaveInegiTrigger extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        $sql = <<<FinFunc

        CREATE OR REPLACE FUNCTION generar_clave_inegi() RETURNS TRIGGER AS $$
          DECLARE
            loc VARCHAR; --Sirve para almacenar temporalmente la consulta de localidad
          BEGIN

            --Si la clave es nula entonces regresamos;
            IF NEW.clave_catas ISNULL THEN RETURN NEW; END IF ;

           SELECT
             localidad INTO loc
           FROM localidades_a
           WHERE ST_Contains(geom, (
             SELECT st_centroid(geom) FROM predios WHERE clave_catas = NEW.clave_catas AND municipio = NEW.municipio LIMIT 1
           ));

           NEW.clave_inegi :=   NEW.entidad
                                ||
                                '000' --Región catastral 3 caracteres
                                ||
                                NEW.municipio -- Municipio 3 caracteres
                                ||
                                substring((string_to_array(NEW.clave_catas, '-'))[2] from 2)  --Zona catastral 2 (En la base son 3!)
                                ||
                                loc --Localidad 4
                                ||
                                '000'  --Sector catastral 3
                                ||
                                (string_to_array(NEW.clave_catas, '-'))[2]    --Manzana 3
                                ||
                                substring((string_to_array(NEW.clave_catas, '-'))[3] from 2) --Predio 5 <- en este se recorre un caracter empezando p izq para tener 5
                                ||
                                '00' --Edificio 2
                                ||
                                '0000' --Unidad 4
                                ;

           RETURN NEW;
          END;
        $$ LANGUAGE plpgsql;

FinFunc;
        DB::connection()->getPdo()->exec($sql);

        //Se asocia la funcion del trigger con la tabla y las operaciones de insert y de update
        $sql = "CREATE TRIGGER generar_clave_inegi_trigger BEFORE INSERT OR UPDATE
                ON predios FOR EACH ROW
                EXECUTE PROCEDURE generar_clave_inegi();";
        DB::connection()->getPdo()->exec($sql);

        //Se ejecuta un fake update para actualizar todos los registros anteriores al trigger con datos en clave_inegi
        DB::connection()->getPdo()->exec("UPDATE predios SET clave_catas = clave_catas");

    }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        $sql ="drop trigger IF EXISTS generar_clave_inegi_trigger on predios;";
        DB::connection()->getPdo()->exec($sql);
        $sql ="drop function if exists generar_clave_inegi();";
        DB::connection()->getPdo()->exec($sql);
	}

}
