<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRegistroEscriturasFinal extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::table('registro_escrituras', function(Blueprint $table)
        {

							if(schema::hasColumn('registro_escrituras', 'tipo_predio'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN tipo_predio');
							}
							if(schema::hasColumn('registro_escrituras', 'lvm_antecedente'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN lvm_antecedente');
							}
							if(schema::hasColumn('registro_escrituras', 'avaluo_por'))
							{
								DB::statement('ALTER TABLE registro_escrituras DROP COLUMN avaluo_por');
							}

							$table->string('tipo_predio')->nullable();
							$table->date('fecha_instrumento')->nullable();
							$table->date('fecha_firma')->nullable();
							$table->string('naturaleza_contrato')->nullable();
							$table->string('niveles')->nullable();
							$table->string('estado_conserv')->nullable();
				});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

	}

}
