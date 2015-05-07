<?php


class CorevatCatAplanadosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_aplanados')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_aplanados_idaplanado_seq RESTART;");
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'MEZCLA COMUN ACABADO A CEPILLO'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'MEZCLA COMUN ACABADO A CEPILLO Y TIROL RUSTICO'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'MEZCLA COMUN ACABADO A CEPILLO Y TIROL PLANCHADO'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'MEZCLA COMUN Y ACABADO EN EMPASTADO LISO'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'DE MEZCLA COMUN, ACABADO CON PASTA TEXTURIZADA TIPO "COREV"'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'DE MEZCLA COMUN, ACABADO CON PASTA TEXTURIZADA HECHA EN SITIO.'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'APLANADO DE CONCRETO APARENTE RUGOSO Y SELLO'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'BLOCK APARENTE'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'TABIQUE DE BARRO COMPRIMIDO APARENTE A DOS CARAS'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'INEXISTENTES'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'LOSETA CERAMICA A 1/4 DE ALTURA A PARTIR DE LA MESETA'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'LOSETA CERAMICA A 1/4 DE ALTURA A PARTIR DE LA MESETA  CON CENEFAS O RETABLOS'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'LOSETA CERAMICA DE PISO A TECHO'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'LOSETA CERAMICA DE PISO A TECHO CON CENEFAS O RETABLOS'));
		DB::connection('corevat')->table('cat_aplanados')->insert(array('aplanado' => 'No Aplica'));
	}
	
}
