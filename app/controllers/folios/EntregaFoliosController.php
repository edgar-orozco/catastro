<?php

class folios_EntregaFoliosController extends BaseController {

	public function entregafoliosestatal(){ //muestra todos los peritos

		$variableperito = Perito::All();
		return View::make('folios.entregafoliose.entregafoliosestatal', ['variableperito' => $variableperito]);
	}
		
	public function detalles($id){ //detalles de la compra de folios por perito

		$perito = Perito::find($id);

		$fu = FoliosComprados::detallesFC($perito->id, 'U');

		$fr = FoliosComprados::detallesFC($perito->id, 'R');

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

		DB::getQueryLog();

		return View::make('folios.entregafoliose.detalles')
		->withPerito($perito)
		->withFu($fu)
		->withFr($fr)
		->withFh($fh)
		->withFe($fe);
	}

	public function get_urbanose($id = null){ //muestra todos los folios Urbanos del perito especificado
		$paginate = Input::get('pagina', '15');
		if(Input::get('year'))
		{
			$YEAR = Input::get('year');
		}
		else
		{
			$YEAR = date('Y');
		}

		$perito = Perito::find($id);
		
		$selectYear = ['' => '--seleccione un año--'] + FoliosComprados::distinct()->select(DB::raw("date_part('year', fecha_autorizacion) as year"))->where('perito_id', $perito->id)->orderBy('year', 'DESC')->lists('year', 'year');
		

		$fu = FoliosComprados::getEntregaM($id,'U',$YEAR,$paginate);
		return View::make('folios.entregafoliose.urbanos', ['selectYear' => $selectYear])
		->withFu($fu)
		->withYear($YEAR)
		->withPerito($perito);
	}

	public function get_rusticose($id = null){ //muestra todos los folios Rusticos del perito especificado
		


		$paginate = Input::get('pagina', '15');
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

		$fr = FoliosComprados::getEntregaM($id,'R',$YEAR,$paginate);
		return View::make('folios.entregafoliose.rusticos', ['selectYear' => $selectYear])
		->withFr($fr)
		->withYear($YEAR)
		->withPerito($perito);
	}

	public function get_datatablePaginateEstatal()
    {
        $id = Input::get('id');
        $tipo_folio = Input::get('tipo_folio');
        $perito = Perito::find($id);
        $paginate = Input::get('pagina', '15');
        $year = Input::get('year', date('Y'));

        $fr = FoliosComprados::getEntregaM($id, $tipo_folio, $year, $paginate);

        if($tipo_folio=="U")
        {
	        return View::make('folios.entregafoliose.tablaAjaxU')
	        ->withFu($fr)
	        ->withPerito($perito)
	        ->render();
        }
        else if($tipo_folio=="R")
        {
	        return View::make('folios.entregafoliose.tablaAjax')
	        ->withFr($fr)
	        ->withPerito($perito)
	        ->withYear($year)
	        ->render();
	    }

    }

	public function post_foliose($id)
	{ //marca los folios utilizados por los peritos
		$paginate = Input::get('pagina', '15');
		$tipo_folio = Input::get('tipo_folio');
		$inputs = Input::all();

		if(isset($inputs['urbanos'])){

			for($a=0; $a<sizeof($inputs['urbanos']); $a++){

				$folio = FoliosComprados::where('tipo_folio', 'U')
				->where('numero_folio', $inputs['urbanos'][$a])
				->where('perito_id', $id)
				->whereRaw("EXTRACT(YEAR FROM fecha_autorizacion) = ". $inputs['year'])
				->first();

				$f = FoliosComprados::find($folio->id);
				$f->entrega_estatal = 1;
				$f->usuario_id = Auth::id();
				$f->fecha_entrega_e = date("Y-m-d");
				$f->save();
			}
		}

		
		if(isset($inputs['rusticos']))
		{

			for($a=0; $a<sizeof($inputs['rusticos']); $a++)
			{

				$folio = FoliosComprados::where('tipo_folio', 'R')
				->where('numero_folio', $inputs['rusticos'][$a])
				->where('perito_id', $id)
				->whereRaw("EXTRACT(YEAR FROM fecha_autorizacion) = ". $inputs['year'])
				->first();

				$f = FoliosComprados::find($folio->id);
				$f->entrega_estatal = 1;
				$f->usuario_id = Auth::id();
				$f->fecha_entrega_e = date("Y-m-d");
				$f->save();
			}
		}


		$fr = FoliosComprados::getEntregaM($id, $tipo_folio, null, $paginate);

		if($tipo_folio=="U")
        {
	        return View::make('folios.entregafoliose.tablaAjaxU')
	        ->withFu($fr)
	        ->withYear($inputs['year'])
	        ->render();
        }
        else if($tipo_folio=="R")
        {
	        return View::make('folios.entregafoliose.tablaAjax')
		        ->withFr($fr)
		        ->withYear($inputs['year'])
		        ->render();
        }
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

		$variableperito = Perito::All();

		return View::make('folios.entregafoliosm.entregafoliosmunicipal', ['variableperito' => $variableperito]);
	}

	public function get_urbanosm($id){ //muestra todos los folios Urbanos del perito especificado
		$paginate = Input::get('pagina', '15');
		
		$YEAR = Input::get('year', 2015);




		$selectYear = ['' => '--seleccione un año--'] + FoliosComprados::distinct()->select(DB::raw("date_part('year', fecha_autorizacion) as year"))->orderBy('year', 'DESC')->lists('year', 'year');
		

		$perito = Perito::find($id);

		$fu = FoliosComprados::getEntregaM($id,'U',$YEAR,$paginate);
		return View::make('folios.entregafoliosm.urbanos', ['selectYear' => $selectYear])
		->withFu($fu)
		->withYear($YEAR)
		->withPerito($perito);
	}

