<?php

class CorevatAvaluoInmuebleSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('avaluo_inmueble')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_inmueble_idavaluoinmueble_seq RESTART;");
		DB::connection('corevat')->statement("COPY avaluo_inmueble FROM '" . base_path() . "/sources/avaluo_inmueble.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_inmueble_idavaluoinmueble_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_inmueble_idavaluoinmueble_seq RESTART WITH 551;");
	}

}
