<?php

class folios_FoliosController extends BaseController {

	public function nfolios(){ //formulario para nuevos folios

		$noperito = Perito::where('Estado', 1)->orderBy('corevat')
		->get();

		return View::make('folios.folios.nfolios')->withPeritos($noperito);
	}

	public function nfolioscreate(){ //acciones para guardar los nuevos folios en las tablas

		$conf =FoliosConf::first();

		$inputs = Input::all();

		$reglas = [
		'numero_oficio'	=>	'required|integer',
		'cantidad_rusticos'	=>	'required|min:0|integer',
		'cantidad_urbanos'	=>	'required|min:0|integer',
		'fecha_solicitud'	=>	'required|date',
		'fecha_oficio'		=>	'required|date',
		'no_recibo'			=>	'required',
		'perito_id' 		=>	'required'
		];

		$messages =
		[
			'required' => 'El campo :attribute es requerido.',
			'date' => 'El campo :attribute no tiene un formato de fecha valido.',
			'integer' => 'El campo :attribute debe de ser un numero entero.'
		];

		$validar = Validator::make($inputs, $reglas, $messages);

		if($validar->fails())
		{
			return Redirect::back()->withErrors($validar)->withInput(Input::All());
		} else {
		
			//Extraigo solo el año del campo fecha solicitud.

			$year = explode('-',$inputs['fecha_solicitud']);

			$year = $year[2];

			$nuevosfolios = new FoliosHistorial; 
			$folioscomprados = new FoliosComprados;
			$foliocatastro = Input::get('numero_oficio');
			$vu=Input::get('cantidad_urbanos');
			$vr=Input::get('cantidad_rusticos');

			$nuevosfolios -> no_oficio = $foliocatastro;
			$nuevosfolios -> perito_id = Input::get('perito_id');
			$nuevosfolios -> cantidad_urbanos = $vu;
			$nuevosfolios -> cantidad_rusticos = $vr;
			
			$totalurbano = ($vu*($conf->salario_folio_urbano*$conf->salario_minimo));
			$totalrustico = ($vr*($conf->salario_folio_rustico*$conf->salario_minimo));
 			$vt= $totalurbano + $totalrustico;

 			$nuevosfolios -> total_urbano = $totalurbano;
 			$nuevosfolios -> total_rustico = $totalrustico;
			$nuevosfolios -> total = $vt;
	
			//Trae la ultima compra de rustico del perito solicitado, tomando en cuenta el año de la compra.
			$compraperitourbano = FoliosHistorial::where('perito_id', Input::get('perito_id'))->whereRaw("EXTRACT(YEAR FROM fecha_solicitud) = ". $year)->orderBy('folio_urbano_final','DESC')->first(); 

			
			//$consulta = FoliosHistorial::all()->last();
			//$id = $consulta->id+1; 

			if($compraperitourbano) //EXISTE ELPERITO EN LA LISTA?
			{
				if($vu!=0) //VA A COMPRAR FOLIOS URBANOS
				{
					$ultimofoliou = $compraperitourbano->folio_urbano_final;
					$folioinicialu = $ultimofoliou+1;
					$nuevosfolios -> folio_urbano_inicio = $folioinicialu;
					$foliofinalu = $ultimofoliou+$vu; 
					$nuevosfolios -> folio_urbano_final = $foliofinalu;

					while($folioinicialu<=$foliofinalu)
					{
						FoliosComprados::create([//agrega la lista numerica de folios a la tabla folios_comprados
							'perito_id' => Input::get('perito_id'),
							'numero_folio' => $folioinicialu,
							'tipo_folio' => "U",
							'entrega_municipal' => '0',
							'entrega_estatal' => '0',
							'no_oficio_historial' => $foliocatastro,
							'fecha_autorizacion' => Input::get('fecha_solicitud'),
							]);						
						$folioinicialu=$folioinicialu+1;
					}
				}
				else //no va a comprar folios urbanos
				{
					//los valores de los folios no cambiaran por que no esta comprando folios urbanos
					$nuevosfolios -> folio_urbano_inicio = 0;
					$nuevosfolios -> folio_urbano_final = 0;
				}
			}
			else //No existe el perito en la lista de folios
			{
				if($vu!=0) //va a comprar por primera vez folios urbanos
				{
					$nuevosfolios -> folio_urbano_inicio = 1;
					$foliofinalu = $vu; 
					$nuevosfolios -> folio_urbano_final = $foliofinalu;

					$i=1;
					while($i<=$vu)
					{
						FoliosComprados::create([ //agrega la lista numerica de folios a la tabla folios_comprados
							'perito_id' => Input::get('perito_id'),
							'numero_folio' => $i,
							'tipo_folio' => "U",
							'entrega_municipal' => '0',
							'entrega_estatal' => '0',
							'no_oficio_historial' => $foliocatastro,
							'fecha_autorizacion' => Input::get('fecha_solicitud'),
							]);						
						$i=$i+1;
					}
				}
				else //no va a comprar folios urbanos
				{
					$nuevosfolios-> folio_urbano_inicio=0;
					$nuevosfolios-> folio_urbano_final=0;
				}
			}
			
			//Trae la ultima compra de rustico del perito solicitado, tomando en cuenta el año de la compra.
			$compraperitorustico = FoliosHistorial::where('perito_id', Input::get('perito_id'))->whereRaw("EXTRACT(YEAR FROM fecha_solicitud) = ". $year)->orderBy('folio_rustico_final','DESC')->first(); 
			
			//$consulta = FoliosHistorial::all()->last();
			//$id = $consulta->id+1; 

			if($compraperitorustico)
			{
				if($vr!=0) //va a comprar folios rusticos
				{
					$ultimofolior = $compraperitorustico->folio_rustico_final;
					$folioinicialr = $ultimofolior+1;
					$nuevosfolios -> folio_rustico_inicio = $folioinicialr;
					$foliofinalr = $ultimofolior+$vr; 
					$nuevosfolios -> folio_rustico_final = $foliofinalr;

					
					while($folioinicialr<=$foliofinalr)
					{
						FoliosComprados::create([
							'perito_id' => Input::get('perito_id'),
							'numero_folio' => $folioinicialr,
							'tipo_folio' => "R",
							'entrega_municipal' => '0',
							'entrega_estatal' => '0',
							'no_oficio_historial' => $foliocatastro,
							'fecha_autorizacion' => Input::get('fecha_solicitud'),
							]);						
						$folioinicialr=$folioinicialr+1;
					}
				}
				else //no va a comprar folios rusticos
				{
					$nuevosfolios -> folio_rustico_inicio = 0;
					$nuevosfolios -> folio_rustico_final = 0;
				}
			}
			else
			{
				if($vr!=0) //va a comprar folios rusticos por primera vez
				{
					$nuevosfolios -> folio_rustico_inicio = 1;
					$foliofinalr = $vr; 
					$nuevosfolios -> folio_rustico_final = $foliofinalr;

					$i=1;
					while($i<=$vr)
					{
						FoliosComprados::create([
							'perito_id' => Input::get('perito_id'),
							'numero_folio' => $i,
							'tipo_folio' => "R",
							'entrega_municipal' => '0',
							'entrega_estatal' => '0',
							'no_oficio_historial' => $foliocatastro,
							'fecha_autorizacion' => Input::get('fecha_solicitud'),
							]);						
						$i=$i+1;
					}
				}
				else //no va a comprar folios rusticos
				{
					$nuevosfolios -> folio_rustico_inicio =0;
					$nuevosfolios -> folio_rustico_final =0;
				}
			}

			$nuevosfolios -> fecha_solicitud = Input::get('fecha_solicitud');
			$nuevosfolios -> fecha_oficio = Input::get('fecha_oficio');
			$nuevosfolios -> no_recibo = Input::get('no_recibo');
			$nuevosfolios -> id_usuario = Auth::id();
			$nuevosfolios -> save();

			return Redirect::to('/nfolios/formato/'.$nuevosfolios->id);
		}
	}
	
