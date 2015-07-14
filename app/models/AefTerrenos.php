<?php

class AefTerrenos extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aef_terrenos';
	protected $primaryKey = 'idaefterreno';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function AefTerrenosByFk($idavaluoenfoquefisico) {
		return AefTerrenos::select('*')
						->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)
						->orderBy('idaefterreno')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insBeforeAefTerrenos($inputs, &$rowAefTerrenos) {
		//set @idavaluo = (select idavaluo from avaluo_enfoque_fisico where  idavaluoenfoquefisico = new.idavaluoenfoquefisico);
		$rowAvaluosFisico = AvaluosFisico::select('idavaluo')->where('idavaluoenfoquefisico', '=', $inputs["idAef"])->first();
		//set @suterr = (select superficie_terreno from avaluo_inmueble where idavaluo = @idavaluo);
		$rowAvaluosInmbueble = AvaluosInmueble::select('*')->where('idavaluo', '=', $rowAvaluosFisico->idavaluo)->first();
		if ( $rowAvaluosInmbueble->superficie_terreno > 0 ) {
			//set new.superficie = @suterr;
			$rowAefTerrenos->superficie = $rowAvaluosInmbueble->superficie_terreno;
			//Set @ValAppM2 = (select valor_aplicado_m2 from avaluo_enfoque_fisico where idavaluoenfoquefisico = new.idavaluoenfoquefisico);
			$rowAvaluosFisico = AvaluosFisico::select('*')->where('idavaluoenfoquefisico', '=', $inputs['idAef'])->first();
			//set @ValFR = new.irregular * new.top * new.frente * new.forma * new.otros;
			$rowCatFactoresTop = CatFactoresConservacion::find($inputs['idfactortop']);
			$rowAefTerrenos->top = $rowCatFactoresTop->valor_factor_conservacion;

			$rowCatFactoresFrente = CatFactoresFrente::find($inputs['idfactorfrente']);
			$rowAefTerrenos->frente = $rowCatFactoresFrente->valor_factor_frente;

			$rowCatFactoresForma = CatFactoresForma::find($inputs['idfactorforma']);
			$rowAefTerrenos->forma = $rowCatFactoresForma->valor_factor_forma;

			$rowCatFactoresConservacion = CatFactoresConservacion::find($inputs['idfactorconservacion']);
			$rowAefTerrenos->otros = $rowCatFactoresConservacion->valor_factor_conservacion;

			$ValFR = $inputs['irregular'] * $rowAefTerrenos->top * $rowAefTerrenos->frente * $rowAefTerrenos->forma * $rowAefTerrenos->otros;
			//Set new.factor_resultante = @ValFR;
			$rowAefTerrenos->factor_resultante = $ValFR;
			//Set new.valor_unitario_neto = @ValAppM2 * @ValFR;
			$rowAefTerrenos->valor_unitario_neto = $rowAvaluosFisico->valor_aplicado_m2 * $ValFR;
			//Set new.valor_parcial = @suterr * new.valor_unitario_neto * (new.indiviso/100);
			$rowAefTerrenos->valor_parcial = $rowAvaluosInmbueble->superficie_terreno * $rowAefTerrenos->valor_unitario_neto * ($inputs['indiviso']/100);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAefTerrenos($inputs, &$idaefterreno) {
		$rowAefTerrenos = new AefTerrenos();
		AefTerrenos::insBeforeAefTerrenos($inputs, $rowAefTerrenos);
		$rowAefTerrenos->idavaluoenfoquefisico = $inputs["idAef"];
		$rowAefTerrenos->fraccion = $inputs["fraccion"];
		$rowAefTerrenos->irregular = $inputs["irregular"];
		// $rowAefTerrenos->top = $inputs["idfactortop"];
		$rowAefTerrenos->indiviso = $inputs["indiviso"];
		$rowAefTerrenos->idemp = 1;
		$rowAefTerrenos->ip = $_SERVER['REMOTE_ADDR'];
		$rowAefTerrenos->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAefTerrenos->creado_por = Auth::Id();
		$rowAefTerrenos->creado_el = date('Y-m-d H:i:s');
		$rowAefTerrenos->save();
		AefTerrenos::insAfterAefTerrenos($inputs['idAef']);
		$idaefterreno = $rowAefTerrenos->idaefterreno;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAfterAefTerrenos($idavaluoenfoquefisico) {
		$rowAefTerrenos = AefTerrenos::select(DB::raw('sum(valor_parcial) AS valorpar'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
		$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
		$rowEnfoqueFisico->valor_terreno = $rowAefTerrenos->valorpar;
		$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
		$rowEnfoqueFisico->save();
		AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
	}

	/**
	 * Show the form for editing the specified resource.
	 * Add Top Factor
	 * @param  int  $id 
	 * @return Response
	 */
	public static function updBeforeAefTerrenos($inputs, &$rowAefTerrenos) {
		//set @idavaluo = (select idavaluo from avaluo_enfoque_fisico where  idavaluoenfoquefisico = new.idavaluoenfoquefisico);
		$rowAvaluosFisico = AvaluosFisico::select('idavaluo')->where('idavaluoenfoquefisico', '=', $inputs["idAef"])->first();
		//set @suterr = (select superficie_terreno from avaluo_inmueble where idavaluo = @idavaluo);
		$rowAvaluosInmbueble = AvaluosInmueble::select('*')->where('idavaluo', '=', $rowAvaluosFisico->idavaluo)->first();
		if ( $rowAvaluosInmbueble->superficie_terreno > 0 ) {
			//set new.superficie = @suterr;
			$rowAefTerrenos->superficie = $rowAvaluosInmbueble->superficie_terreno;
			//Set @ValAppM2 = (select valor_aplicado_m2 from avaluo_enfoque_fisico where idavaluoenfoquefisico = new.idavaluoenfoquefisico);
			$rowAvaluosFisico = AvaluosFisico::select('*')->where('idavaluoenfoquefisico', '=', $inputs['idAef'])->first();
			//set @ValFR = new.irregular * new.top * new.frente * new.forma * new.otros;

			$rowCatFactoresTop = CatFactoresConservacion::find($inputs['idfactortop']);
			$rowAefTerrenos->top = $rowCatFactoresTop->valor_factor_conservacion;
			
			$rowCatFactoresFrente = CatFactoresFrente::find($inputs['idfactorfrente']);
			$rowAefTerrenos->frente = $rowCatFactoresFrente->valor_factor_frente;

			$rowCatFactoresForma = CatFactoresForma::find($inputs['idfactorforma']);
			$rowAefTerrenos->forma = $rowCatFactoresForma->valor_factor_forma;
			$rowCatFactoresConservacion = CatFactoresConservacion::find($inputs['idfactorconservacion']);
			$rowAefTerrenos->otros = $rowCatFactoresConservacion->valor_factor_conservacion;
			$ValFR = $inputs['irregular'] * $rowAefTerrenos->top * $rowAefTerrenos->frente * $rowAefTerrenos->forma * $rowAefTerrenos->otros;
			//Set new.factor_resultante = @ValFR;
			$rowAefTerrenos->factor_resultante = $ValFR;
			//Set new.valor_unitario_neto = @ValAppM2 * @ValFR;
	
			$rowAefTerrenos->valor_unitario_neto = $rowAvaluosFisico->valor_aplicado_m2 * $ValFR;
			// $rowAefTerrenos->valor_unitario_neto = 1000000;
	
			//Set new.valor_parcial = @suterr * new.valor_unitario_neto * (new.indiviso/100);
			$rowAefTerrenos->valor_parcial = $rowAvaluosInmbueble->superficie_terreno * $rowAefTerrenos->valor_unitario_neto * ($inputs['indiviso']/100);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAefTerrenos($inputs) {
		$rowAefTerrenos = AefTerrenos::find($inputs["idTable"]);
		AefTerrenos::updBeforeAefTerrenos($inputs, $rowAefTerrenos);
		$rowAefTerrenos->fraccion = $inputs["fraccion"];
		$rowAefTerrenos->irregular = $inputs["irregular"];
		// $rowAefTerrenos->top = $inputs["idfactortop"];
		// $rowAefTerrenos->frente = $inputs["idfactorfrente"];
		// $rowAefTerrenos->forma = $inputs["idfactorforma"];
		$rowAefTerrenos->indiviso = $inputs["indiviso"];
		$rowAefTerrenos->ip = $_SERVER['REMOTE_ADDR'];
		$rowAefTerrenos->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$rowAefTerrenos->modi_por = Auth::Id();
		$rowAefTerrenos->modi_el = date('Y-m-d H:i:s');
		$rowAefTerrenos->save();
		AefTerrenos::updAfterAefTerrenos($inputs['idAef']);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAfterAefTerrenos($idavaluoenfoquefisico) {
		$rowAefTerrenos = AefTerrenos::select(DB::raw('sum(valor_parcial) AS valorpar'))->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)->first();
		$rowEnfoqueFisico = AvaluosFisico::find($idavaluoenfoquefisico);
		$rowEnfoqueFisico->valor_terreno = $rowAefTerrenos->valorpar;
		$rowEnfoqueFisico->total_valor_fisico = AvaluosFisico::updBeforeAvaluoEnfoqueFisico($rowEnfoqueFisico);
		$rowEnfoqueFisico->save();
		AvaluosFisico::updAfterAvaluoEnfoqueFisico($rowEnfoqueFisico->idavaluo, $rowEnfoqueFisico->total_valor_fisico);
	}

}
