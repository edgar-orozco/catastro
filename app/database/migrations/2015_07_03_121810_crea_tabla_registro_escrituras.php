<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaTablaRegistroEscrituras extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registro_escrituras', function(Blueprint $table)
		{
			 $table->increments('id');
       $table->string('tesoreria')->nullable();
       $table->string('cuenta')->nullable();
       $table->string('clave')->nullable();
       $table->string('municipio_id',1)->nullable();
       $table->string('tipo_predio',1)->nullable();
       $table->integer('notaria_id')->nullable();
       $table->string('escritura_num')->nullable();
       $table->string('volumen')->nullable();
       $table->string('naturaleza_acto')->nullable();
       $table->DATE('fecha_instrumento')->nullable();
       $table->DATE('fecha_firma')->nullable();
       $table->string('antecedente_num')->nullable();
       $table->string('antecedente_folio')->nullable();
       $table->string('clave_antecedente')->nullable();
       $table->string('predio_antecedente')->nullable();
       $table->string('lvm_antecedente')->nullable();
       $table->decimal('valor_catastral',10,2)->nullable();
       $table->decimal('importe_operacion',10,2)->nullable();
       $table->text('avaluo_por')->nullable();
       $table->string('folio')->nullable();
       $table->integer('usuario_id')->nullable();
       $table->string('seguimiento')->nullable();
       $table->integer('dir_enajenante_id');
       $table->integer('enajenante_id')->nullable();
       $table->foreign('enajenante_id')->references('id_p')->on('personas')->decmalnullable();
       $table->integer('adquiriente_id')->nullable();
       $table->foreign('adquiriente_id')->references('id_p')->on('personas')->nullable();
       $table->foreign( 'notaria_id' )->references( 'id_notaria' )->on( 'notarias' )->nullable();
       $table->foreign( 'municipio_id' )->references( 'municipio' )->on( 'municipios' )->nullable();
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
		Schema::drop('registro_escrituas');
	}

}
