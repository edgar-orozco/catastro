<?php

class CorevatCatTipoSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_tipo')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_tipo_idtipo_seq RESTART;");
		DB::connection('corevat')->table('cat_tipo')->insert(array('tipo' => 'Terreno'));
		DB::connection('corevat')->table('cat_tipo')->insert(array('tipo' => 'Casa habitacion'));
		DB::connection('corevat')->table('cat_tipo')->insert(array('tipo' => 'Casa en condominio'));
		DB::connection('corevat')->table('cat_tipo')->insert(array('tipo' => 'Departamento en condominio'));
		DB::connection('corevat')->table('cat_tipo')->insert(array('tipo' => 'Vienda multiple'));
		DB::connection('corevat')->table('cat_tipo')->insert(array('tipo' => 'CASA DE INTERES SOCIAL'));
		
	}

}
