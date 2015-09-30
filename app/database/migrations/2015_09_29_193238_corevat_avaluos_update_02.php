<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluosUpdate02 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 74 where idavaluo = 130;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 378 where idavaluo = 131;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 479 where idavaluo = 132;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 986 where idavaluo = 133;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 852 where idavaluo = 134;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 456 where idavaluo = 135;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 633 where idavaluo = 136;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 896 where idavaluo = 137;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 745 where idavaluo = 138;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 215 where idavaluo = 139;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 963 where idavaluo = 140;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 795 where idavaluo = 141;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 215 where idavaluo = 142;");

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1559 where idavaluo = 143;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1587 where idavaluo = 144;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1789 where idavaluo = 145;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1963 where idavaluo = 146;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1235 where idavaluo = 147;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1865 where idavaluo = 148;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2000 where idavaluo = 149;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1896 where idavaluo = 150;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1475 where idavaluo = 151;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1125 where idavaluo = 152;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1669 where idavaluo = 153;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1338 where idavaluo = 154;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1578 where idavaluo = 155;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 1203 where idavaluo = 156;");

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2589 where idavaluo = 157;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2693 where idavaluo = 158;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2415 where idavaluo = 159;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2789 where idavaluo = 160;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2015 where idavaluo = 161;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2856 where idavaluo = 162;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2478 where idavaluo = 163;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2987 where idavaluo = 164;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2663 where idavaluo = 165;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2779 where idavaluo = 166;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2479 where idavaluo = 167;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2456 where idavaluo = 168;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2896 where idavaluo = 169;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2369 where idavaluo = 170;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 2478 where idavaluo = 171;");

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3596 where idavaluo = 172;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3458 where idavaluo = 173;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3145 where idavaluo = 174;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3458 where idavaluo = 175;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3201 where idavaluo = 176;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3215 where idavaluo = 177;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3698 where idavaluo = 178;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3478 where idavaluo = 179;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3658 where idavaluo = 180;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3789 where idavaluo = 181;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3968 where idavaluo = 182;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3854 where idavaluo = 183;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3856 where idavaluo = 184;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3148 where idavaluo = 185;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 3147 where idavaluo = 186;");

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4789 where idavaluo = 187;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4591 where idavaluo = 188;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4236 where idavaluo = 189;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4999 where idavaluo = 190;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4103 where idavaluo = 191;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4657 where idavaluo = 192;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4756 where idavaluo = 193;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4207 where idavaluo = 194;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4852 where idavaluo = 195;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4753 where idavaluo = 196;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4556 where idavaluo = 197;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4443 where idavaluo = 198;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4321 where idavaluo = 199;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluo_conclusiones SET valor_concluido = 4719 where idavaluo = 200;");


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
