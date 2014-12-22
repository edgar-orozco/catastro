<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCertificadasToRequisitoTipotramiteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('requisito_tipotramite', function(Blueprint $table)
		{
			$table->boolean('certificadas')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('requisito_tipotramite', function(Blueprint $table)
		{
			$table->dropColumn('certificadas');
		});
	}

}
