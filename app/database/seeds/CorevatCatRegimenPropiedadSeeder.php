<?php

class CorevatCatRegimenPropiedadSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_regimen_propiedad')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_regimen_propiedad_idregimenpropiedad_seq RESTART;");
		DB::connection('corevat')->table('cat_regimen_propiedad')->insert(array('regimen_propiedad' => 'Privada individual'));
		DB::connection('corevat')->table('cat_regimen_propiedad')->insert(array('regimen_propiedad' => 'Coopropiedad'));
		DB::connection('corevat')->table('cat_regimen_propiedad')->insert(array('regimen_propiedad' => 'Privada en Condominio'));
		DB::connection('corevat')->table('cat_regimen_propiedad')->insert(array('regimen_propiedad' => 'Ejidal'));
		DB::connection('corevat')->table('cat_regimen_propiedad')->insert(array('regimen_propiedad' => 'PúBLICO FEDERAL'));
		DB::connection('corevat')->table('cat_regimen_propiedad')->insert(array('regimen_propiedad' => 'PúBLICO ESTATAL'));
		DB::connection('corevat')->table('cat_regimen_propiedad')->insert(array('regimen_propiedad' => 'Público Municipal'));
		
	}

}
