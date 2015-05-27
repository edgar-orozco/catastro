<?php

class CorevatCatClasificacionZonaUpdStatusSeeder extends Seeder {

	public function run() {
		DB::connection('corevat')->getPdo()->exec("UPDATE cat_clasificacion_zona SET status_clasificacion_zona = 1;");
	}
	
}
