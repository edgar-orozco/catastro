<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFmemosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Se eliminan tablas anteriores
		Schema::dropIfExists('tramite_memo_cuenta');
        Schema::dropIfExists('fobservaciones');

		Schema::table('fmemos', function(Blueprint $table)
		{
			$table->integer('tramite_id');
			$table->integer('fconcepto_memo_id');
			$table->text('observaciones_memo')->nullable();
			
			$table->foreign('tramite_id')->references('id')->on('tramites');
			$table->foreign('fconcepto_memo_id')->references('id')->on('fconceptos_memo');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Se elminan las columnas

		$table->dropColumn('tramite_id');
		$table->dropColumn('concepto_memo_id');
		$table->dropColumn('observaciones_memo');
		$table->dropForeign('tramite_id_foreign');
		$table->dropForeign('fconcepto_memo_id_foreign');

	}

}
