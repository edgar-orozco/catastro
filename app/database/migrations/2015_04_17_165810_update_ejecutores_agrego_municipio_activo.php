<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEjecutoresAgregoMunicipioActivo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	DB::statement('ALTER TABLE ejecutores ADD municipio VARCHAR(3)');
        DB::statement('ALTER TABLE ejecutores ADD activo bit(1)');
        
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ejecutores', function(Blueprint $table)
		{
			$table->dropColumn('municipios');
                        $table->dropColumn('activo');
                        
		});
	}

}
