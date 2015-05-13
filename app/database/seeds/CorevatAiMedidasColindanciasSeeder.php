<?php

class CorevatAiMedidasColindanciasSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->table('ai_medidas_colindancias')->delete();
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE ai_medidas_colindancias_idaimedidacolindancia_seq RESTART;");
		DB::connection('corevat')->statement("COPY ai_medidas_colindancias FROM '" . base_path() . "/sources/ai_medidas_colindancias.csv'");

		//DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE ai_medidas_colindancias_idaimedidacolindancia_seq START WITH 1;");
		DB::connection('corevat')->getPdo()->exec("ALTER SEQUENCE ai_medidas_colindancias_idaimedidacolindancia_seq RESTART WITH 24;");
	}

}
