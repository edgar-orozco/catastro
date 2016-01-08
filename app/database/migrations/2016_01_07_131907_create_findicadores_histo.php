<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFindicadoresHisto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('findicadores_histo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('fiscalhisto_id')->nullable();
			$table->integer('indicadores_id')->nullable();
			$table->timestamps();
		});
		//referencia a fiscal_histo
		$sqls[]="ALTER TABLE findicadores_histo ADD CONSTRAINT fk_fiscal_histo_id
                FOREIGN KEY (fiscalhisto_id) REFERENCES fiscal_histo(id) DEFERRABLE";
        //referencia a ftipos_indicadores
        $sqls[]="ALTER TABLE findicadores_histo ADD CONSTRAINT fk_ftipos_indicadores_id
        		FOREIGN KEY (indicadores_id) REFERENCES ftipos_indicadores(id) DEFERRABLE";
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
		Schema::drop('findicadores_histo');
	}

}
