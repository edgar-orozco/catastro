<?php

class CorevatUsuariosNivelDeAccesoSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('usuarios_niveldeacceso')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE usuarios_niveldeacceso_idusernivelacceso_seq RESTART;");
		DB::connection('corevat')->table('usuarios_niveldeacceso')->insert(array('clave' => '001', 'nivel_de_acceso' => 'Perito Valuador'));
		DB::connection('corevat')->table('usuarios_niveldeacceso')->insert(array('clave' => '002', 'nivel_de_acceso' => 'Consultor'));
		DB::connection('corevat')->table('usuarios_niveldeacceso')->insert(array('clave' => '003', 'nivel_de_acceso' => 'Control'));
		DB::connection('corevat')->table('usuarios_niveldeacceso')->insert(array('clave' => '004', 'nivel_de_acceso' => 'Administrador'));
		DB::connection('corevat')->table('usuarios_niveldeacceso')->insert(array('clave' => '005', 'nivel_de_acceso' => 'ER 005'));
		DB::connection('corevat')->table('usuarios_niveldeacceso')->insert(array('clave' => '006', 'nivel_de_acceso' => 'ER 006'));
	}

}
