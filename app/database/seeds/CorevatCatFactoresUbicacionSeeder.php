<?php

class CorevatCatFactoresUbicacionSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_factores_ubicacion')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_factores_ubicacion_idfactorubicacion_seq RESTART;");
		DB::connection('corevat')->table('cat_factores_ubicacion')->insert(array('valor_factor_ubicacion' => 0.00, 'factor_ubicacion' => ''));
		DB::connection('corevat')->table('cat_factores_ubicacion')->insert(array('valor_factor_ubicacion' => 0.00, 'factor_ubicacion' => 'SIN FRENTE A CALLE'));
		DB::connection('corevat')->table('cat_factores_ubicacion')->insert(array('valor_factor_ubicacion' => 1.00, 'factor_ubicacion' => 'n frente'));
		DB::connection('corevat')->table('cat_factores_ubicacion')->insert(array('valor_factor_ubicacion' => 1.15, 'factor_ubicacion' => ' frentes'));
		DB::connection('corevat')->table('cat_factores_ubicacion')->insert(array('valor_factor_ubicacion' => 1.25, 'factor_ubicacion' => '3 FRENTES'));
		DB::connection('corevat')->table('cat_factores_ubicacion')->insert(array('valor_factor_ubicacion' => 1.35, 'factor_ubicacion' => '4 frentes'));
		DB::connection('corevat')->table('cat_factores_ubicacion')->insert(array('valor_factor_ubicacion' => 1.35, 'factor_ubicacion' => 'mas de 4 frentes'));
	}

}
