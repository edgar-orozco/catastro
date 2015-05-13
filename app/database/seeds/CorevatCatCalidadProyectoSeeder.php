<?php

class CorevatCatCalidadProyectoSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_calidad_proyecto')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_aplanados_idaplanado_seq RESTART;");
		DB::connection('corevat')->table('cat_calidad_proyecto')->insert(array('calidad_proyecto' => 'BUENO'));
		DB::connection('corevat')->table('cat_calidad_proyecto')->insert(array('calidad_proyecto' => 'SUFICIENTE'));
		DB::connection('corevat')->table('cat_calidad_proyecto')->insert(array('calidad_proyecto' => 'ADECUADO'));
		DB::connection('corevat')->table('cat_calidad_proyecto')->insert(array('calidad_proyecto' => 'DEFICIENTE'));
		DB::connection('corevat')->table('cat_calidad_proyecto')->insert(array('calidad_proyecto' => 'MUY BUENO'));
		DB::connection('corevat')->table('cat_calidad_proyecto')->insert(array('calidad_proyecto' => 'MALO'));
	}

}
