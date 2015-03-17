<?php


class DepartamentosTramitesTableSeeder extends Seeder {

	public function run()
	{
        DepartamentoTramite::create([
            'nombre'=>'DEPARTAMENTO DE RECEPCIÓN',
            'orden'=>1
        ]);
        DepartamentoTramite::create([
            'nombre'=>'DEPARTAMENTO DE ADMINISTRACIÓN DE TRÁMITE',
            'orden'=>1
        ]);
        DepartamentoTramite::create([
            'nombre'=>'DEPARTAMENTO DE REGISTRO Y VALUACIÓN',
            'orden'=>1
        ]);
        DepartamentoTramite::create([
            'nombre'=>'DEPARTAMENTO DE CARTOGRAFÍA',
            'orden'=>1
        ]);
        DepartamentoTramite::create([
            'nombre'=>'DIRECCIÓN GENERAL DE CATASTRO Y EJECUCIÓN FISCAL',
            'orden'=>1
        ]);
        DepartamentoTramite::create([
            'nombre'=>'SUBDIRECCIÓN DE CATASTRO',
            'orden'=>1
        ]);
	}

}