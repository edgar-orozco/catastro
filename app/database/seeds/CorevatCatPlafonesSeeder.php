<?php

class CorevatCatPlafonesSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_plafones')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_plafones_idplafon_seq RESTART;");
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'MEZCLA COMUN ACABADO A CEPILLO'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'MEZCLA COMUN ACABADO A CEPILLOY TIROL RUSTICO'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'MEZCLA COMUN ACABADO A CEPILLO Y TIROL PLANCHADO'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'MEZCLA COMUN Y ACABADO EMPASTADO LISO'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'DE MEZCLA COMUN, ACABADO CON PASTA TEXTURIZADA TIPO "COREV"'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'A BASE DE TABLAROCA, SUSPENDIDO CON CANALES GALVANIZADOS.'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'MEZCLA DE CEMENTO, CAL Y ARENA, TERMINADO EN REPELLO SIMPLE'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'MEZCLA DE CEMENTO, CAL Y ARENA, TERMINADO PULIDO'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'MEZCLA DE CEMENTO, CAL Y ARENA TERMINADO EN PASTA RAYADA.'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'MEZCLA DE CEMENTO, CAL Y ARENA TERMINADO EN PASTA PICADA.'));
		
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'MEZCLA DE CEMENTO, CAL Y ARENA TERMINADO EN PASTA LANZADA.'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'MEZCLA DE CEMENTO, CAL Y ARENA, TERMINADO EN YESO LISO CON MOLDURAS DE YESO.'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'LAMINADOS PLÁSTICOS CON SOPORTERÍA DE ALUMINIO Y METÁLICA.'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'FALSO PLAFÓN TIPO ESTIROLIT, APOYADO EN ESTRUCTURA DE ALUMINIO.'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'FALSO PLAFÓN DE UNICEL TERMINADO EN YESO.'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'LOSA TERMINADA APARENTE.'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'LOSA APARENTE'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'LAMINA GALVANIZADA TIPO ZINTRO ALUM'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'LAMINA DE FRIBROCEMENTO'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'INEXISTENTES'));
		
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'SIN PLAFON SOLIDO'));
		DB::connection('corevat')->table('cat_plafones')->insert(array('plafon' => 'NO APLICA'));
		
	}

}
