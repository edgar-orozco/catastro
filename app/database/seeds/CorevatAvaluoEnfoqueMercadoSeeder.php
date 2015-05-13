<?php

class CorevatAvaluoEnfoqueMercadoSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('avaluo_enfoque_mercado')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_enfoque_mercado_idavaluoenfoquemercado_seq RESTART;");
		DB::connection('corevat')->statement("COPY avaluo_enfoque_mercado FROM '" . base_path() . "/sources/avaluo_enfoque_mercado.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_enfoque_mercado_idavaluoenfoquemercado_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_enfoque_mercado_idavaluoenfoquemercado_seq RESTART WITH 511;");
	}

}
