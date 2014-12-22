<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequisitoTipotramiteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requisito_tipotramite', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('requisito_id');
			$table->integer('tipotramite_id');
			$table->boolean('original')->nullable();
			$table->integer('copias')->nullable();
            $table->foreign('requisito_id')->references('id')->on('requisitos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipotramite_id')->references('id')->on('tipotramites')
                ->onUpdate('cascade')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('requisito_tipotramite');
	}

}
