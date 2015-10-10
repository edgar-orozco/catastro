<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatosValuacionConstruccionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('datos_valuacion_construcciones', function(Blueprint $table)
		{
			$table->increments('id');

            //IDentificacion del tramite
            $table->integer('tramite_id');
            $table->string('clave');
            $table->string('cuenta');

            //Identificador(FK) de la valuacion del predio donde se encuentra la construccion ubicada
            $table->integer('valuacion_terreno_id');

            //Id de construccion
            $table->integer('construccion_num')->nullable();

            //Superficie de construccion
            $table->decimal('sup_terreno',18,2)->nullable();

            $table->boolean('es_alberca')->default(false)->nullable();
            $table->integer('tipoalberca_id')->nullable();

            $table->integer('conservacion_id')->nullable();
            $table->integer('tipo_id')->nullable();
            $table->integer('piso_id')->nullable();
            $table->integer('techo_id')->nullable();
            $table->integer('muros_id')->nullable();
            $table->integer('hidraulicas_id')->nullable();
            $table->integer('sanitarias_id')->nullable();
            $table->integer('electricas_id')->nullable();
            $table->decimal('avance',5,2)->nullable();
            $table->integer('anio_construccion')->nullable();
            $table->integer('edad')->nullable();

            //Clase preponderante de las 16 que puede obtenerse, es la FK que apunta a vcategorias_construccion y determina el valor unitario
            $table->integer('clase_id')->nullable();

            //Se agregan los posibles demeritos de la construccion
            $table->decimal('demerito_edad',5,2)->nullable();
            $table->decimal('demerito_avance',5,2)->nullable();

            //El valor unitario que se determinó debido a la clase preponderante y el municipio donde se encuentra la construccion
            $table->decimal('valor_unitario',18,2)->nullable();

            //El valor de construcción antes de demeritos es el valor unitario x superficie de construccion
            $table->decimal('valor',18,2)->nullable();

            //El valor ajustado es el porcentaje demeritado = valor x (demerito edad + demerito avance)
            $table->decimal('valor_ajustado',18,2)->nullable();

            $table->timestamps();
		});

        //Declaramos las llaves diferidas
        $sqls[]="ALTER TABLE datos_valuacion_construcciones ADD CONSTRAINT fk_datos_valuacion_construcciones_valuacion_terreno_id
                FOREIGN KEY (valuacion_terreno_id ) REFERENCES datos_valuacion_terrenos(id) DEFERRABLE";

        $sqls[]="ALTER TABLE datos_valuacion_construcciones ADD CONSTRAINT fk_datos_valuacion_construcciones_valuacion_tramite_id
                FOREIGN KEY (tramite_id ) REFERENCES tramites(id) DEFERRABLE";

        $sqls[]="ALTER TABLE datos_valuacion_construcciones ADD CONSTRAINT fk_datos_valuacion_construcciones_valuacion_tipo_id
                FOREIGN KEY (tipo_id ) REFERENCES vtipos_construccion(id) DEFERRABLE";

        $sqls[]="ALTER TABLE datos_valuacion_construcciones ADD CONSTRAINT fk_datos_valuacion_construcciones_valuacion_clase_id
                FOREIGN KEY (clase_id ) REFERENCES vcategorias_construccion(id) DEFERRABLE";

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
		Schema::drop('datos_valuacion_construcciones');
	}

}
