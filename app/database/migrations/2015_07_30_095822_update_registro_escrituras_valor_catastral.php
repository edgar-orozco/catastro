<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRegistroEscriturasValorCatastral extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registro_escrituras', function(Blueprint $table)
        {

						if(schema::hasColumn('registro_escrituras', 'valor_catastral'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN valor_catastral');
								$table->decimal('valor_catastral',18,2)->nullable();
							}
							if(schema::hasColumn('registro_escrituras', 'importe_operacion'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN importe_operacion');
								$table->decimal('importe_operacion',18,2)->nullable();

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
