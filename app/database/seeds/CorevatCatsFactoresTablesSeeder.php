<?php

/**
 * Class CorevatCatsFactoresTablesSeede
 *
 * Este seeder carga todos los catálogos de factores en el corevat
 */


class CorevatCatsFactoresTablesSeeder extends Seeder {

    protected $conn = 'corevat';
    protected $catalogos = ['conservacion', 'forma', 'frente', 'superficie', 'ubicacion', 'zonas'];

    public function run()
	{
		foreach($this->catalogos as $catalogo){
            DB::connection($this->conn)->statement("DELETE FROM cat_factores_".$catalogo);
            DB::connection($this->conn)->statement("COPY cat_factores_".$catalogo." FROM '/var/www/html/sources/cat_factores_".$catalogo.".csv' CSV");
        }
	}
}