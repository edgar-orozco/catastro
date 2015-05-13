<?php

class CorevatEstadosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('estados')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE estados_idestado_seq RESTART;");
		DB::connection('corevat')->table('estados')->insert(array('clave' => '27', 'estado' => 'TABASCO'));
	}

}