	public function foliosemitidos(){ //muestra todos los folios que se han vendido 

		if(Input::get('year'))
		{
			$YEAR = Input::get('year');
		}
		else
		{
			$YEAR = date('Y');
		}

		$selectYear = ['' => '--seleccione un año--'] + FoliosHistorial::distinct()->select(DB::raw("date_part('year', fecha_solicitud) as year"))->orderBy('year', 'DESC')->lists('year', 'year');
		//dd($selectYear);

		$femitidos = FoliosHistorial::whereRaw("EXTRACT(YEAR FROM fecha_solicitud) = ". $YEAR)
		->get();
		
		return View::make('folios.folios.foliosemitidos', ['femitidos' => $femitidos, 'selectYear' => $selectYear]);
	}

	public function formato($id){ //formato PDF de la venta de folios

		$conf = FoliosConf::first();

		$folios_historial = FoliosHistorial::where('id',$id)->first(); 

		$year = strtotime($folios_historial->fecha_oficio);

		$year = date('y', $year);

		$year2 = date('Y', $year);

		$datos_perito = Perito::where('id', $folios_historial->perito_id)->first();

		$vista = View::make('folios.folios.formato', ['conf'=>$conf,'folios_historial'=>$folios_historial,'datos_perito'=>$datos_perito, 'year' => $year, 'year2' => $year2]);

		$pdf = PDF::load($vista)->show();
		//load(variable, tamaño de hoja, orientacion landscape)
		$response = Response::make($pdf, 200);
		$response->header('Content-Type', 'application/pdf');
		return $response;
	}

	public function eliminarFolios ($id){ //elimina los folios generados
		
		$eliminar_folio = FoliosComprados::where('no_oficio_historial', '=', $id);
		$eliminar_folio->delete();
		$eliminar_folio = FoliosHistorial::where('no_oficio', '=', $id);
		$eliminar_folio->delete();
		return Redirect::back();
	}

