<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManifestacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::create('manifestaciones',
          function (Blueprint $table) {
              $table->increments('id');

              //IDentificacion del tramite -------------------------------
              $table->integer('tramite_id')->nullable();
              $table->string('clave');
              $table->string('cuenta');
              $table->integer('estatus')->default(0);
              $table->string('clave_seguimiento', 6)->nullable();

              //Identificacion documento ----------------------------------
              $table->string('municipio', 3)->nullable();
              $table->string('fecha')->nullable();
              $table->string('movimiento')->nullable();

              //Cuenta predial ultimos 6 digitos
              $table->string('cuenta_predio', 6)->nullable();

              //Clave catastral atomizada
              $table->string('clave_zona', 3)->nullable();
              $table->string('clave_manzana', 4)->nullable();
              $table->string('clave_predio', 6)->nullable();

              //Cuenta afectada esta compuesta de 6digitos del predio y 1 del tipo de predio (U o R)
              $table->string('cuenta_afectada', 6)->nullable();

              //Memorandum num:
              $table->string('memo_num')->nullable();

              //Tipo de predio:
              $table->string('tipo_predio', 1)->nullable();

              //Datos de involucrados -----------------------------------------

              //Tipo de propietario [PARTICULAR, MUNICIPAL, ESTATAL, FEDERAL]
              $table->string('tipo_propietario', 60)->nullable();

              //FK de la Direccion del predio si es rustico
              $table->integer('direccion_rustico_id')->nullable();
              //FK de la direccion del predio si es urbano
              $table->integer('direccion_urbano_id')->nullable();

              //FK del adquiriente
              $table->integer('adquiriente_id')->nullable();
              //FK del domicilio del adquiriente
              $table->integer('domicilio_adquiriente_id')->nullable();

              //FK del enajenante
              $table->integer('enajenante_id')->nullable();
              //FK del domicilio del enajenante
              $table->integer('domicilio_enajenante_id')->nullable();

              //Datos predio -------------------------------------------

              //Superficie del terreno
              $table->decimal('sup_terreno', 18, 2)->nullable();
              $table->decimal('sup_construccion', 18, 2)->nullable();

              //Las vías de comunicación
              $table->integer('vias_comunicacion_id')->nullable();

              //Población próxima si es predio rustico
              $table->string('poblacion_proxima')->nullable();

              //Distancia a poblración próxima en kilometros
              $table->decimal('distancia_poblacion')->nullable();

              //Tenencia de la tierra
              $table->integer('tenencia_tierra_id')->nullable();

              //Uso del predio
              $table->integer('uso_predio_id')->nullable();

              //Características del suelo
              $table->decimal('suelo_inundable', 5, 2)->nullable();
              $table->decimal('suelo_popal', 5, 2)->nullable();
              $table->decimal('suelo_cultivable', 5, 2)->nullable();
              $table->decimal('suelo_desnivel', 5, 2)->nullable();
              $table->decimal('suelo_incultivable', 5, 2)->nullable();
              $table->decimal('suelo_otros', 5, 2)->nullable();
              $table->string('suelo_otros_texto')->nullable();

              //Datos de la construccion -------------------------------------

              //Superficie de la construcción de albercas
              $table->decimal('sup_cons_albercas', 18, 2)->nullable();

              //Total bloques de construccion
              $table->integer('bloques_construccion')->nullable();
              //Total superficie de construccion
              $table->decimal('total_sup_construccion', 18, 2)->nullable();

              //Datos reg publico ----------------------------------------------

              //Tipo de escritura
              $table->integer('tipo_escritura_id')->nullable();

              //Notario escritura
              $table->integer('notaria_id')->nullable();
              $table->integer('notario_id')->nullable();

              //Número de título
              $table->string('num_titulo')->nullable();

              //Número de registro
              $table->string('num_registro')->nullable();

              //Número de predio
              $table->string('num_predio')->nullable();

              //fecha título
              $table->date('fecha_titulo')->nullable();
              //fecha escritura
              $table->date('fecha_escritura')->nullable();

              //Número de folio
              $table->string('num_folio')->nullable();
              //Número de folio
              $table->string('volumen')->nullable();
              //Número de folio
              $table->string('folio_real')->nullable();
              //Municipio
              $table->string('reg_municipio')->nullable();

              //Datos fiscales ---------------------------------
              //Estatus fiscal (vigente o exento)
              $table->string('estatus_fiscal')->nullable();

              //Incrementos y demeritos
              //Incremento en terreno
              $table->decimal('inc_terreno', 5, 2)->nullable();
              //demerito en terreno
              $table->decimal('dem_terreno', 5, 2)->nullable();
              //Demerito en construccion
              $table->decimal('dem_construccion', 5, 2)->nullable();

              //Semestre de valuación
              $table->integer('semestre_valuacion')->nullable();
              //Semestr de alta
              $table->integer('semestre_alta')->nullable();

              //Valor del terreno
              $table->decimal('valor_terreno', 18, 2);
              //Valor de la construccion
              $table->decimal('valor_construccion', 18, 2);

              //? no se que es c. cat. total
              $table->decimal('cat_total', 18, 2)->nullable();

              //Información adicional
              $table->text('informacion_adicional')->nullable();

              //Nombre del manifestante que firma y manifiesta
              $table->text('nombre_manifestante')->nullable();

              $table->timestamps();
          });

        //Declaramos las llaves foraneas diferidas
        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_tramite_id FOREIGN KEY (tramite_id) REFERENCES tramites(id) DEFERRABLE';
        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_direccion_urbano_id FOREIGN KEY (direccion_urbano_id) REFERENCES domicilios_urbanos(id_du) DEFERRABLE';
        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_direccion_rustico_id FOREIGN KEY (direccion_rustico_id) REFERENCES domicilios_rusticos(id_dr) DEFERRABLE';

        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_adquiriente_id FOREIGN KEY (adquiriente_id) REFERENCES personas(id_p) DEFERRABLE';
        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_enajenante_id FOREIGN KEY (enajenante_id) REFERENCES personas(id_p) DEFERRABLE';

        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_domicilio_enajenante_id FOREIGN KEY (domicilio_enajenante_id) REFERENCES domicilios(id) DEFERRABLE';
        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_domicilio_adquiriente_id FOREIGN KEY (domicilio_adquiriente_id) REFERENCES domicilios(id) DEFERRABLE';

        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_notaria_id FOREIGN KEY (notaria_id) REFERENCES notarias(id_notaria) DEFERRABLE';
        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_notario_id FOREIGN KEY (notario_id) REFERENCES personas(id_p) DEFERRABLE';

        /*
        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_vias_comunicacion_id FOREIGN KEY (vias_comunicacion_id) REFERENCES vias_comunicacion(id) DEFERRABLE';
        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_tenencia_tierra_id FOREIGN KEY (tenencia_tierra_id) REFERENCES tenencias_tierra(id) DEFERRABLE';
        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_uso_predio_id FOREIGN KEY (uso_predio_id) REFERENCES usopredio(id) DEFERRABLE';
        $sqls[]='ALTER TABLE manifestaciones ADD CONSTRAINT fk_manifestaciones_tipo_escritura_id FOREIGN KEY (tipo_escritura_id) REFERENCES tipoescritura(id) DEFERRABLE';
        */

        Schema::create('manifestaciones_servicios', function (Blueprint $table) {
            $table->increments('id');
            //FK que apunta a la manifestacion
            $table->integer('manifestacion_id');
            //FK que apunta al catalogo de servicios_publicos
            $table->integer('servicio_id');
            $table->timestamps();
        });

        Schema::create('manifestaciones_colindancias', function (Blueprint $table) {
            $table->increments('id');

            //FK que apunta a la manifestacion
            $table->integer('manifestacion_id');
            $table->string('orientacion')->nullable();
            $table->string('superficie')->nullable();
            $table->string('colindancia')->nullable();

            $table->timestamps();
        });

        $sqls[]='ALTER TABLE manifestaciones_colindancias ADD CONSTRAINT fk_manifestaciones_colindancias_manifestacion_id FOREIGN KEY (manifestacion_id) REFERENCES manifestaciones(id) DEFERRABLE';

        Schema::create('manifestaciones_construcciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manifestacion_id');

            $table->integer('num_bloque')->nullable();
            $table->decimal('sup_construccion', 18,2)->nullable();
            $table->string('tipo_construccion')->nullable();
            $table->string('techos')->nullable();
            $table->string('muros')->nullable();
            $table->string('pisos')->nullable();
            $table->string('puertas')->nullable();
            $table->string('ventanas')->nullable();
            $table->string('hidraulicas')->nullable();
            $table->string('electricas')->nullable();
            $table->string('sanitarias')->nullable();
            $table->string('inst_especiales')->nullable();
            $table->integer('antiguedad')->nullable();
            $table->string('edo_construccion')->nullable();
            $table->decimal('avance',5,2)->nullable();
            $table->string('uso_construccion')->nullable();
            $table->integer('num_niveles')->nullable();

            $table->timestamps();
        });

        $sqls[]='ALTER TABLE manifestaciones_construcciones ADD CONSTRAINT fk_manifestaciones_construcciones_manifestacion_id FOREIGN KEY (manifestacion_id) REFERENCES manifestaciones(id) DEFERRABLE';

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
		Schema::dropIfExists('manifestaciones');
		Schema::dropIfExists('manifestaciones_colindancias');
		Schema::dropIfExists('manifestaciones_servicios');
		Schema::dropIfExists('manifestaciones_construcciones');
	}

}
