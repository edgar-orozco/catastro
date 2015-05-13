<?php

class CorevatEmpresasSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('empresas')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE empresas_idemp_seq RESTART;");
		DB::connection('corevat')->table('empresas')->insert(
				array
				(
					'rs' => 'COREVAT TABASCO',
					'ncomer' => 'COREVAT TABASCO',
					'df' => 'COREVAT TABASCO',
					'rfc' => ''
				)
		);
	}

}
