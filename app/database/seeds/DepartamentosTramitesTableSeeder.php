<?php


class DepartamentosTramitesTableSeeder extends Seeder {

	public function run()
	{

        DB::statement("ALTER SEQUENCE departamentos_tramites_id_seq RESTART WITH 1");
        DB::statement("TRUNCATE TABLE departamentos_tramites CASCADE");

        $fat = Role::firstOrCreate([
            'name'=>"Funcionario Administración de Trámite",
        ]);
        $frv = Role::firstOrCreate([
            'name'=>"Funcionario Registro y Valuación"
        ]);
        $fca = Role::firstOrCreate([
            'name'=>"Funcionario Cartografía"
        ]);
        $fdgc = Role::firstOrCreate([
            'name'=>"Funcionario Dirección General de Catastro"
        ]);
        $fsc = Role::firstOrCreate([
            'name'=>"Funcionario Subdirección de Catastro"
        ]);

        DepartamentoTramite::create([
            'nombre'=>'Recepción y Administración de Trámite',
            'alias' => 'recepción',
            'tipo' =>'departamento',
            'descripcion' => 'Recepción y Administración de Trámite',
            'role_id' => $fat->id,
            'orden'=>1
        ]);

        DepartamentoTramite::create([
            'nombre'=>'Registro y Valuación',
            'alias' => 'valuación',
            'tipo' =>'departamento',
            'descripcion' => 'Departamento de Registro y Valuación',
            'role_id' => $frv->id,
            'orden'=>2
        ]);
        DepartamentoTramite::create([
            'nombre'=>'Cartografía',
            'alias' => 'cartografía',
            'tipo' =>'departamento',
            'descripcion' => 'Departamento de Cartografía',
            'role_id' => $fca->id,
            'orden'=>3
        ]);
        DepartamentoTramite::create([
            'nombre'=>'Dirección General de Catastro',
            'alias' => 'dir catastro',
            'tipo' =>'dirección',
            'descripcion' => 'Dirección General de Catastro',
            'role_id' => $fdgc->id,
            'orden'=>4
        ]);
        DepartamentoTramite::create([
            'nombre'=>'Subdirección de Catastro',
            'alias' => 'subdir catastro',
            'tipo' =>'subdirección',
            'descripcion' => 'Subdirección de Catastro',
            'role_id' => $fsc->id,
            'orden'=>5
        ]);
	}

}