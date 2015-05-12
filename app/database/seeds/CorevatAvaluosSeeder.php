<?php

class CorevatAvaluosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('avaluos')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluos_idavaluo_seq RESTART;");
		DB::connection('corevat')->statement("COPY avaluos FROM '" . base_path() . "/sources/avaluos.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluos_idavaluo_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluos_idavaluo_seq RESTART WITH 510;");
	}

}
