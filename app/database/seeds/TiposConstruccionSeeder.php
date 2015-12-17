<?php

use Faker\Factory as Faker;

class TiposConstruccionSeeder extends Seeder {

    public function run()
  {
  	$tiposConstruccion = [
            'Antigua' => ['A1' => 'Económica', 'A2'=>'Medio', 'A3'=>'Superior'],
            'Moderna' => ['M1' => 'Interés Social', 'M2'=>'Popular', 'M3'=>'Medio', 'M4'=>'Bueno', 'M5'=>'Superior'],
            'Edificio Habitacional' => ['H1'=>'Interés social', 'H2'=>'Medio', 'H3'=>'Superior'],
            'Construcciones Especiales' => ['C1'=>'Corriente', 'C2'=>'Medio', 'C3'=>'Bueno'],
            'Edif. Construcciones Especiales' => ['E1'=>'Medio', 'E2'=>'Bueno'],
        ];

        foreach($tiposConstruccion as $k => $v)
        {
            foreach($v as $a => $b)
            {
            	mTiposConstruccion::create(['descripcion'=>$b, 'cve_tipo_construccion'=>$a, 'grupo_tipoconstruccion'=>$k]);
            }
        }
  }


}