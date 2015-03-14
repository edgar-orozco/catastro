<?php


class UsoSueloTableSeeder extends Seeder {

	public function run()
	{
        TiposUsoSuelo::create([
            'descripcion'=>'HABITACIONAL'
        ]);

        TiposUsoSuelo::create([
            'descripcion'=>'NO HABITACIONAL'
        ]);
        TiposUsoSuelo::create([
            'descripcion'=>'MIXTO'
        ]);
        TiposUsoSuelo::create([
            'descripcion'=>'SIN USO'
        ]);

    }

}