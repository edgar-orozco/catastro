<?php

class CorevatAvaluoConclusionesSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('avaluo_conclusiones')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_conclusiones_idavaluoconclusion_seq RESTART;");
		DB::connection('corevat')->statement("COPY avaluo_conclusiones FROM '" . base_path() . "/sources/avaluo_conclusiones.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_conclusiones_idavaluoconclusion_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE avaluo_conclusiones_idavaluoconclusion_seq RESTART WITH 506;");
	}

}
