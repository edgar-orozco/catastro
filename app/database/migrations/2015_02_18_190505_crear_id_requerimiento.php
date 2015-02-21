<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearIdRequerimiento extends Migration
{

    /**
     * Para aplicar esta migración y que no genere problemas en las bases de datos donde ya se tiene un dump com un campo serial en la columna
     * debemos preguntar:
     * 1. Existe la columna id_requerimiento ?
     * 2. Es del tipo serial? (es decir que en su valor defualt contenga la palaba nextval)
     * Si existen es estas dos condiciones entonces no se aplica el parche
     * Si no existen, entonces se aplica
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requerimientos', function (Blueprint $table) {

            $es_serial = DB::select("SELECT column_name, data_type, column_default FROM information_schema.columns WHERE table_name = 'requerimientos' AND data_type = 'integer' AND column_name = 'id_requerimiento' AND column_default LIKE 'nextval%'");

            if(Schema::hasColumn('requerimientos', 'id_requerimiento') && !count($es_serial)) {

                //Para cambiar un tipo integer por un serial primero debemos crear su secuencia:
                DB::statement("CREATE SEQUENCE id_requerimiento_seq");

                //Después tenemos que asociar el valor default de la columna a la secuencia
                DB::statement("ALTER TABLE requerimientos ALTER id_requerimiento SET DEFAULT nextval('id_requerimiento_seq')");
            }
        });
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
