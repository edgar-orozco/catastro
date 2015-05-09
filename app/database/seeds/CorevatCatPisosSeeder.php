<?php

class CorevatCatPisosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_pisos')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_pisos_idpiso_seq RESTART;");
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 1,  'piso' => 'CEMENTO PULIDO'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 2,  'piso' => 'CEMENTO PULIDO CON CLORANTE'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 3,  'piso' => 'DE TERRAZO VACIADO EN OBRA CON JUNTA DE VIDRIO'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 4,  'piso' => 'LOSETA DE MARMOL DE 10X30 CMS'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 5,  'piso' => 'LOSETA DE MARMOL DE 30X30 CMS'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 7,  'piso' => 'LOSETA DE MARMOL DE 40X60 CMS'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 8,  'piso' => 'LOSETA VINILICA DE 20X20 CMS'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 9,  'piso' => 'LOSETA VINILICA DE 30X30 CMS'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 10, 'piso' => 'CONGOLEUM IMPORTADO ANTIDERRAPANTE'));

		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 11, 'piso' => 'MOSAICO DE GRANITO DE 20X20 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 12, 'piso' => 'MOSAICO DE GRANITO DE 30X30 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 13, 'piso' => 'MOSAICO DE GRANITO DE 33X33 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 14, 'piso' => 'MOSAICO DE GRANITO DE 40X40 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 15, 'piso' => 'MOSAICO DE PASTA DE 20X20 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 16, 'piso' => 'MOSAICO DE PASTA DE 25X25 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 17, 'piso' => 'MOSAICO DE PASTA DE 30X30 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 18, 'piso' => 'MOSAICO DE PASTA DE 33X33 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 19, 'piso' => 'MOSAICO DE PASTA DE 40X40 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 20, 'piso' => 'LOSETA CERÁMICA DE 15X15 CMS.'));

		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 21, 'piso' => 'LOSETA CERÁMICA DE 25X25 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 22, 'piso' => 'LOSETA CERÁMICA DE 20X30 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 23, 'piso' => 'LOSETA CERÁMICA DE 30X30 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 24, 'piso' => 'LOSETA DE CERÁMICA 33X33CM'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 25, 'piso' => 'LOSETA CERÁMICA DE 40X40 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 26, 'piso' => 'LOSETA DE CERÁMICA 44X44CM'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 27, 'piso' => 'LOSETA DE CERÁMICA 50X50CM'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 28, 'piso' => 'LOSETA CERÁMICA ANTIDERRAPANTE DE 20X20 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 29, 'piso' => 'LOSETA CERÁMICA ANTIDERRAPANTE DE 25X25 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 30, 'piso' => 'LOSETA CERÁMICA ANTIDERRAPANTE DE 20X30 CMS.'));
		
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 31, 'piso' => 'LOSETA CERÁMICA ANTIDERRAPANTE DE 30X30 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 32, 'piso' => 'LOSETA CERÁMICA ANTIDERRAPANTE DE 40X40 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 33, 'piso' => 'LOSETA CERÁMICA ANTIDERRAPANTE DE 50X50 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 34, 'piso' => 'LOSETA DE BARRO DE 20X20 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 35, 'piso' => 'LOSETA DE BARRO DE 20X25 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 36, 'piso' => 'LOSETA DE BARRO DE 20X30 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 37, 'piso' => 'MOSAICO DE MÁRMOL TERRAZO DE 20X20 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 38, 'piso' => 'MOSAICO DE MÁRMOL TERRAZO DE 20X30 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 39, 'piso' => 'MOSAICO DE MÁRMOL TERRAZO DE 30X30 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 40, 'piso' => 'MOSAICO DE MÁRMOL TERRAZO DE 40X40 CMS.'));
		
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 41, 'piso' => 'MOSAICO DE MÁRMOL TERRAZO DE 50X50CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 42, 'piso' => 'MOSAICO DE MÁRMOL TRAVERTINO DE 20X20 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 43, 'piso' => 'MOSAICO DE MÁRMOL TRAVERTINO DE 20X30 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 44, 'piso' => 'MOSAICO DE MÁRMOL TRAVERTINO DE 30X30 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 45, 'piso' => 'MOSAICO DE MÁRMOL TRAVERTINO DE 40X40 CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 46, 'piso' => 'MOSAICO DE MÁRMOL TRAVERTINO DE 50X50CMS.'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 47, 'piso' => 'MOSAICO  11 X 11'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 48, 'piso' => 'MOSAICO  11 X 15'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 49, 'piso' => 'CONCRETO ARMADO'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 50, 'piso' => 'CONCRETO HIDRÁULICO'));
		
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 51, 'piso' => 'ADOCRETO'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 52, 'piso' => 'TERRENO NATURAL'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 53, 'piso' => 'NO APLICA'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 54, 'piso' => 'INEXISTENTE'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 55, 'piso' => 'LOSETA CERAMICA A 1/2 ALTURA'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 56, 'piso' => 'LOSETA CERAMICA A 1/2 ALTURA CON CENEFAS'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 57, 'piso' => 'LOSETA CERAMICA DE PISO A TECHO'));
		DB::connection('corevat')->table('cat_pisos')->insert(array('idpiso' => 58, 'piso' => 'LOSETA CERAMICA DE PSIO A TECHO CON CENEFAS EN COCINA ACABADOS'));
		
	}

}
