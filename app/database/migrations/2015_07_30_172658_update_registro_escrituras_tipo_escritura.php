<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRegistroEscriturasTipoEscritura extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registro_escrituras', function(Blueprint $table)
        {

							if(schema::hasColumn('registro_escrituras', 'valor_comercia'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN valor_comercia');
							}

							$table->string('tipo_escritura')->nullable();
							$table->decimal('valor_comercial',18,2)->nullable();
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
