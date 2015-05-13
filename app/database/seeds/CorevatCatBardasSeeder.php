<?php


class CorevatCatBardasSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_bardas')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_bardas_idbarda_seq RESTART;");
		DB::connection('corevat')->table('cat_bardas')->insert(array('barda' => 'TABIQUE ROJO DE 14 CMS, APARENTE'));
		DB::connection('corevat')->table('cat_bardas')->insert(array('barda' => 'TABIQUE ROJO RECOCIDO DE 14 CMS. APLANADA'));
		DB::connection('corevat')->table('cat_bardas')->insert(array('barda' => 'BLOCK DE CEMENTO ARENA DE 12X20X40 CMS, APARENTE'));
		DB::connection('corevat')->table('cat_bardas')->insert(array('barda' => 'BLOCK DE CEMENTO ARENA DE 12X20X40 CMS, APLANADA'));
		DB::connection('corevat')->table('cat_bardas')->insert(array('barda' => 'MURETE DE BLOCK DE CEMENTO ARENA Y MALLA CICLON CON CASTILLOS'));
		DB::connection('corevat')->table('cat_bardas')->insert(array('barda' => 'DE REFUERZO DE CONCRETO ARMADO'));
		DB::connection('corevat')->table('cat_bardas')->insert(array('barda' => 'URETE DE TABIQUE DE BARRO COMPRIMIDO'));
		DB::connection('corevat')->table('cat_bardas')->insert(array('barda' => 'INEXISTENTES'));
		DB::connection('corevat')->table('cat_bardas')->insert(array('barda' => 'NO APLICA'));
	}
	
}
