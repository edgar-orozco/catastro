<?php

class CorevatAefInstalacionesSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('aef_instalaciones')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aef_instalaciones_idaefinstalacion_seq RESTART;");
		DB::connection('corevat')->statement("COPY aef_instalaciones FROM '" . base_path() . "/sources/aef_instalaciones.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aef_instalaciones_idaefinstalacion_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aef_instalaciones_idaefinstalacion_seq RESTART WITH 41;");
	}

}