	public function get_rusticosm($id){ //muestra todos los folios Rusticos del perito especificado

		$paginate = Input::get('pagina', '15');
		
		$YEAR = Input::get('year', 2015);

		$selectYear = ['' => '--seleccione un año--'] + FoliosComprados::distinct()->select(DB::raw("date_part('year', fecha_autorizacion) as year"))->orderBy('year', 'DESC')->lists('year', 'year');
		

		$perito = Perito::find($id);

		$fr = FoliosComprados::getEntregaM($id,'R',$YEAR,$paginate);
		return View::make('folios.entregafoliosm.rusticos', ['selectYear' => $selectYear])
		->withFr($fr)
		->withYear($YEAR)
		->withPerito($perito);
	}

	public function get_datatablePaginate()
    {
        $id = Input::get('id');
        $tipo_folio = Input::get('tipo_folio');
        $perito = Perito::find($id);
        $paginate = Input::get('pagina', '15');
        $year = Input::get('year', 2015);

        $fr = FoliosComprados::getEntregaM($id, $tipo_folio, $year, $paginate);

        if($tipo_folio=="U")
        {
	        return View::make('folios.entregafoliosm.tablaAjaxU')
	        ->withFu($fr)
	        ->withPerito($perito)
	        ->withYear($year)
	        ->render();
        }
        else if($tipo_folio=="R")
        {
	        return View::make('folios.entregafoliosm.tablaAjax')
	        ->withFr($fr)
	        ->withPerito($perito)
	        ->withYear($year)
	        ->render();
	    } 
    }

	public function buscarFolioEstatal()
	{
		$paginate = Input::get('pagina', '15');
		$corevat =  strtoupper(Input::get('buscar'));
        $id_perito = Input::get('id');
        $tipo_folio = Input::get('tipo_folio');

        $fr = FoliosComprados::buscarCorevat($corevat, $id_perito, $tipo_folio)
        ->orderBy('numero_folio', 'ASC')
		->orderBy('fecha_autorizacion', 'DESC')
        ->paginate($paginate);

        if($tipo_folio=="U")
        {
        	return View::make('folios.entregafoliose.tablaAjaxU')->withFu($fr);
        }
        else if($tipo_folio=="R")
        {
            return View::make('folios.entregafoliose.tablaAjax')->withFr($fr);
        }
	}

		public function buscarFolio()
	{
		$paginate = Input::get('pagina', '15');
		$corevat =  strtoupper(Input::get('buscar'));
        $id_perito = Input::get('id');
        $tipo_folio = Input::get('tipo_folio');

        $fr = FoliosComprados::buscarCorevat($corevat, $id_perito, $tipo_folio)
        ->orderBy('numero_folio', 'ASC')
		->orderBy('fecha_autorizacion', 'DESC')
        ->paginate($paginate);
        if($tipo_folio=="U")
        {
        	        return View::make('folios.entregafoliosm.tablaAjaxU')->withFu($fr);
        }
        else if($tipo_folio=="R")
        {
        	        return View::make('folios.entregafoliosm.tablaAjax')->withFr($fr);
        }
	}

	public function post_foliosm($id)
	{ //marca los folios utilizados por los peritos
		$paginate = Input::get('pagina', '15');
		$tipo_folio = Input::get('tipo_folio');
		$inputs = Input::all();
		$user_id = Auth::user()->id;
		$mun_id = DB::select("select municipio_id from user_municipio where usuario_id = $user_id");
		if(isset($inputs['urbanos']))
		{

			for($a=0; $a<sizeof($inputs['urbanos']); $a++){

				$folio = FoliosComprados::where('tipo_folio', 'U')
				->where('numero_folio', $inputs['urbanos'][$a])
				->where('perito_id', $id)
				->whereRaw("EXTRACT(YEAR FROM fecha_autorizacion) = ". $inputs['year'])
				->first();

				$f = FoliosComprados::find($folio->id);
				$f->entrega_municipal = 1;
				$f->municipio_id= $mun_id[0]->municipio_id;
				$f->fecha_entrega_m = date("Y-m-d");
				$f->save();
			}
		}

		if(isset($inputs['rusticos']))
		{
			for($a=0; $a<sizeof($inputs['rusticos']); $a++)
			{
				$folio = FoliosComprados::where('tipo_folio', 'R')
				->where('numero_folio', $inputs['rusticos'][$a])
				->where('perito_id', $id)
				->whereRaw("EXTRACT(YEAR FROM fecha_autorizacion) = ". $inputs['year'])
				->first();

				$f = FoliosComprados::find($folio->id);
				$f->entrega_municipal = 1;
				$f->municipio_id= $mun_id[0]->municipio_id;
				$f->fecha_entrega_m = date("Y-m-d");
				$f->save();
			}
		}

		$fr = FoliosComprados::getEntregaM($id, $tipo_folio, $inputs['year'], $paginate);

		if($tipo_folio=="U")
        {
	        return View::make('folios.entregafoliosm.tablaAjaxU')
	        ->withFu($fr)
	        ->withYear($inputs['year'])
	        ->render();
        }
        else if($tipo_folio=="R")
        {
	        return View::make('folios.entregafoliosm.tablaAjax')
		        ->withFr($fr)
		        ->withYear($inputs['year'])
		        ->render();
        }

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