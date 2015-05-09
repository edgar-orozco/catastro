<?php

class CorevatCatEstadoConservacionSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_estado_conservacion')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_estado_conservacion_idestadoconservacion_seq RESTART;");
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Habitacional de 1er orden (muy buena)'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Habitacional de 2do orden (buena)'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Habitacional de 3er orden (media/regular)'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Habitacional interés social'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Popular o proletaria'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Habitacional popular'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Residencial'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Comercial'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'De servicios'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Industrial'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'TURISTICA'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Mixta habitacional y comercial'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Mixta habitacional y de servicios'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Mixta habitacional e Industrial'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Mixta habitacional y turistica'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Mixta comercial y de servicios'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Mixta comercial e industrial'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'Excelente'));
		DB::connection('corevat')->table('cat_estado_conservacion')->insert(array('estado_conservacion' => 'SEMINUEVO'));
	}

}
