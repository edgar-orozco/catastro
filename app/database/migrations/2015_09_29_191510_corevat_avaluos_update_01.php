<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorevatAvaluosUpdate01 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000007', idmunicipio = 8, cp = '86400' where idavaluo = 130;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000041', idmunicipio = 8, cp = '86400' where idavaluo = 131;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000054', idmunicipio = 8, cp = '86400' where idavaluo = 132;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000059', idmunicipio = 8, cp = '86400' where idavaluo = 133;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000096', idmunicipio = 8, cp = '86400' where idavaluo = 134;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000019', idmunicipio = 8, cp = '86400' where idavaluo = 135;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000072', idmunicipio = 8, cp = '86400' where idavaluo = 136;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000074', idmunicipio = 8, cp = '86400' where idavaluo = 137;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0013-000016', idmunicipio = 8, cp = '86400' where idavaluo = 138;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0014-000001', idmunicipio = 8, cp = '86400' where idavaluo = 139;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0015-000004', idmunicipio = 8, cp = '86400' where idavaluo = 140;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0016-000006', idmunicipio = 8, cp = '86400' where idavaluo = 141;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0017-000009', idmunicipio = 8, cp = '86400' where idavaluo = 142;");

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000008', idmunicipio = 8, cp = '86400' where idavaluo = 143;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000042', idmunicipio = 8, cp = '86400' where idavaluo = 144;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000058', idmunicipio = 8, cp = '86400' where idavaluo = 145;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000063', idmunicipio = 8, cp = '86400' where idavaluo = 146;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000095', idmunicipio = 8, cp = '86400' where idavaluo = 147;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000020', idmunicipio = 8, cp = '86400' where idavaluo = 148;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000021', idmunicipio = 8, cp = '86400' where idavaluo = 149;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000069', idmunicipio = 8, cp = '86400' where idavaluo = 150;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0013-000009', idmunicipio = 8, cp = '86400' where idavaluo = 151;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0014-000002', idmunicipio = 8, cp = '86400' where idavaluo = 152;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0015-000008', idmunicipio = 8, cp = '86400' where idavaluo = 153;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0016-000014', idmunicipio = 8, cp = '86400' where idavaluo = 154;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0017-000011', idmunicipio = 8, cp = '86400' where idavaluo = 155;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0018-000004', idmunicipio = 8, cp = '86400' where idavaluo = 156;");

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000009', idmunicipio = 8, cp = '86400' where idavaluo = 157;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000043', idmunicipio = 8, cp = '86400' where idavaluo = 158;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000055', idmunicipio = 8, cp = '86400' where idavaluo = 159;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000062', idmunicipio = 8, cp = '86400' where idavaluo = 160;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000094', idmunicipio = 8, cp = '86400' where idavaluo = 161;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000022', idmunicipio = 8, cp = '86400' where idavaluo = 162;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000023', idmunicipio = 8, cp = '86400' where idavaluo = 163;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000070', idmunicipio = 8, cp = '86400' where idavaluo = 164;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000075', idmunicipio = 8, cp = '86400' where idavaluo = 165;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0013-000011', idmunicipio = 8, cp = '86400' where idavaluo = 166;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0014-000003', idmunicipio = 8, cp = '86400' where idavaluo = 167;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0015-000002', idmunicipio = 8, cp = '86400' where idavaluo = 168;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0016-000008', idmunicipio = 8, cp = '86400' where idavaluo = 169;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0017-000007', idmunicipio = 8, cp = '86400' where idavaluo = 170;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0018-000003', idmunicipio = 8, cp = '86400' where idavaluo = 171;");

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000010', idmunicipio = 8, cp = '86400' where idavaluo = 172;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000044', idmunicipio = 8, cp = '86400' where idavaluo = 173;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000057', idmunicipio = 8, cp = '86400' where idavaluo = 174;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000061', idmunicipio = 8, cp = '86400' where idavaluo = 175;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000093', idmunicipio = 8, cp = '86400' where idavaluo = 176;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000024', idmunicipio = 8, cp = '86400' where idavaluo = 177;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000025', idmunicipio = 8, cp = '86400' where idavaluo = 178;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000071', idmunicipio = 8, cp = '86400' where idavaluo = 179;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000076', idmunicipio = 8, cp = '86400' where idavaluo = 180;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0013-000010', idmunicipio = 8, cp = '86400' where idavaluo = 181;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0014-000004', idmunicipio = 8, cp = '86400' where idavaluo = 182;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0015-000006', idmunicipio = 8, cp = '86400' where idavaluo = 183;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0016-000011', idmunicipio = 8, cp = '86400' where idavaluo = 184;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0017-000013', idmunicipio = 8, cp = '86400' where idavaluo = 185;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0018-000002', idmunicipio = 8, cp = '86400' where idavaluo = 186;");

		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000000', idmunicipio = 8, cp = '86400' where idavaluo = 187;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000045', idmunicipio = 8, cp = '86400' where idavaluo = 188;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000056', idmunicipio = 8, cp = '86400' where idavaluo = 189;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000060', idmunicipio = 8, cp = '86400' where idavaluo = 190;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000092', idmunicipio = 8, cp = '86400' where idavaluo = 191;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000026', idmunicipio = 8, cp = '86400' where idavaluo = 192;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000027', idmunicipio = 8, cp = '86400' where idavaluo = 193;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000032', idmunicipio = 8, cp = '86400' where idavaluo = 194;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0009-000073', idmunicipio = 8, cp = '86400' where idavaluo = 195;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0013-000013', idmunicipio = 8, cp = '86400' where idavaluo = 196;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0015-000000', idmunicipio = 8, cp = '86400' where idavaluo = 197;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0016-000017', idmunicipio = 8, cp = '86400' where idavaluo = 198;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0017-000005', idmunicipio = 8, cp = '86400' where idavaluo = 199;");
		DB::connection('corevat')->getPdo()->exec("UPDATE avaluos SET cuenta_catastral ='005-0018-000001', idmunicipio = 8, cp = '86400' where idavaluo = 200;");



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
