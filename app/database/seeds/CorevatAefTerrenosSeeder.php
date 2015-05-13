<?php

class CorevatAefTerrenosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('aef_terrenos')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aef_terrenos_idaefterreno_seq RESTART;");
		DB::connection('corevat')->statement("COPY aef_terrenos FROM '" . base_path() . "/sources/aef_terrenos.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aef_terrenos_idaefterreno_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aef_terrenos_idaefterreno_seq RESTART WITH 430;");
	}

}
