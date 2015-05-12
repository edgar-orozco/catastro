<?php

class CorevatAemHomologacionSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('aem_homologacion')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_homologacion_idaemhomologacion_seq RESTART;");
		DB::connection('corevat')->statement("COPY aem_homologacion FROM '" . base_path() . "/sources/aem_homologacion.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_homologacion_idaemhomologacion_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_homologacion_idaemhomologacion_seq RESTART WITH 1001;");
	}

}
