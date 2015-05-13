<?php

class CorevatAvaluoFotosPlanosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('avaluo_fotos_planos')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_fotos_planos_idavaluofotosplano_seq RESTART;");
		DB::connection('corevat')->statement("COPY avaluo_fotos_planos FROM '" . base_path() . "/sources/avaluo_fotos_planos.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_fotos_planos_idavaluofotosplano_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_fotos_planos_idavaluofotosplano_seq RESTART WITH 24;");
	}

}
