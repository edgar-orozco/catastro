<?php

class folios_EntregaFoliosController extends BaseController {

	public function entregafoliosestatal(){ //muestra todos los peritos

		$variableperito = Perito::where('Estado', 1)
						->get();
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

		$fe = FoliosComprados:: SELECT('tipo_folio',
			DB::raw('Max(fecha_entrega_e) as fecha' ),
			DB::raw('Sum(entrega_estatal) as entrega'))
		->where('perito_id', $perito->id)
		->groupBy('tipo_folio')
		->orderBy('tipo_folio', 'DESC')
		->get();

		return View::make('folios.entregafoliose.detalles')
		->withPerito($perito)
		->withFu($fu)
		->withFr($fr)
		->withFh($fh)
		->withFe($fe);
	}

	public function get_urbanose($id = null){ //muestra todos los folios Urbanos del perito especificado
		if(Input::get('year'))
		{
			$YEAR = Input::get('year');
		}
		else
		{
			$YEAR = date('Y');
		}

		$selectYear = ['' => '--seleccione un año--'] + FoliosComprados::distinct()->select(DB::raw("date_part('year', fecha_autorizacion) as year"))->orderBy('year', 'DESC')->lists('year', 'year');
		
		$perito = Perito::find($id);

		$fu = FoliosComprados::where('perito_id', $perito->id)
		->where('tipo_folio', 'U')
		->whereRaw("EXTRACT(YEAR FROM fecha_autorizacion) = ". $YEAR)
		->get();

		return View::make('folios.entregafoliose.urbanos', ['selectYear' => $selectYear])
		->withFu($fu)
		->withPerito($perito);
	}

	public function get_rusticose($id = null){ //muestra todos los folios Rusticos del perito especificado
		if(Input::get('year'))
		{
			$YEAR = Input::get('year');
		}
		else
		{
			$YEAR = date('Y');
		}

		$selectYear = ['' => '--seleccione un año--'] + FoliosComprados::distinct()->select(DB::raw("date_part('year', fecha_autorizacion) as year"))->orderBy('year', 'DESC')->lists('year', 'year');
		

		$perito = Perito::find($id);

		$fr = FoliosComprados::where('perito_id', $perito->id)
		->where('tipo_folio', 'R')
		->whereRaw("EXTRACT(YEAR FROM fecha_autorizacion) = ". $YEAR)
		->get();

		return View::make('folios.entregafoliose.rusticos', ['selectYear' => $selectYear])
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


	public function desestador($id){

		$folio = FoliosComprados::where('id', $id)
		->first();

		$f = FoliosComprados::find($folio->id);
		$f->entrega_estatal = 0;
		$f->usuario_id = Null;
		$f->fecha_entrega_e = Null;
		$f->save();

		return Redirect::to('/entregafoliose/rusticos/'. $folio->perito_id);
	}


	public function desestadou($id){

		$folio = FoliosComprados::where('id', $id)
		->first();

		$f = FoliosComprados::find($folio->id);
		$f->entrega_estatal = 0;
		$f->usuario_id = Null;
		$f->fecha_entrega_e = Null;
		$f->save();

		return Redirect::to('/entregafoliose/urbanos/'.$folio->perito_id);
	}


	public function entregafoliosmunicipal(){ //muestra todos los peritos

		$variableperito = Perito::where('Estado', 1)
						->get();

		return View::make('folios.entregafoliosm.entregafoliosmunicipal', ['variableperito' => $variableperito]);
	}

	public function get_urbanosm($id){ //muestra todos los folios Urbanos del perito especificado

		if(Input::get('year'))
		{
			$YEAR = Input::get('year');
		}
		else
		{
			$YEAR = date('Y');
		}

		$selectYear = ['' => '--seleccione un año--'] + FoliosComprados::distinct()->select(DB::raw("date_part('year', fecha_autorizacion) as year"))->orderBy('year', 'DESC')->lists('year', 'year');
		

		$perito = Perito::find($id);

		$fu = FoliosComprados::where('perito_id', $perito->id)
		->where('tipo_folio', 'U')
		->whereRaw("EXTRACT(YEAR FROM fecha_autorizacion) = ". $YEAR)
		->get();

		return View::make('folios.entregafoliosm.urbanos', ['selectYear' => $selectYear])
		->withFu($fu)
		->withPerito($perito);
	}

	public function get_rusticosm($id){ //muestra todos los folios Rusticos del perito especificado

		if(Input::get('year'))
		{
			$YEAR = Input::get('year');
		}
		else
		{
			$YEAR = date('Y');
		}

		$selectYear = ['' => '--seleccione un año--'] + FoliosComprados::distinct()->select(DB::raw("date_part('year', fecha_autorizacion) as year"))->orderBy('year', 'DESC')->lists('year', 'year');
		

		$perito = Perito::find($id);

		$fr = FoliosComprados::where('perito_id', $perito->id)
		->where('tipo_folio', 'R')
		->whereRaw("EXTRACT(YEAR FROM fecha_autorizacion) = ". $YEAR)
		->get();

		return View::make('folios.entregafoliosm.rusticos', ['selectYear' => $selectYear])
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



	public function desmunicipior($id){

		$folio = FoliosComprados::where('id', $id)
		->first();

		$f = FoliosComprados::find($folio->id);
		$f->entrega_municipal = 0;
		$f->municipio_id = Null;
		$f->fecha_entrega_m = Null;
		$f->save();

		return Redirect::to('/entregafoliose/rusticos/'.$folio->perito_id);
	}


	public function desmunicipiou($id){

		$folio = FoliosComprados::where('id', $id)
		->first();

		$f = FoliosComprados::find($folio->id);
		$f->entrega_municipal = 0;
		$f->municipio_id = Null;
		$f->fecha_entrega_m = Null;
		$f->save();

		return Redirect::to('/entregafoliose/urbanos/'.$folio->perito_id);
	}

}