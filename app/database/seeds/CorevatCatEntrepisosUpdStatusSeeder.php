<?php

class CorevatCatEntrepisosUpdStatusSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->getPdo()->exec("UPDATE cat_entrepisos SET status_entrepiso = 1;");
	}
	
}
