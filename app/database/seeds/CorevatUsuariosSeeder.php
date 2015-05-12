<?php

class CorevatUsuariosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('usuarios')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE usuarios_iduser_seq RESTART;");
		DB::connection('corevat')->statement("COPY usuarios FROM '" . base_path() . "/sources/usuarios.csv'");
		
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE usuarios_iduser_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE usuarios_iduser_seq RESTART WITH 101;");
	}

}
