<?php

class CorevatAvaluoEnfoqueFisicoSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('avaluo_enfoque_fisico')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_enfoque_fisico_idavaluoenfoquefisico_seq RESTART;");
		DB::connection('corevat')->statement("COPY avaluo_enfoque_fisico FROM '" . base_path() . "/sources/avaluo_enfoque_fisico.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_enfoque_fisico_idavaluoenfoquefisico_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_enfoque_fisico_idavaluoenfoquefisico_seq RESTART WITH 510;");
	}

}
