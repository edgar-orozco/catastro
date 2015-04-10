<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTomasaguaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tomasagua', function(Blueprint $table)
		{

			//Se agregan los campos a la tabla

			$table->boolean('medidor_instalado');
			$table->string('num_medidor',50);
			$table->string('num_contrato',50);
			$table->integer('id_tipotoma');
			$table->integer('id_usuariotoma');
			$table->foreign('id_usuariotoma')->references('id_p')->on('personas')->onUpdate('cascade')->onDelete('cascade');     

			 // Se elimina campos de las tablas
            if (Schema::hasColumn('tomasagua', 'cuenta_agua'))
            {
            	 DB::statement('ALTER TABLE tomasagua DROP COLUMN cuenta_agua');
            }
          
            if (Schema::hasColumn('tomasagua', 'toma_instalada'))
            {
            	 DB::statement('ALTER TABLE tomasagua DROP COLUMN toma_instalada');            	
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
		Schema::table('tomasagua', function(Blueprint $table)
		{
			//Se eliminan los campos creados
			$table->dropColumn('medidor_instalado');
			$table->dropColumn('num_medidor');
			$table->dropColumn('num_contrato');
			$table->dropColumn('id_tipotoma');
			$table->dropColumn('id_usuariotoma');

			//Se agregan los campos eliminados
			$table->string('cuenta_agua');
			$table->string('toma_instalada');

		});
	}

}
