<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFserviciosPredioHisto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fservicios_predio_histo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('fiscalhisto_id')->nullable();
			$table->integer('servicios_id')->nullable();
			$table->timestamps();
		});
		//referencia a fiscal_histo
		$sqls[]="ALTER TABLE fservicios_predio_histo ADD CONSTRAINT fk_fiscal_histo_id
                FOREIGN KEY (fiscalhisto_id) REFERENCES fiscal_histo(id) DEFERRABLE";
        //referencia a ftipos_servicios
        $sqls[]="ALTER TABLE fservicios_predio_histo ADD CONSTRAINT fk_ftipos_servicios_id
        		FOREIGN KEY (servicios_id) REFERENCES ftipos_servicios(id) DEFERRABLE";
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
		Schema::drop('fservicios_predio_histo');
	}

}
