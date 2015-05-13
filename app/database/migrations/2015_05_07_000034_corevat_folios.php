<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatFolios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('corevat')->create('folios', function(Blueprint $table) {
			$table->increments('idfolio');
			$table->integer('iduser');
			$table->timestamp('fecha');
			$table->decimal('importefolio', 10, 2)->default(0.00);
			
			$table->integer('idemp')->default(1);
			$table->string('ip', 50)->default('');
			$table->string('host', 100)->default('');
			$table->integer('creado_por')->default(0);
			$table->timestamp('creado_el')->default('1970-01-01 00:00:00');
			$table->integer('modi_por')->default(0);
			$table->timestamp('modi_el')->default('1970-01-01 00:00:00');
			
			$table->foreign('idemp')->references('idemp')->on('empresas')->onUpdate('cascade');
			$table->foreign('iduser')->references('iduser')->on('usuarios')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::connection('corevat')->getPdo()->exec("DROP TABLE IF EXISTS folios CASCADE;");
	}

}
