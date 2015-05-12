<?php

class CorevatFoliosDetallesSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('folios_detalles')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE folios_detalles_idfoliodetalle_seq RESTART;");
		DB::connection('corevat')->statement("COPY folios_detalles (idfoliodetalle, idfolio, serie, iduser, cantidad, pu, importe, fecha_pago) FROM '" . base_path() . "/sources/folios_detalles.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE folios_detalles_idfoliodetalle_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE folios_detalles_idfoliodetalle_seq RESTART WITH 31;");
	}

}
