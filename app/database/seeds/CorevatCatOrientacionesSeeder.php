<?php

class CorevatCatOrientacionesSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_orientaciones')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_orientaciones_idorientacion_seq RESTART;");
		DB::connection('corevat')->table('cat_orientaciones')->insert(array('orientacion' => 'NORTE'));
		DB::connection('corevat')->table('cat_orientaciones')->insert(array('orientacion' => 'SUR'));
		DB::connection('corevat')->table('cat_orientaciones')->insert(array('orientacion' => 'ESTE'));
		DB::connection('corevat')->table('cat_orientaciones')->insert(array('orientacion' => 'OESTE'));
		DB::connection('corevat')->table('cat_orientaciones')->insert(array('orientacion' => 'NORESTE'));
		DB::connection('corevat')->table('cat_orientaciones')->insert(array('orientacion' => 'SURESTE'));
		DB::connection('corevat')->table('cat_orientaciones')->insert(array('orientacion' => 'NOROESTE'));
		DB::connection('corevat')->table('cat_orientaciones')->insert(array('orientacion' => 'SUROESTE'));
		DB::connection('corevat')->table('cat_orientaciones')->insert(array('orientacion' => 'ORIENTE'));
		DB::connection('corevat')->table('cat_orientaciones')->insert(array('orientacion' => 'PONIENTE'));
		DB::connection('corevat')->table('cat_orientaciones')->insert(array('orientacion' => 'ARRIBA'));
		DB::connection('corevat')->table('cat_orientaciones')->insert(array('orientacion' => 'ABAJO'));
	}

}
