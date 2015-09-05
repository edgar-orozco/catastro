<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTramitesValoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        //Tabla de tramites de valores catastrales
        Schema::create('tramites_valores', function(Blueprint $table)
		{
			$table->increments('id');
            //IDentificacion del tramite
            $table->integer('tramite_id');
            $table->string('clave');
            $table->string('cuenta');
            $table->integer('estatus')->default(0);

            //Datos valuacion terreno
            $table->decimal('sup_terreno',18,2);
            $table->decimal('valor_calle',18,2);
            $table->integer('usosuelo_id')->nullable();

            //incremento
            $table->integer('inc_esquina_id')->nullable();

            //Demeritos
            //Demerito por escaso frente
            $table->decimal('dem_escaso_frente',10,2)->nullable();

            //Demerito por profundidad
            $table->decimal('dem_prof_frente',10,2)->nullable();  //frente
            $table->decimal('dem_prof_prof',10,2)->nullable();    //Profundidad

            //Demerito por irregularidad
            $table->decimal('dem_irregular',10,2)->nullable();

            //Demerito por excavaciones
            $table->decimal('dem_sup_excavada',10,2)->nullable(); //superficie excavada
            $table->decimal('dem_prof_excavada',10,2)->nullable(); //profundidad excavada

            //Demerito por desnivel
            $table->decimal('dem_desnivel_area',18,2)->nullable();
            $table->decimal('dem_desnivel_pct',5,2)->nullable();

            //Porcentage de demerito en rusticos
            $table->decimal('dem_pct', 5,2)->nullable();

            //Predio interior
            $table->decimal('sup_paso_servidumbre',18,2)->nullable(); //superficie del paso de servidumbre

            //Valores calculados
            //Valor terreno
            $table->decimal('valor_terreno',18,2)->nullable();
            //Valor construccion
            $table->decimal('valor_construccion',18,2)->nullable();

            //Demeritos terreno
            $table->decimal('dem_terreno',18,2)->nullable();
            //Demeritos construccion
            $table->decimal('dem_construccion',18,2)->nullable();

            //Incrementos terreno
            $table->decimal('inc_terreno',18,2)->nullable();
            //Incrementos construccion
            $table->decimal('inc_construccin',18,2)->nullable();

            //Incrementos rusticos
            //Incrementos por su ubicacion respecto a vias de comunicacion
            $table->integer('inc_viascomunicacion_id')->nullable();
            //Incrementos por su ubicacion respecto a cabecera minicipal
            $table->integer('inc_cabeceramunicipal_id')->nullable();
            //Incrementos por su ubicacion respecto a centros de poblacion
            $table->integer('inc_centrospoblacion_id')->nullable();

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

            //TODO: faltan los campos para los terrenos rusticos.

		});



        //Se crean las tablas de cuerpos de construcción
        Schema::create('tramites_construcciones_valores', function(Blueprint $table)
        {
            $table->increments('id');

            //Identificacion del registro de tramites_valores
            $table->integer('tramite_valor_id');

            //IDentificacion del tramite
            $table->integer('tramite_id');
            $table->string('clave');
            $table->string('cuenta');

            //Identificador de cuerpo de construccion
            $table->integer('construccion_num')->default(1);

            //Superficie de construcción de este cuerpo de construccion
            $table->decimal('sup_construccion')->nullable();

            //Niveles de construcción en este cuerpo de construccion
            $table->integer('niveles')->default(0);

            //Estado de conservacion del cuerpo de construccion
            $table->integer('conservacion_id')->nullable();

            //Es alberca este cuerpo de construcción ?
            $table->boolean('es_alberca')->default(false);

            //Tipo de alberca (si es una alberca)
            $table->integer('tipoalberca_id')->nullable();

            //Tipo de construcción ---------------

            //Tipo de construccion
            $table->integer('tipo_id')->nullable();

            //Tipo de piso
            $table->integer('piso_id')->nullable();

            //Tipo de techo
            $table->integer('techo_id')->nullable();

            //Tipo de muros
            $table->integer('muros_id')->nullable();

            //Tipo de puertas y ventanas
            $table->integer('muro_id')->nullable();

            //Tipos de instalaciones especiales -----------

            //Tipo de instalaciones hidraulicas
            $table->integer('hidraulicas_id')->nullable();
            //Tipo de instalaciones sanitarias
            $table->integer('sanitarias_id')->nullable();
            //Tipo de instalaciones electricas
            $table->integer('electricas_id')->nullable();

            //Porcentaje de terminación de este cuerpo de construcción
            $table->decimal('terminacion_pct',5,2)->nullable();

            //Año de terminación del cuerpo de construcción.
            //Aplica si el terminacion_pct = 100
            $table->integer('anio')->nullable();

            $table->timestamps();

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tramites_valores');
		Schema::drop('tramites_construcciones_valores');
	}
}
