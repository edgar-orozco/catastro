<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRegistroEscriturasNuevaEstructura extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registro_escrituras', function(Blueprint $table)
        {

						if(schema::hasColumn('registro_escrituras', 'tesoreria'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN tesoreria');
							}

							if(schema::hasColumn('registro_escrituras', 'municipio_id'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN municipio_id');
							}

							if(schema::hasColumn('registro_escrituras', 'escritura_num'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN escritura_num');
							}

							if(schema::hasColumn('registro_escrituras', 'naturaleza_acto'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN naturaleza_acto');
							}

							if(schema::hasColumn('registro_escrituras', 'fecha_instrumento'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN fecha_instrumento');
							}

							if(schema::hasColumn('registro_escrituras', 'fecha_firma'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN fecha_firma');
							}

							$table->integer('valor_registro')->nullable();
							$table->string('folio_avaluo')->nullable();
							$table->decimal('valor_comercia',18,2)->nullable();
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
