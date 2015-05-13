<?php

class CorevatCatFactoresConservacionSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_factores_conservacion')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_estructuras_idestructura_seq RESTART;");
		DB::connection('corevat')->table('cat_factores_conservacion')->insert(array('abr_factor_conservacion' => 'XX', 'factor_conservacion' => 'IE', 'factor_conservacion' => 0.00));
		DB::connection('corevat')->table('cat_factores_conservacion')->insert(array('abr_factor_conservacion' => 'MA', 'factor_conservacion' => 'MALO', 'factor_conservacion' => 0.75));
		DB::connection('corevat')->table('cat_factores_conservacion')->insert(array('abr_factor_conservacion' => 'DEF', 'factor_conservacion' => 'DEFICIENTE', 'factor_conservacion' => 0.80));
		DB::connection('corevat')->table('cat_factores_conservacion')->insert(array('abr_factor_conservacion' => 'RE', 'factor_conservacion' => 'REGULAR', 'factor_conservacion' => 0.85));
		DB::connection('corevat')->table('cat_factores_conservacion')->insert(array('abr_factor_conservacion' => 'BU', 'factor_conservacion' => 'BUENO', 'factor_conservacion' => 0.90));
		DB::connection('corevat')->table('cat_factores_conservacion')->insert(array('abr_factor_conservacion' => 'MB', 'factor_conservacion' => 'MUY BURNO', 'factor_conservacion' => 0.95));
		DB::connection('corevat')->table('cat_factores_conservacion')->insert(array('abr_factor_conservacion' => 'NVO', 'factor_conservacion' => 'NUEVO', 'factor_conservacion' => 1.00));
		DB::connection('corevat')->table('cat_factores_conservacion')->insert(array('abr_factor_conservacion' => 'MM', 'factor_conservacion' => 'MUY MALO', 'factor_conservacion' => 0.70));
		DB::connection('corevat')->table('cat_factores_conservacion')->insert(array('abr_factor_conservacion' => 'RU', 'factor_conservacion' => 'RUINOSO', 'factor_conservacion' => 0.65));
		DB::connection('corevat')->table('cat_factores_conservacion')->insert(array('abr_factor_conservacion' => '', 'factor_conservacion' => '', 'factor_conservacion' => 0.00));
	}

}
