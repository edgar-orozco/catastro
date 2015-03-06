<?php

class folios_EntregaFoliosController extends BaseController {




	protected $por_pagina = 10;



	

	public function entregafoliosestatal(){ //muestra todos los peritos

		$variableperito = Perito::all();
		return View::make('folios.entregafoliose.entregafoliosestatal', ['variableperito' => $variableperito]);
	}
		
	public function detalles($id){ //detalles de la compra de folios por perito

		$perito = Perito::find($id);

		$fu = FoliosComprados::where('perito_id', $perito->id)
		->where('tipo_folio', 'U')
		->orderBy('numero_folio', 'DESC')
		->first();

		$fr = FoliosComprados::where('perito_id', $perito->id)
		->where('tipo_folio', 'R')
		->orderBy('numero_folio', 'DESC')
		->first();

		$fh = FoliosHistorial::where('perito_id', $perito->id)
		->get();

		return View::make('folios.entregafoliose.detalles')
		->withPerito($perito)
		->withFu($fu)
		->withFr($fr)
		->withFh($fh);
	}

	public function get_urbanose($id){ //muestra todos los folios Urbanos del perito especificado

		$perito = Perito::find($id);

		$fu = FoliosComprados::where('perito_id', $perito->id)
		->where('tipo_folio', 'U')
		->get();

		return View::make('folios.entregafoliose.urbanos')
		->withFu($fu)
		->withPerito($perito);
	}

	public function get_rusticose($id){ //muestra todos los folios Rusticos del perito especificado

		$perito = Perito::find($id);

		$fr = FoliosComprados::where('perito_id', $perito->id)
		->where('tipo_folio', 'R')
		->get();

		return View::make('folios.entregafoliose.rusticos')
		->withFr($fr)
		->withPerito($perito);
	}

	public function post_foliose($id){ //marca los folios utilizados por los peritos

		$inputs = Input::all();

		if(isset($inputs['urbanos'])){

			for($a=0; $a<sizeof($inputs['urbanos']); $a++){

				$folio = FoliosComprados::where('tipo_folio', 'U')
				->where('numero_folio', $inputs['urbanos'][$a])
				->where('perito_id', $id)
				->first();

				$f = FoliosComprados::find($folio->id);
				$f->entrega_estatal = 1;
				$f->usuario_id = Auth::id();
				$f->fecha_entrega_e = date("Y-m-d");
				$f->save();
			}
		}

		if(isset($inputs['rusticos'])){

			for($a=0; $a<sizeof($inputs['rusticos']); $a++){

				$folio = FoliosComprados::where('tipo_folio', 'R')
				->where('numero_folio', $inputs['rusticos'][$a])
				->where('perito_id', $id)
				->first();

				$f = FoliosComprados::find($folio->id);
				$f->entrega_estatal = 1;
				$f->usuario_id = Auth::id();
				$f->fecha_entrega_e = date("Y-m-d");
				$f->save();
			}
		}

		return Redirect::to('/entregafoliosestatal');
	}

	public function entregafoliosmunicipal(){ //muestra todos los peritos

		$variableperito = Perito::all();
		return View::make('folios.entregafoliosm.entregafoliosmunicipal', ['variableperito' => $variableperito]);
	}

	public function get_urbanosm($id){ //muestra todos los folios Urbanos del perito especificado

		$perito = Perito::find($id);

		$fu = FoliosComprados::where('perito_id', $perito->id)
		->where('tipo_folio', 'U')
		->get();

		return View::make('folios.entregafoliosm.urbanos')
		->withFu($fu)
		->withPerito($perito);
	}

	public function get_rusticosm($id){ //muestra todos los folios Rusticos del perito especificado

		$perito = Perito::find($id);

		$fr = FoliosComprados::where('perito_id', $perito->id)
		->where('tipo_folio', 'R')
		->get();

		return View::make('folios.entregafoliosm.rusticos')
		->withFr($fr)
		->withPerito($perito);
	}

	public function post_foliosm($id){ //marca los folios utilizados por los peritos

		$inputs = Input::all();

		if(isset($inputs['urbanos'])){

			for($a=0; $a<sizeof($inputs['urbanos']); $a++){

				$folio = FoliosComprados::where('tipo_folio', 'U')
				->where('numero_folio', $inputs['urbanos'][$a])
				->where('perito_id', $id)
				->first();

				$f = FoliosComprados::find($folio->id);
				$f->entrega_municipal = 1;
				$f->municipio_id= Auth::user()->municipio_id;
				$f->fecha_entrega_m = date("Y-m-d");
				$f->save();
			}
		}

		if(isset($inputs['rusticos'])){

			for($a=0; $a<sizeof($inputs['rusticos']); $a++){

				$folio = FoliosComprados::where('tipo_folio', 'R')
				->where('numero_folio', $inputs['rusticos'][$a])
				->where('perito_id', $id)
				->first();

				$f = FoliosComprados::find($folio->id);
				$f->entrega_municipal = 1;
				$f->municipio_id= Auth::user()->municipio_id;
				$f->fecha_entrega_m = date("Y-m-d");
				$f->save();
			}
		}

		return Redirect::to('/entregafoliosmunicipal');
	}
}