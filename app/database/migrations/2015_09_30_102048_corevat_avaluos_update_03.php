<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluosUpdate03 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0012-000006', idmunicipio = 8, cp = '86400' where idavaluo = 201;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0012-000012', idmunicipio = 8, cp = '86400' where idavaluo = 202;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0012-000007', idmunicipio = 8, cp = '86400' where idavaluo = 203;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0012-000008', idmunicipio = 8, cp = '86400' where idavaluo = 204;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0012-000009', idmunicipio = 8, cp = '86400' where idavaluo = 205;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0012-000010', idmunicipio = 8, cp = '86400' where idavaluo = 206;");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
