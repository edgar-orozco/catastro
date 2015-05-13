<?php

class CorevatFoliosSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('folios')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE folios_idfolio_seq RESTART;");
		DB::connection('corevat')->table('folios')->insert(array('idfolio' => 13, 'iduser' => 65, 'fecha' => '2014-09-04 10:10:45', 'importefolio' => 172.80));
		DB::connection('corevat')->table('folios')->insert(array('idfolio' => 15, 'iduser' => 59, 'fecha' => '2014-09-04 10:19:40', 'importefolio' => 492.80));
		DB::connection('corevat')->table('folios')->insert(array('idfolio' => 16, 'iduser' => 5,  'fecha' => '2014-09-04 17:27:05', 'importefolio' => 3456.80));
		DB::connection('corevat')->table('folios')->insert(array('idfolio' => 14, 'iduser' => 65, 'fecha' => '2014-09-04 10:17:07', 'importefolio' => 15.80));
		DB::connection('corevat')->table('folios')->insert(array('idfolio' => 17, 'iduser' => 9,  'fecha' => '2014-09-04 17:33:16', 'importefolio' => 124.50));
		DB::connection('corevat')->table('folios')->insert(array('idfolio' => 18, 'iduser' => 12, 'fecha' => '2014-09-04 17:58:22', 'importefolio' => 136.00));
		DB::connection('corevat')->table('folios')->insert(array('idfolio' => 19, 'iduser' => 14, 'fecha' => '2014-09-04 17:58:39', 'importefolio' => 30.00));
		DB::connection('corevat')->table('folios')->insert(array('idfolio' => 20, 'iduser' => 15, 'fecha' => '2014-09-04 17:59:27', 'importefolio' => 750.00));
		DB::connection('corevat')->table('folios')->insert(array('idfolio' => 21, 'iduser' => 29, 'fecha' => '2014-09-06 11:01:45', 'importefolio' => 289.90));

		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE folios_idfolio_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE folios_idfolio_seq RESTART WITH 22;");
	}

}
