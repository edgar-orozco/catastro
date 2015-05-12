<?php

class CorevatAvaluoZonaSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('avaluo_zona')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_zona_idavaluozona_seq RESTART;");
		DB::connection('corevat')->statement("COPY avaluo_zona FROM '" . base_path() . "/sources/avaluo_zona.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_zona_idavaluozona_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_zona_idavaluozona_seq RESTART WITH 551;");
	}

}
