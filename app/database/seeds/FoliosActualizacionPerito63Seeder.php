<?php

class FoliosActualizacionPerito63Seeder extends Seeder 
{

	public function run() 
	{
		$conf =FoliosConf::first();

		$inputs['fecha_solicitud'] = '15-06-2015';
		$inputs['folio_catastro'] = '344' ;
		$inputs['cantidad_rusticos'] = 15;
		$inputs['cantidad_urbanos'] = 10;
		$inputs['fecha_oficio'] = '15-06-2015';
		$inputs['no_recibo'] = 'H644496';
		$inputs['perito_id'] = 63;

		//Extraigo solo el año del campo fecha solicitud.

		$year = explode('-',$inputs['fecha_solicitud']);

		$year = $year[2];

 		
		$nuevosfolios = new FoliosHistorial; 
		$folioscomprados = new FoliosComprados;
		$foliocatastro = $inputs['folio_catastro'];
		$vu=$inputs['cantidad_urbanos'];
		$vr=$inputs['cantidad_rusticos'];

		$nuevosfolios -> no_oficio = $foliocatastro;
		$nuevosfolios -> perito_id = $inputs['perito_id'];
		$nuevosfolios -> cantidad_urbanos = $vu;
		$nuevosfolios -> cantidad_rusticos = $vr;
		
		$totalurbano = ($vu*($conf->salario_folio_urbano*$conf->salario_minimo));
		$totalrustico = ($vr*($conf->salario_folio_rustico*$conf->salario_minimo));
		$vt= $totalurbano + $totalrustico;

		$nuevosfolios -> total_urbano = $totalurbano;
		$nuevosfolios -> total_rustico = $totalrustico;
		$nuevosfolios -> total = $vt;

		$ultimofoliou = 91;
		$folioinicialu = $ultimofoliou+1;
		$nuevosfolios -> folio_urbano_inicio = $folioinicialu;
		$foliofinalu = $ultimofoliou+$vu; 
		$nuevosfolios -> folio_urbano_final = $foliofinalu;

		while($folioinicialu<=$foliofinalu)
		{
			FoliosComprados::create([//agrega la lista numerica de folios a la tabla folios_comprados
				'perito_id' => $inputs['perito_id'],
				'numero_folio' => $folioinicialu,
				'tipo_folio' => "U",
				'entrega_municipal' => '0',
				'entrega_estatal' => '0',
				'no_oficio_historial' => $foliocatastro,
				'fecha_autorizacion' => $inputs['fecha_solicitud'],
				]);
			echo $folioinicialu;					
			$folioinicialu=$folioinicialu+1;
		}
				

		$ultimofolior = 165;
		$folioinicialr = $ultimofolior+1;
		$nuevosfolios -> folio_rustico_inicio = $folioinicialr;
		$foliofinalr = $ultimofolior+$vr; 
		$nuevosfolios -> folio_rustico_final = $foliofinalr;

		
		while($folioinicialr<=$foliofinalr)
		{
			FoliosComprados::create([
				'perito_id' => $inputs['perito_id'],
				'numero_folio' => $folioinicialr,
				'tipo_folio' => "R",
				'entrega_municipal' => '0',
				'entrega_estatal' => '0',
				'no_oficio_historial' => $foliocatastro,
				'fecha_autorizacion' => $inputs['fecha_solicitud'],
				]);			
			echo $folioinicialr;			
			$folioinicialr=$folioinicialr+1;
		}


		$nuevosfolios -> fecha_solicitud = $inputs['fecha_solicitud'];
		$nuevosfolios -> fecha_oficio = $inputs['fecha_oficio'];
		$nuevosfolios -> no_recibo = $inputs['no_recibo'];
		$nuevosfolios -> id_usuario = 2076;
		$nuevosfolios -> save();

		
	}

}