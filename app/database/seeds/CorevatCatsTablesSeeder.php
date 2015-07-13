<?php

/**
 * Class CorevatCatsTablesSeede
 *
 * Este seeder carga todos los catálogos del corevat
 */


class CorevatCatsTablesSeeder extends Seeder {

    protected $conn = 'corevat';
    protected $catalogos = [
      'aplanados',
      //'bardas',
      //'calidad_proyecto',
      //'cimentaciones',
      //'clase_general_inmueble',
      //'clasificacion_zona',
      'construcciones',
      //'entrepisos',
      //'estado_conservacion',
      //'estructuras',
      //'muros',
      'niveles',
      //'obras_complementarias',
      'orientaciones',
      'pisos',
      'plafones',
      //'proximidad_urbana',
      //'regimen_propiedad',
      //'techos',
      //'tipo_inmueble',
      //'usos_suelos',
    ];

    public function run()
	{
		foreach($this->catalogos as $catalogo){
            DB::connection($this->conn)->statement("DELETE FROM cat_".$catalogo);
            DB::connection($this->conn)->statement("COPY cat_".$catalogo." FROM '/var/www/html/sources/cat_".$catalogo.".csv' CSV");
        }
	}
}