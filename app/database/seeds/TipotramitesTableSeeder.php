<?php

class TipotramitesTableSeeder extends Seeder {

	public function run()
	{
		$tt = Tipotramite::create([
			'nombre' => 'Valor catastral',
			'tiempo' => 8,
			'costodsmv' => 4,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
		$tt = Tipotramite::create([
			'nombre' => 'Registro de escritura',
			'tiempo' => 5,
			'costodsmv' => 0,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
		$tt = Tipotramite::create([
			'nombre' => 'Verificación de medidas',
			'tiempo' => 8,
			'costodsmv' => 0,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
		$tt = Tipotramite::create([
			'nombre' => 'Cancelación de cuenta',
			'tiempo' => 8,
			'costodsmv' => 0,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
		$tt = Tipotramite::create([
			'nombre' => 'Certificación de documentos',
			'tiempo' => 5,
			'costodsmv' => 2,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
		$tt = Tipotramite::create([
			'nombre' => 'Recurso de inconformidad',
			'tiempo' => 5,
			'costodsmv' => 0,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
		$tt = Tipotramite::create([
			'nombre' => 'Minuta de sesión de derecho de posesión',
			'tiempo' => 8,
			'costodsmv' => 0,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
		$tt = Tipotramite::create([
			'nombre' => 'Registro de títulos',
			'tiempo' => 8,
			'costodsmv' => 4,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
		$tt = Tipotramite::create([
			'nombre' => 'Nueva inscripción',
			'tiempo' => 8,
			'costodsmv' => 4,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
		$tt = Tipotramite::create([
			'nombre' => 'Manifestación de construcción por verificación de superficie',
			'tiempo' => 5,
			'costodsmv' => 0,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
		$tt = Tipotramite::create([
			'nombre' => 'Corrección de nombre',
			'tiempo' => 8,
			'costodsmv' => 0,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
		$tt = Tipotramite::create([
			'nombre' => 'Búsqueda de archivo',
			'tiempo' => 3,
			'costodsmv' => 2,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
		$tt = Tipotramite::create([
			'nombre' => 'Manifestación de construcción',
			'tiempo' => 5,
			'costodsmv' => 0,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		]);
	}

}