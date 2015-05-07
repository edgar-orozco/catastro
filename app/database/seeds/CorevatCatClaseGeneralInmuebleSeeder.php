<?php

class CorevatCatClaseGeneralInmuebleSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_clase_general_inmueble')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_clase_general_inmueble_idclasegeneralinmueble_seq RESTART;");
		DB::connection('corevat')->table('cat_clase_general_inmueble')->insert(array('clase_general_inmueble' => 'MEDIA'));
		DB::connection('corevat')->table('cat_clase_general_inmueble')->insert(array('clase_general_inmueble' => 'ECONÓMICA'));
		DB::connection('corevat')->table('cat_clase_general_inmueble')->insert(array('clase_general_inmueble' => 'INTERÉS SOCIAL'));
		DB::connection('corevat')->table('cat_clase_general_inmueble')->insert(array('clase_general_inmueble' => 'MEDIA SEMILUJO'));
		DB::connection('corevat')->table('cat_clase_general_inmueble')->insert(array('clase_general_inmueble' => 'RESIDENCIAL'));
		DB::connection('corevat')->table('cat_clase_general_inmueble')->insert(array('clase_general_inmueble' => 'RESIDENCIAL PLUS'));
		DB::connection('corevat')->table('cat_clase_general_inmueble')->insert(array('clase_general_inmueble' => 'TERRENO'));
		DB::connection('corevat')->table('cat_clase_general_inmueble')->insert(array('clase_general_inmueble' => 'SOLAR'));
	}
	
}
