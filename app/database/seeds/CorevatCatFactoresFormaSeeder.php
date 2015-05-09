<?php

class CorevatCatFactoresFormaSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_factores_forma')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_factores_forma_idfactorforma_seq RESTART;");
		DB::connection('corevat')->table('cat_factores_forma')->insert(array('valor_factor_forma' => 0.00, 'factor_forma' => ''));
		DB::connection('corevat')->table('cat_factores_forma')->insert(array('valor_factor_forma' => 1.00, 'factor_forma' => 'REGULAR'));
		DB::connection('corevat')->table('cat_factores_forma')->insert(array('valor_factor_forma' => 0.00, 'factor_forma' => 'irregular'));
		DB::connection('corevat')->table('cat_factores_forma')->insert(array('valor_factor_forma' => 0.00, 'factor_forma' => 'DEPARTAENTO'));
		DB::connection('corevat')->table('cat_factores_forma')->insert(array('valor_factor_forma' => 0.00, 'factor_forma' => 'DEPARTAMENTO'));
	}

}
