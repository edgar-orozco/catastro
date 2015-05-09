<?php

class CorevatCatFactoresFrenteSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_factores_frente')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_factores_frente_idfactorfrente_seq RESTART;");
		DB::connection('corevat')->table('cat_factores_frente')->insert(array('valor_factor_frente' => 0.00, 'factor_frente' => ''));
		DB::connection('corevat')->table('cat_factores_frente')->insert(array('valor_factor_frente' => 0.60, 'factor_frente' => 'menor'));
		DB::connection('corevat')->table('cat_factores_frente')->insert(array('valor_factor_frente' => 0.80, 'factor_frente' => 'DE'));
		DB::connection('corevat')->table('cat_factores_frente')->insert(array('valor_factor_frente' => 1.00, 'factor_frente' => 'mayor'));
	}

}
