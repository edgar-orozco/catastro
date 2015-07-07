<?php


class TiposasentamientoTableSeeder extends Seeder {

	public function run()
	{
        $tipos = [
          1 => 'AEROPUERTO',
          2 => 'AMPLIACIÓN',
          3 => 'BARRIO',
          4 => 'CANTÓN',
          5 => 'CIUDAD',
          6 => 'CIUDAD INDUSTRIAL',
          7 => 'COLONIA',
          8 => 'CONDOMINIO',
          9 => 'CONJUNTO HABITACIONAL',
          10 => 'CORREDOR INDUSTRIAL',
          11 => 'COTO',
          12 => 'CUARTEL',
          13 => 'EJIDO',
          14 => 'EXHACIENDA',
          15 => 'FRACCIÓN',
          16 => 'FRACCIONAMIENTO',
          17 => 'GRANJA',
          18 => 'HACIENDA',
          19 => 'INGENIO',
          20 => 'MANZANA',
          21 => 'PARAJE',
          22 => 'PARQUE INDUSTRIAL',
          23 => 'PRIVADA',
          24 => 'PROLONGACIÓN',
          25 => 'PUEBLO',
          26 => 'PUERTO',
          27 => 'RANCHERÍA',
          28 => 'RANCHO',
          29 => 'REGIÓN',
          30 => 'RESIDENCIAL',
          31 => 'RINCONADA',
          32 => 'SECCIÓN',
          33 => 'SECTOR',
          34 => 'SUPERMANZANA',
          35 => 'UNIDAD',
          36 => 'UNIDAD HABITACIONAL',
          37 => 'VILLA',
          38 => 'ZONA FEDERAL',
          39 => 'ZONA INDUSTRIAL',
          40 => 'ZONA MILITAR',
          43 => 'ZONA NAVAL',
          41 => 'NINGUNO'
        ];

        foreach($tipos as $id => $tipo)
        {
            DB::table('tiposasentamiento')->insert([
              'id' => $id,
              'descripcion' => $tipo
            ]);
        }
	}

}