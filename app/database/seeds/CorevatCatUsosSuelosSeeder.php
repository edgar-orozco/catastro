<?php

class CorevatCatUsosSuelosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_usos_suelos')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_usos_suelos_idusossuelos_seq RESTART;");
		DB::connection('corevat')->table('cat_usos_suelos')->insert(array('usos_suelos' => 'Habitacional'));
		DB::connection('corevat')->table('cat_usos_suelos')->insert(array('usos_suelos' => 'Habitacional comercial'));
		DB::connection('corevat')->table('cat_usos_suelos')->insert(array('usos_suelos' => 'Comercial'));
		DB::connection('corevat')->table('cat_usos_suelos')->insert(array('usos_suelos' => 'Oficina'));
		DB::connection('corevat')->table('cat_usos_suelos')->insert(array('usos_suelos' => 'Industrial'));
		DB::connection('corevat')->table('cat_usos_suelos')->insert(array('usos_suelos' => 'Servicio y Comercio'));
		DB::connection('corevat')->table('cat_usos_suelos')->insert(array('usos_suelos' => 'Mixto'));
		DB::connection('corevat')->table('cat_usos_suelos')->insert(array('usos_suelos' => 'Servicios y turistica'));
		DB::connection('corevat')->table('cat_usos_suelos')->insert(array('usos_suelos' => 'Turistica e industrial'));
		DB::connection('corevat')->table('cat_usos_suelos')->insert(array('usos_suelos' => 'Habitacional rural'));
		DB::connection('corevat')->table('cat_usos_suelos')->insert(array('usos_suelos' => 'HABITACIONAL RURAL CON COMERCIO Y SERVICIOS'));
		DB::connection('corevat')->table('cat_usos_suelos')->insert(array('usos_suelos' => 'NO APLICA'));
		
	}

}
