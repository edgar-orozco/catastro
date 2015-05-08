<?php

class CorevatCatClasificacionZonaSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_clasificacion_zona')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_clasificacion_zona_idclasificacionzona_seq RESTART;");
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Habitacional de 1er orden (muy buena)'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Habitacional de 2do orden (buena)'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Habitacional de 3er orden (media/regular)'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Habitacional interés social'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Popular o proletaria'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Habitacional popular'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Residencial'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Comercial'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'De servicios'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'INDUSTRIAL'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'TURÍSTICA'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Mixta habitacional y comercial'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Mixta habitacional y de servicios'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Mixta habitacional e Industrial'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Mixta habitacional y turistica'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Mixta comercial y de servicios'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Mixta comercial e industrial'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'Tecnologías de la Información'));
		DB::connection('corevat')->table('cat_clasificacion_zona')->insert(array('clasificacion_zona' => 'RURAL'));
	}
	
}
