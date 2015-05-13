<?php

class CorevatCatFactoresSuperficieSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_factores_superficie')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_factores_superficie_idfactorsuperficie_seq RESTART;");
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 0.00, 'maximo' => 2.00,  'resultante' => 1.00));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 2.10, 'maximo' => 3.00,  'resultante' => 0.98));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 3.10, 'maximo' => 4.00,  'resultante' => 0.96));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 4.10, 'maximo' => 5.00,  'resultante' => 0.94));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 5.10, 'maximo' => 6.00,  'resultante' => 0.92));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 6.10, 'maximo' => 7.00,  'resultante' => 0.90));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 7.10, 'maximo' => 8.00,  'resultante' => 0.88));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 8.10, 'maximo' => 9.00,  'resultante' => 0.86));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 9.10, 'maximo' => 10.00, 'resultante' => 0.84));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 10.10, 'maximo' => 11.00, 'resultante' => 0.83));
		
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 11.10, 'maximo' => 12.00, 'resultante' => 0.80));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 12.10, 'maximo' => 13.00, 'resultante' => 0.78));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 13.10, 'maximo' => 14.00, 'resultante' => 0.76));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 14.10, 'maximo' => 15.00, 'resultante' => 0.74));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 15.10, 'maximo' => 16.00, 'resultante' => 0.72));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 16.10, 'maximo' => 17.00, 'resultante' => 0.70));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 17.10, 'maximo' => 18.00, 'resultante' => 0.68));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 18.10, 'maximo' => 19.00, 'resultante' => 0.66));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 19.10, 'maximo' => 20.00, 'resultante' => 0.64));
		DB::connection('corevat')->table('cat_factores_superficie')->insert(array('minimo' => 20.10, 'maximo' => 100.00, 'resultante' => 0.62));
	}

}
