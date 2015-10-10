<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatosValuacionTerrenosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('tramites_construccion_valores');
        Schema::dropIfExists('tramites_valores');

		Schema::create('datos_valuacion_terrenos', function(Blueprint $table)
		{

            //PK de la tabla
			$table->increments('id');

            //IDentificacion del tramite
            $table->integer('tramite_id');
            $table->string('clave');
            $table->string('cuenta');
            $table->integer('estatus')->default(0);

            //Datos valuacion terreno
            $table->decimal('sup_terreno',18,2);
            $table->decimal('valor_calle',18,2);
            $table->integer('valor_calle_id')->nullable();
            $table->integer('usosuelo_id')->nullable();

            //Incrementos por esquina
            $table->integer('incremnento_esquina_id')->nullable();

            //Demerito por escaso frente
            $table->decimal('demerito_escaso_frente', 12,2)->nullable();

            //Demeritos por profundidad
            $table->decimal('demerito_profundidad_frente', 18,2)->nullable();
            $table->decimal('demerito_profundidad', 18,2)->nullable();

            //Demerito por irregularidad
            $table->decimal('demerito_irregular', 18, 2)->nullable();

            //Demerito por excavacion
            $table->decimal('demerito_superficie_excavada', 12, 2)->nullable();
            $table->decimal('demerito_profundidad_excavada', 12, 2)->nullable();

            //Demerito por desnivel
            $table->decimal('demerito_desnivel_area',18,2)->nullable();
            $table->decimal('demerito_desnivel_porcentaje',5,2)->nullable();

            //Demerito por predio interior
            $table->decimal('superficie_paso_servidumbre',18,2)->nullable(); //superficie del paso de servidumbre

            //Este demerito aplica para predios rusticos
            $table->decimal('demerito_porcentaje',5,2)->nullable();

            //Valores calculados

            //Demeritos terreno
            $table->decimal('demeritos_terreno',18,2)->nullable();

            //Demeritos construccion
            $table->decimal('demeritos_construccion',18,2)->nullable();

            //Incrementos terreno
            $table->decimal('incrementos_terreno',18,2)->nullable();
            //Incrementos construccion
            $table->decimal('incrementos_construccin',18,2)->nullable();

            //Incrementos rusticos
            //Incrementos por su ubicacion respecto a vias de comunicacion
            $table->integer('incremento_viascomunicacion_id')->nullable();
            //Incrementos por su ubicacion respecto a cabecera minicipal
            $table->integer('incremento_cabeceramunicipal_id')->nullable();
            //Incrementos por su ubicacion respecto a centros de poblacion
            $table->integer('incremento_centrospoblacion_id')->nullable();

            //Ajuste terreno (incrementos - demeritos) terreno
            $table->decimal('ajustado_terreno',18,2)->nullable();
            //Ajuste terreno (incrementos - demeritos) construccion
            $table->decimal('ajustado_construccion',18,2)->nullable();

            //Observaciones finales y datos pago
            //Obsercaciones
            $table->text('observaciones')->nullable();
            //Recibo
            $table->string('recibo')->nullable();
            //Fecha de pago
            $table->date('fecha_pago')->nullable();

            //Numero de construcciones.
            $table->integer('num_construcciones')->nullable();

            //BAndera que indica si esta o no finalizado el calculo del valor catastral.
            $table->boolean('finalizado')->default(false);

            //Usuario que crea el valor
            $table->integer('user_id')->nullable();

            $table->timestamps();
		});


        //Declaramos las llaves diferidas
        $sqls[]="ALTER TABLE datos_valuacion_terrenos ADD CONSTRAINT fk_datos_valuacion_terrenos_tramite_id
                FOREIGN KEY (tramite_id ) REFERENCES tramites(id) DEFERRABLE";

        $sqls[]="ALTER TABLE datos_valuacion_terrenos ADD CONSTRAINT fk_datos_valuacion_terrenos_user_id
                FOREIGN KEY (user_id ) REFERENCES users(id) DEFERRABLE";

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
		Schema::drop('datos_valuacion_terrenos');
	}

}
