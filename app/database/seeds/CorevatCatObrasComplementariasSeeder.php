<?php

class CorevatCatObrasComplementariasSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('cat_obras_complementarias')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE cat_obras_complementarias_idobracomplementaria_seq RESTART;");
		DB::connection('corevat')->table('cat_obras_complementarias')->insert(array('obra_complementaria' => 'Balcón (m2)'));
		DB::connection('corevat')->table('cat_obras_complementarias')->insert(array('obra_complementaria' => 'Pavimentos (m2)'));
		DB::connection('corevat')->table('cat_obras_complementarias')->insert(array('obra_complementaria' => 'Barda (m)'));
		DB::connection('corevat')->table('cat_obras_complementarias')->insert(array('obra_complementaria' => 'Cisterna(m3)'));
		DB::connection('corevat')->table('cat_obras_complementarias')->insert(array('obra_complementaria' => 'Jardin (m2)'));
		DB::connection('corevat')->table('cat_obras_complementarias')->insert(array('obra_complementaria' => 'Equip. A.A. (und)'));
		DB::connection('corevat')->table('cat_obras_complementarias')->insert(array('obra_complementaria' => 'Portón (m2)'));
		DB::connection('corevat')->table('cat_obras_complementarias')->insert(array('obra_complementaria' => 'T. Gas Est.(und)'));
		DB::connection('corevat')->table('cat_obras_complementarias')->insert(array('obra_complementaria' => 'M. Cocina(und)'));
		DB::connection('corevat')->table('cat_obras_complementarias')->insert(array('obra_complementaria' => 'Local comercial'));
		DB::connection('corevat')->table('cat_obras_complementarias')->insert(array('obra_complementaria' => 'JAULA DE TENDIDO'));
	}

}
