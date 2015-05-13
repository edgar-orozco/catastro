<?php

class CorevatAemInformacionSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('aem_informacion')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_informacion_idaeminformacion_seq RESTART;");
		DB::connection('corevat')->statement("COPY aem_informacion FROM '" . base_path() . "/sources/aem_informacion.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_informacion_idaeminformacion_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_informacion_idaeminformacion_seq RESTART WITH 380;");
	}

}
