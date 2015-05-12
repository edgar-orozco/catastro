<?php

class CorevatAefConstruccionesSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('aef_construcciones')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aef_construcciones_idaefconstruccion_seq RESTART;");
		DB::connection('corevat')->statement("COPY aef_construcciones FROM '" . base_path() . "/sources/aef_construcciones.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aef_construcciones_idaefconstruccion_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE aef_construcciones_idaefconstruccion_seq RESTART WITH 510;");
	}

}
