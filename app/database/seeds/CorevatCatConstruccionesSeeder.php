<?php

class CorevatCatConstruccionesSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_construcciones')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_clasificacion_zona_idclasificacionzona_seq RESTART;");
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'INTERÉS SOCIAL'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'CASA HABITACIÓN UNIFAMILIAR'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'CASA HABITACIÓN UNIFAMILIAR DE UN NIVEL'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'CASA HABITACIÓN UNIFAMILIAR DE 1 Y 2 NIVELES'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'CASA HABITACIÓN UNIFAMILIAR DE 2 Y 3 NIVELES'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'CASA HABITACIÓN Y EDIFICIO DE HASTA 3 NIVELES'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'CASA HABITACIÓN Y EDIFICIO DE HASTA 4 NIVELES'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'VIVIENDA MULTIFAMILIAR VERTICAL DE 3 A 5 NIVELES'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'LOCALES COMERCIALES'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'CASA HABITACIÓN Y LOCALES COMERCIALES'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'BODEGAS'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'NAVES INDUSTRIALES'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'EDIFICIO DE OFICINAS'));
		DB::connection('corevat')->table('cat_construcciones')->insert(array('construccion' => 'NO APLICA'));
	}
	
}
