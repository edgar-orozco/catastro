<?php

class EjecutoresSeeder extends Seeder {

	public function run()
	{
	//	$tt = ejecutores::create([
		
	    DB::table('ejecutores')->insert(
            array(  'id_ejecutor' => 1,   
					'id_p'  => 18697,
					'cargo'  => 'SUBDIRECTOR DE EJECUCIÓN FISCAL',
					'titulo'  =>  'LIC',
					'f_nombramiento'  => '2015-02-17',
					'id_p_otorga_nombramiento'  => 18045,
					'usuario'  => 1,
					'f_alta'  => date('Y-m-d H:i:s'),
					'f_modificacion'  => null)
				);
			//$tt = ejecutores::create([
		
	DB::table('ejecutores')->insert(
            array(	'id_ejecutor' => 2, 
					'id_p'  => 19063,
					'cargo'  => 'DIRECTOR DE EJECUCIÓN FISCAL',
					'titulo'  =>  'LIC',
					'f_nombramiento'  => '2015-02-26',
					'id_p_otorga_nombramiento'  => 41928,
					'usuario'  => 1,
					'f_alta'  => '2015-02-26',
					'f_modificacion'  => null	)
				);
}

}
		
	