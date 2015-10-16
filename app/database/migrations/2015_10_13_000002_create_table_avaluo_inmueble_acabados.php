<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAvaluoInmuebleAcabados extends Migration {

	/**
	 * Run the migrations.
	 * 
	 * @return void
	 */
	public function up() {
		Schema::connection('corevat')->create('ai_acabados', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('idavaluoinmueble');
			$table->integer('fk_cat_acabados');
			$table->integer('fk_cat_pisos');
			$table->integer('fk_cat_aplanados');
			$table->integer('fk_cat_plafones');
			$table->timestamp('created_at')->default('1970-01-01 00:00:00');
			$table->timestamp('updated_at')->default('1970-01-01 00:00:00');

			$table->foreign('idavaluoinmueble')->references('idavaluoinmueble')->on('avaluo_inmueble')->onUpdate('cascade');
			$table->foreign('fk_cat_acabados')->references('id')->on('cat_acabados')->onUpdate('cascade');
			$table->foreign('fk_cat_pisos')->references('idpiso')->on('cat_pisos')->onUpdate('cascade');
			$table->foreign('fk_cat_aplanados')->references('idaplanado')->on('cat_aplanados')->onUpdate('cascade');
			$table->foreign('fk_cat_plafones')->references('idplafon')->on('cat_plafones')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS ai_acabados CASCADE;");
	}

}
