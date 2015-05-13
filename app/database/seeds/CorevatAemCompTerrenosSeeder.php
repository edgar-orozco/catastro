<?php

class CorevatAemCompTerrenosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('aem_comp_terrenos')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_comp_terrenos_idaemcompterreno_seq RESTART;");
		DB::connection('corevat')->statement("COPY aem_comp_terrenos FROM '" . base_path() . "/sources/aem_comp_terrenos.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_comp_terrenos_idaemcompterreno_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aem_comp_terrenos_idaemcompterreno_seq RESTART WITH 401;");
	}

}
