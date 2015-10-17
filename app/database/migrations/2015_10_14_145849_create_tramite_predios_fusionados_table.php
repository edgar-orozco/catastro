<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTramitePrediosFusionadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tramite_predios_fusionados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tramite_id');
			$table->string('clave')->nullable();
			$table->string('cuenta')->nullable();
			$table->timestamps();
		});

        $sqls[]="ALTER TABLE tramite_predios_fusionados ADD CONSTRAINT fk_tramite_predios_fusionados_tramite_id
                FOREIGN KEY (tramite_id ) REFERENCES tramites(id) DEFERRABLE";

        //Ejecutamos todas las llaves foraneas diferidas
        foreach($sqls as $sql) {
            DB::connection()->getPdo()->exec($sql);
        }

    }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tramite_predios_fusionados');
	}

}
