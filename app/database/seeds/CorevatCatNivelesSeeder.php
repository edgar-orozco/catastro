<?php

class CorevatCatNivelesSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_niveles')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_niveles_idnivel_seq RESTART;");
		DB::connection('corevat')->table('cat_niveles')->insert(array('nivel' => 'Nivel 1'));
		DB::connection('corevat')->table('cat_niveles')->insert(array('nivel' => 'Nivel 2'));
		DB::connection('corevat')->table('cat_niveles')->insert(array('nivel' => 'Nivel 3'));
		DB::connection('corevat')->table('cat_niveles')->insert(array('nivel' => 'Nivel 4'));
		DB::connection('corevat')->table('cat_niveles')->insert(array('nivel' => 'Nivel 5'));
	}

}
