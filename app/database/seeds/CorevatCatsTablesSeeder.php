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

    protected $municipios = [
      'BALANCAN' => '001',
      'CARDENAS' => '002',
      'CENTLA' => '003',
      'CENTRO' => '004',
      'COMALCALCO' => '005',
      'CUNDUACAN' => '006',
      'EMILIANO ZAPATA' => '007',
      'HUIMANGUILLO' => '008',
      'JALAPA' => '009',
      'JALPA DE MENDEZ' => '010',
      'JONUTA' => '011',
      'MACUSPANA' => '012',
      'NACAJUCA' => '013',
      'PARAISO' => '014',
      'TACOTALPA' => '015',
      'TEAPA' => '016',
      'TENOSIQUE' => '017',
    ];

    public function run()
	{
		foreach($this->catalogos as $catalogo){
            DB::connection($this->conn)->statement("DELETE FROM cat_".$catalogo);
            DB::connection($this->conn)->statement("COPY cat_".$catalogo." FROM '/var/www/html/sources/cat_".$catalogo.".csv' CSV");
        }

        //Se activan las entradas de cat_clase_general_inmueble (la tabla no tiene un default true en el campo de estatus)
        DB::connection($this->conn)->statement("UPDATE cat_clase_general_inmueble SET status_clase_general_inmueble = 1");

        //Eliminamos todas las entradas del catálogo que tienen estatus 0
        DB::connection($this->conn)->statement("DELETE FROM municipios WHERE status = 0");

        //Modificamos la clave de cada municipio
        foreach($this->municipios as $municipio => $cve){
            DB::connection($this->conn)->
            statement("UPDATE municipios SET clave = '$cve' WHERE municipio = '$municipio'");
        }
	}
}