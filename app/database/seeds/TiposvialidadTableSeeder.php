<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class TiposvialidadTableSeeder extends Seeder {

	public function run()
	{

        $tipos = [
            1=> 'AMPLIACIÓN',
            2=> 'ANDADOR',
            3=> 'AVENIDA',
            4=> 'BOULEVARD',
            5=> 'CALLE',
            6=> 'CALLEJÓN',
            7=> 'CALZADA',
            8=> 'CERRADA',
            9=> 'CIRCUITO',
            10=> 'CIRCUNVALACIÓN',
            11=> 'CONTINUACIÓN',
            12=> 'CORREDOR',
            13=> 'DIAGONAL',
            14=> 'EJE VIAL',
            15=> 'PASAJE',
            16=> 'PEATONAL',
            17=> 'PERIFÉRICO',
            18=> 'PRIVADA',
            19=> 'PROLONGACIÓN',
            20=> 'RETORNO',
            21=> 'VIADUCTO',
            22=> 'NINGUNO'
        ];

		foreach($tipos as $id => $tipo)
		{
            DB::table('tiposvialidad')->insert([
                'id' => $id,
                'descripcion' => $tipo
            ]);
		}
	}
}