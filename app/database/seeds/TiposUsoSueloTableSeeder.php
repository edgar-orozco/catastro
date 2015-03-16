<?php
/**
 * Class TiposUsoSueloTableSeeder
 */
class TiposUsoSueloTableSeeder extends Seeder {

    public function run()
    {
        UsoSuelo::create([
            'descripcion'=>'HABITACIONAL'
        ]);

        UsoSuelo::create([
            'descripcion'=>'NO HABITACIONAL'
        ]);
        UsoSuelo::create([
            'descripcion'=>'MIXTO'
        ]);
        UsoSuelo::create([
            'descripcion'=>'SIN USO'
        ]);

    }

}