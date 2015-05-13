<?php

class CorevatCatProximidadUrbanaSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_proximidad_urbana')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_proximidad_urbana_idproximidadurbana_seq RESTART;");
		DB::connection('corevat')->table('cat_proximidad_urbana')->insert(array('proximidad_urbana' => 'Centrico'));
		DB::connection('corevat')->table('cat_proximidad_urbana')->insert(array('proximidad_urbana' => 'Intermedio'));
		DB::connection('corevat')->table('cat_proximidad_urbana')->insert(array('proximidad_urbana' => 'Periferica'));
		DB::connection('corevat')->table('cat_proximidad_urbana')->insert(array('proximidad_urbana' => 'DE EXPANSION'));
		DB::connection('corevat')->table('cat_proximidad_urbana')->insert(array('proximidad_urbana' => 'Rural'));
	}

}
