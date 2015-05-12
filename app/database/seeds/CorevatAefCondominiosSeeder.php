<?php

class CorevatAefCondominiosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('aef_condominios')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aef_condominios_idaefcondominio_seq RESTART;");
		DB::connection('corevat')->statement("COPY aef_condominios FROM '" . base_path() . "/sources/aef_condominios.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aef_condominios_idaefcondominio_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aef_condominios_idaefcondominio_seq RESTART WITH 24;");
	}

}
