<?php

class CorevatCatFactoresZonasSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_factores_zonas')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_factores_zonas_idfactorzona_seq RESTART;");
		DB::connection('corevat')->table('cat_factores_zonas')->insert(array('valor_factor_zona' => 0.00, 'factor_zona' => ''));
		DB::connection('corevat')->table('cat_factores_zonas')->insert(array('valor_factor_zona' => 0.60, 'factor_zona' => 'sin frente a vialida'));
		DB::connection('corevat')->table('cat_factores_zonas')->insert(array('valor_factor_zona' => 0.80, 'factor_zona' => 'calle Inferior a mod'));
		DB::connection('corevat')->table('cat_factores_zonas')->insert(array('valor_factor_zona' => 1.00, 'factor_zona' => 'calle moda'));
		DB::connection('corevat')->table('cat_factores_zonas')->insert(array('valor_factor_zona' => 1.20, 'factor_zona' => 'calle superior a mod'));
		DB::connection('corevat')->table('cat_factores_zonas')->insert(array('valor_factor_zona' => 1.00, 'factor_zona' => 'corredor de valor'));
		DB::connection('corevat')->table('cat_factores_zonas')->insert(array('valor_factor_zona' => 0.90, 'factor_zona' => 'Ninguno'));
		DB::connection('corevat')->table('cat_factores_zonas')->insert(array('valor_factor_zona' => 0.95, 'factor_zona' => 'Factor'));
	}

}
