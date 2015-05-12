<?php

class CorevatAemAnalisisSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('aem_analisis')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_analisis_idaemanalisis_seq RESTART;");
		DB::connection('corevat')->statement("COPY aem_analisis FROM '" . base_path() . "/sources/aem_analisis.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_analisis_idaemanalisis_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_analisis_idaemanalisis_seq RESTART WITH 401;");
	}

}
