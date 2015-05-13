<?php

class CorevatCatTipoInmuebleSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_tipo_inmueble')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_tipo_inmueble_idtipoinmueble_seq RESTART;");
		DB::connection('corevat')->table('cat_tipo_inmueble')->insert(array('tipo_inmueble' => 'TERRENO'));
		DB::connection('corevat')->table('cat_tipo_inmueble')->insert(array('tipo_inmueble' => 'CASA HABITACION'));
		DB::connection('corevat')->table('cat_tipo_inmueble')->insert(array('tipo_inmueble' => 'CASA EN CONDOMINIO'));
		DB::connection('corevat')->table('cat_tipo_inmueble')->insert(array('tipo_inmueble' => 'DEPARTAMENTO EN CONDOMINIO'));
		DB::connection('corevat')->table('cat_tipo_inmueble')->insert(array('tipo_inmueble' => 'VIVIENDA MULTIPLE'));
		
	}

}
