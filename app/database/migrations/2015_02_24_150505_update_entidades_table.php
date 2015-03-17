<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateEntidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{ 
		Schema::table('entidades', function(Blueprint $table)

		 // Se agregan los campos faltantes
            if (!Schema::hasColumn('entidades', 'gid') &&
                !Schema::hasColumn('entidades', 'geom') &&              
            )

		{
			// Se agregan los campos en la tabla
			DB::statement('ALTER TABLE entidades ADD COLUMN gid SERIAL');
			DB::statement('ALTER TABLE entidades ADD COLUMN geom geometry(Multipolygon,32615);');
			 // Se agrega la llave primaria
            DB::statement('ALTER TABLE entidades ADD PRIMARY KEY (gid);');
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('entidades', function(Blueprint $table)
		{
			
		 // Se agregan los campos faltantes
            if (!Schema::hasColumn('entidades', 'gid') &&
                !Schema::hasColumn('entidades', 'geom') && 
                )
             {
                // Eliminar campos creados
                $table->dropPrimary('gid');
                $table->dropColumn('gid');
                DB::statement('ALTER TABLE entidades DROP COLUMN geom;');
            }


		});
	}

}
