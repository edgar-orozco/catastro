<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiscalHisto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fiscal_histo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('memo_id')->nullable();
			$table->string('clave')->nullable();
            $table->string('cuenta')->nullable();
            $table->decimal('superficie_terreno')->nullable();
			$table->decimal('superficie_construccion')->nullable();
			$table->integer('tipos_predio')->nullable();
			$table->decimal('distancia_cabecera')->nullable();
			$table->integer('uso_suelo')->nullable();
			$table->integer('uso_construccion')->nullable();
			$table->integer('id_propietarios')->nullable();
			$table->integer('id_ubicacion_fiscal')->nullable();
			$table->decimal('valor_catastral')->nullable();
			$table->decimal('impuesto')->nullable();
			$table->string('cve_estatus_predio',1)->nullable();;
			$table->decimal('valor_terreno')->nullable();
			$table->decimal('valor_construccion')->nullable();
			$table->date('fecha_revaluacion')->nullable();
			$table->decimal('valor_unitario_construccion')->nullable();
			$table->integer('niveles')->nullable();
			$table->integer('cve_tipo_construccion')->nullable();
			$table->integer('cve_edo_conservacion')->nullable();
			$table->integer('cve_clase_construccion')->nullable();
			$table->timestamps();
		});
		//referencia a memos
		$sqls[]="ALTER TABLE fiscal_histo ADD CONSTRAINT fk_fiscal_histo_memo_id
                FOREIGN KEY (memo_id) REFERENCES fmemos(id) DEFERRABLE";

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
		Schema::drop('fiscal_histo');
	}

}
