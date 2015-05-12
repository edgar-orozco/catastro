<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAemInformacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('aem_informacion', function(Blueprint $table) {
			$table->increments('idaeminformacion');
			$table->integer('idavaluoenfoquemercado');
			$table->string('ubicacion', 200)->default('');
			$table->decimal('edad', 10, 2)->default(0.00);
			$table->string('telefono', 100)->default('');
			$table->string('observaciones', 100)->default('');
			
			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('idavaluoenfoquemercado')->references('idavaluoenfoquemercado')->on('avaluo_enfoque_mercado')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS aem_informacion CASCADE;");
	}

}
