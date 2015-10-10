<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateValuacionPrediosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('valuacion_predios', function(Blueprint $table)
		{
			$table->increments('id');

            //IDentificacion del tramite
            $table->integer('tramite_id');
            $table->string('clave');
            $table->string('cuenta');

            $table->decimal('valor_terreno', 18,2)->nullable();
            $table->decimal('valor_construccion', 18,2)->nullable();

            $table->date('fecha_valuacion')->nullable();
            $table->string('num_certificado')->nullable();

            $table->timestamps();
		});

        $sqls[]="ALTER TABLE valuacion_predios ADD CONSTRAINT fk_predios_tramite_id
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
		Schema::drop('valuacion_predios');
	}

}
