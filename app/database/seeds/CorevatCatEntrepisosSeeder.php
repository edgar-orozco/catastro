<?php

class CorevatCatEntrepisosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_entrepisos')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_entrepisos_identrepiso_seq RESTART;");
		DB::connection('corevat')->table('cat_entrepisos')->insert(array('entrepiso' => 'LOSA MACISA DE CONC. ARMADO DE 12 CMS'));
		DB::connection('corevat')->table('cat_entrepisos')->insert(array('entrepiso' => 'LOSA MACISA DE CONC. ARMADO DE 10 CMS'));
		DB::connection('corevat')->table('cat_entrepisos')->insert(array('entrepiso' => 'LOSA RETICULAR DE 20 CMS DE PERALTE Y CASETONES, CLAROS MEDIANOS.'));
		DB::connection('corevat')->table('cat_entrepisos')->insert(array('entrepiso' => 'LOSA DE VIGUETA Y BOVEDILLA DE 20 CMS DE PERALTE, CLAROS MEDIANOS'));
		DB::connection('corevat')->table('cat_entrepisos')->insert(array('entrepiso' => 'TRABE-LOSA TIPO "T" Ó DOBLE "T" DE CONCRETO PRETENSADO, GRAN CLARO.'));
		DB::connection('corevat')->table('cat_entrepisos')->insert(array('entrepiso' => 'TRIDILOSA DE FIERRO ANGULAR Y VARILLA REDONDA, CLAROS GRANDES.'));
		DB::connection('corevat')->table('cat_entrepisos')->insert(array('entrepiso' => 'INEXISTENTE'));
		DB::connection('corevat')->table('cat_entrepisos')->insert(array('entrepiso' => 'NO APLICA'));
	}
	
}
