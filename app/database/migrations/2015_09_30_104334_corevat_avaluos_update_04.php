<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluosUpdate04 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0012-000009', idmunicipio = 8, cp = '86400' where idavaluo = 207;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0012-000010', idmunicipio = 8, cp = '86400' where idavaluo = 208;");

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0013-000008', idmunicipio = 8, cp = '86400' where idavaluo = 209;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000004', idmunicipio = 8, cp = '86400' where idavaluo = 210;");

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0014-000001', idmunicipio = 8, cp = '86400' where idavaluo = 211;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0014-000002', idmunicipio = 8, cp = '86400' where idavaluo = 212;");

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 101 where idavaluo = 201;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1101 where idavaluo = 202;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2101 where idavaluo = 203;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3101 where idavaluo = 204;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4101 where idavaluo = 205;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 5101 where idavaluo = 206;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1101 where idavaluo = 207;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2102 where idavaluo = 208;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 5101 where idavaluo = 209;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 745 where idavaluo = 210;");

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 01 where idavaluo = 211;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 5745 where idavaluo = 212;");
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