	public function reporteperito(){

		$conf=FoliosConf::all()->first();

		$folios_historial=FoliosHistorial::select('perito_id',
											DB::raw('Max(folio_urbano_final) as folio_urbano_final'),
											DB::raw('Max(folio_rustico_final) as folio_rustico_final'))
											->distinct()
											->groupBy('perito_id')
											->orderBy('perito_id')
											->get();
		$folios_totales=FoliosHistorial::select(
											DB::raw('Sum(cantidad_urbanos) as folios_urbanos'),
											DB::raw('Sum(cantidad_rusticos) as folios_rusticos'),
											DB::raw('Sum(total_urbano) as total_urbano'),
											DB::raw('Sum(total_rustico) as total_rustico'),
											DB::raw('Sum(total) as total'))
											->get();

		$entrega_estatal=FoliosComprados::where('entrega_estatal', 1)->count();


	
		return View::make('folios.folios.reporteperito')
							->withFolios_historial($folios_historial)
							->withFolios_totales($folios_totales)
							->withEntrega_estatal($entrega_estatal)
							->withConf($conf);		
	}

	public function formatoreporteperito(){

		$conf=FoliosConf::all()->first();

		$folios_historial=FoliosHistorial::select('perito_id',
											DB::raw('Max(folio_urbano_final) as folio_urbano_final'),
											DB::raw('Max(folio_rustico_final) as folio_rustico_final'))
											->distinct()
											->groupBy('perito_id')
											->orderBy('perito_id')
											->get();

		$folios_totales=FoliosHistorial::select(
											DB::raw('Sum(cantidad_urbanos) as folios_urbanos'),
											DB::raw('Sum(cantidad_rusticos) as folios_rusticos'),
											DB::raw('Sum(total_urbano) as total_urbano'),
											DB::raw('Sum(total_rustico) as total_rustico'),
											DB::raw('Sum(total) as total'))
											->get();

		$vista= View::make('folios.folios.formatoreporteperito')->withFolios_historial($folios_historial)->withFolios_totales($folios_totales)->withConf($conf);	

		$pdf = PDF::load($vista)->show();
		//load(variable, tamaño de hoja, orientacion landscape)
		$response = Response::make($pdf, 200);
		$response->header('Content-Type', 'application/pdf');
		return $response;
		
	}

	public function formatoreporteperito2()
	{
		$peritos = Perito::orderBy('corevat', 'ASC')->get();

		$vista= View::make('folios.folios.formatoreporteperito2')->withPeritos($peritos);	

		$pdf = PDF::load($vista)->show();
		//load(variable, tamaño de hoja, orientacion landscape)
		$response = Response::make($pdf, 200);
		$response->header('Content-Type', 'application/pdf');
		return $response;
		
	}
		
	
	public function reportetotal(){
		$folios_historial=FoliosHistorial::select(
											DB::raw('MAX(fecha_oficio) as fecha_oficio'),
											DB::raw('EXTRACT(YEAR FROM fecha_oficio) as year'),
											DB::raw('Sum(cantidad_urbanos) as folios_urbanos'),
											DB::raw('Sum(cantidad_rusticos) as folios_rustico'),
											DB::raw('Sum(total_urbano) as total_urbano'),
											DB::raw('Sum(total_rustico) as total_rustico'),
											DB::raw('Sum(total) as total'))
											->groupBy('year')
											->get();

		return View::make('folios.folios.reportetotal')->withFolios_historial($folios_historial);
	}
	
	public function formatoreportetotal(){
		$folios_historial=FoliosHistorial::select(
											DB::raw('MAX(fecha_oficio) as fecha_oficio'),
											DB::raw('EXTRACT(YEAR FROM fecha_oficio) as year'),
											DB::raw('Sum(cantidad_urbanos) as folios_urbanos'),
											DB::raw('Sum(cantidad_rusticos) as folios_rustico'),
											DB::raw('Sum(total_urbano) as total_urbano'),
											DB::raw('Sum(total_rustico) as total_rustico'),
											DB::raw('Sum(total) as total'))
											->groupBy('year')
											->get();

		$vista = View::make('folios.folios.formatoreportetotal')->withFolios_historial($folios_historial);

		$pdf = PDF::load($vista)->show();
		//load(variable, tamaño de hoja, orientacion landscape)
		$response = Response::make($pdf, 200);
		$response->header('Content-Type', 'application/pdf');
		return $response;

	}

	public function grafica_reportes()
	{
		$folios_historial=FoliosHistorial::select(
			
								DB::raw('EXTRACT(MONTH FROM fecha_oficio) as mes'),
								DB::raw('Sum(cantidad_urbanos) as urbano'),
								DB::raw('Sum(cantidad_rusticos) as rustico'),
								DB::raw('Sum(total_urbano) as total_urbano'),
								DB::raw('Sum(total_rustico) as total_rustico'),
								DB::raw('Sum(total) as total'))
								->groupBy('mes')
								->orderBy('mes', 'ASC')
								->get();
								

		return View::make('folios.folios.graficas');
	}



	public function getquerys()
	{
		return View::make('folios.folios.querys');
	}

	public function querys()
	{
		$query = Input::get('query');


		$resultado = DB::select($query);

		$fields = [];


		foreach ($resultado[0] as $res => $value) 
		{
			$fields[]=$res;
		}



		return View::make('folios.folios.listquery', compact('resultado', 'fields'));
	}

}
