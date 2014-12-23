<?php

/**
 * Class RequisitosTableSeeder
 * Genera los registros del catálogo de requisitos
 */
class RequisitosTableSeeder extends Seeder {

	public function run()
	{

		Requisito::create([
			'nombre' => 'Boleta de último pago predial',
			'tipo' => 'Documento',
			'descripcion' => 'Boleta con sello de pago',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);

		Requisito::create([
			'nombre' => 'Plano a escala con cuadro de construcción',
			'tipo' => 'Plano',
			'descripcion' => 'Plano a escala emitido por despacho o arquitecto autorizado',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);

		Requisito::create([
			'nombre' => 'Solicitud de valor catastral',
			'tipo' => 'Documento',
			'descripcion' => 'Solicitud',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Recibo de pago de derechos',
			'tipo' => 'Documento',
			'descripcion' => 'Recibo con sello del banco o entidad autorizada para recibir pago',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Escritura',
			'tipo' => 'Documento',
			'descripcion' => 'Escritura del predio',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Plano sellado',
			'tipo' => 'Plano',
			'descripcion' => 'Plano con sello',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Traslado de dominio',
			'tipo' => 'Documento',
			'descripcion' => 'Traslado',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Declaración de traslado de dominio',
			'tipo' => 'Documento',
			'descripcion' => 'Declaración de traslado',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Boleta de pago de traslado de dominio',
			'tipo' => 'Documento',
			'descripcion' => 'Boleta de pago con sello de caja',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Valor catastral',
			'tipo' => 'Documento',
			'descripcion' => 'Documento de valor catastral',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Certificado de libertad de gravamen',
			'tipo' => 'Certificado',
			'descripcion' => 'Certificado de libertad de gravamen',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Solicitud de gestión catastral',
			'tipo' => 'Solicitud',
			'descripcion' => 'Solicitud de la gestión',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Credencial de elector',
			'tipo' => 'Identificación',
			'descripcion' => 'Credencial INE',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Pago de derechos',
			'tipo' => 'Pago',
			'descripcion' => 'Boleta o recibo del pago de derechos',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Minuta certificada',
			'tipo' => 'Minuta',
			'descripcion' => 'Minuta certificada',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Manifestación del predio',
			'tipo' => 'Manifestación',
			'descripcion' => 'Manifestación',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Título',
			'tipo' => 'Título',
			'descripcion' => 'Título',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Constancia de posesión certificada',
			'tipo' => 'Constancia',
			'descripcion' => 'Constancia certificada',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Constancia de residencia',
			'tipo' => 'Constancia',
			'descripcion' => 'Constancia',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
		Requisito::create([
			'nombre' => 'Manifestación de construcción',
			'tipo' => 'Manifestación',
			'descripcion' => 'Manifestación',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		]);
	}

}