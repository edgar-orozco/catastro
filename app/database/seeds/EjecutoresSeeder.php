<?php

class ejecutoresTableSeeder extends Seeder {

	public function run()
	{
		$tt = ejecutores::create([
		
		'id_ejecutor' => int4 NOT NULL,
'id_p'  => 2,
'id_p'  => 18697,
'cargo'  => "SUBDIRECTOR DE EJECUCIÓN FISCAL",
'titulo'  =>  "LIC",
'f_nombramiento'  => '2015-02-17',
'id_p_otorga_nombramiento'  => 18045,
'usuario'  => null,
'f_alta'  => '2015-02-17',
'f_modificacion'  => null,	
]);
			$tt = ejecutores::create([
		
		'id_ejecutor' => int4 NOT NULL,
'id_p'  => 15,
'id_p'  => 19063,
'cargo'  => "DIRECTOR DE EJECUCIÓN FISCAL",
'titulo'  =>  "LIC",
'f_nombramiento'  => '2015-02-26',
'id_p_otorga_nombramiento'  => 41928,
'usuario'  => null,
'f_alta'  => '2015-02-26',
'f_modificacion'  => null,	
]);
}

}
		
	