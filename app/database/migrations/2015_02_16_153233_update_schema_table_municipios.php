<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSchemaTableMunicipios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('user_municipio', function(Blueprint $table)
        {
                $existe = DB::select("SELECT constraint_name FROM information_schema.constraint_column_usage WHERE table_name = 'user_municipio'  AND constraint_name = 'user_municipio_municipio_id_foreign'");
                if(count($existe) > 0) {
                    // Se elimina la relacion con la tabla municipios
                    DB::statement('ALTER TABLE user_municipio DROP CONSTRAINT user_municipio_municipio_id_foreign');
                }
                // Se actualiza el tipo de la columna municipio_id
                DB::statement('ALTER TABLE user_municipio ALTER COLUMN municipio_id TYPE integer USING CAST (municipio_id as INTEGER);');
        });

		Schema::table('municipios', function(Blueprint $table)
		{
            // Se agregan los campos faltantes
            if (!Schema::hasColumn('municipios', 'gid') &&
                !Schema::hasColumn('municipios', 'geom') &&
                !Schema::hasColumn('municipios', 'nombre_municipio')
            )
            {
                // Se elimina el viejo indice
                DB::statement('ALTER TABLE municipios DROP CONSTRAINT municipios_pkey');
                // Se agregan los nuevos campos
                DB::statement('ALTER TABLE municipios ADD COLUMN nombre_municipio character varying(110);');
                DB::statement('ALTER TABLE municipios ADD COLUMN gid SERIAL');
                // Se agrega el campo geom de tipo geometry
                DB::statement('ALTER TABLE municipios ADD COLUMN geom geometry(MultiPolygon,32615);');
                // Se agrega el nuevo indice
                DB::statement('ALTER TABLE municipios ADD PRIMARY KEY (gid);');


            }
            // Se eliminan los campos que ya no son requeridos
            if (Schema::hasColumn('municipios', 'nom_mpo') &&
                Schema::hasColumn('municipios', 'nom_cabecera')
            ){
                $table->dropColumn('nom_mpo');
                $table->dropColumn('nom_cabecera');
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
		Schema::table('municipios', function(Blueprint $table)
		{
            // Se agregan los campos faltantes
            if (Schema::hasColumn('municipios', 'gid') &&
                Schema::hasColumn('municipios', 'geom') &&
                Schema::hasColumn('municipios', 'nombre_municipio')
            ) {
                // Se elimina el viejo indice
                $table->dropPrimary('gid');
                $table->dropColumn('gid');
                $table->dropColumn('nombre_municipio');
                // Se elimina el cmapo geom
                DB::statement('ALTER TABLE municipios DROP COLUMN geom;');
            }
            // Se eliminan los campos que ya no son requeridos
            if (!Schema::hasColumn('municipios', 'nom_mpo') &&
                !Schema::hasColumn('municipios', 'nom_cabecera')
            ) {
                $table->text('nom_mpo');
                $table->text('nom_cabecera');
                $table->primary('municipio');
            }
		});

        Schema::table('user_municipio', function(Blueprint $table)
        {
            // Se elimina la relacion con la tabla municipios
            $table->foreign('municipio_id')->references('municipio')->on('municipios')->onUpdate('cascade')->onDelete('cascade');
        });

    }

}
