<?php

class CorevatFoliosDetallesSinglesSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('folios_detalles_singles')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE folios_detalles_singles_idfoliodetallesingle_seq RESTART;");
		DB::connection('corevat')->statement("COPY folios_detalles_singles FROM '" . base_path() . "/sources/folios_detalles_singles.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE folios_detalles_singles_idfoliodetallesingle_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE folios_detalles_singles_idfoliodetallesingle_seq RESTART WITH 184;");
	}

}
