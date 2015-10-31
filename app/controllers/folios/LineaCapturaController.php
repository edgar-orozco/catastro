<?php

class folios_LineaCapturaController extends BaseController 
{
	public function index ()
	{
		return View::make('folios.lineaCaptura.lineaCapturaForm');
	}

    public function ObtenerValoresWS() 
    {
        
        $reglas = 
        [
            'nombre' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'folios_urbanos' => 'required|numeric',
            'folios_rusticos' => 'required|numeric'
        ];

        $validation = Validator::make(Input::All(), $reglas);

        if($validation->fails())
        {
            return Redirect::back()->withErrors($validation);
        }

        $nombre = strtoupper(Input::get('nombre') . ' '. Input::get('paterno') . ' '. Input::get('materno'));

        $referencia = "DT001|150";
        $observacion = "CA PAGO DE FOLIOS URBANOS Y/O RUSTICOS";
        $f = rand(0,100);
        $folio = date("Y")."01".str_pad($f,6,"0",STR_PAD_LEFT);
        $cantidadU = Input::get('folios_urbanos');
        $cantidadR = Input::get('folios_rusticos');

        $confi = Conf::first();

        $precio_urbano = $confi->salario_minimo * $confi->salario_folio_urbano;
        $precio_rustico = $confi->salario_minimo * $confi->salario_folio_rustico;

        $total_urbano = $precio_urbano * $cantidadU;
        $total_rustico = $precio_rustico * $cantidadR;
        $total = $total_rustico + $total_urbano;

        $lc = new LineaCaptura($nombre, $referencia, $observacion, $folio);

        if(!$lc->estatus)
        {
            Session::flash('error',$lc->getErrorMsg());
            return Redirect::back()->withInput();
        }

        $linea = $lc->getLineaCaptura();
        if(is_array($linea))
        {
            $linea_captura['finanzas'] = $linea[6];
            $linea_captura['oxxo'] = $linea[7];
            $linea_captura['banamex'] = $linea[8];
            $linea_captura['vigencia_del'] = $linea[2];
            $linea_captura['vigencia_al'] = $linea[3];
            $linea_captura['transaccion'] = date("Y")."/".$linea[1];
        }
        else
        {
            Session::flash('error',$lc->getErrorMsg());
            return Redirect::back()->withInput();
        }
        //barcodes
        $linea_captura_cb['finanzas'] = ".".DNS1D::getBarcodePNGPath($linea_captura['finanzas'], "C128");
        $linea_captura_cb['oxxo'] = ".".DNS1D::getBarcodePNGPath($linea_captura['oxxo'], "C128");
        $directo = '';
        $logo='';
        $vars = [
          'cantidadU', 'cantidadR','precio_urbano', 'precio_rustico',
          'total_urbano', 'total_rustico', 'total', 'nombre',
            'linea_captura', 'linea_captura_cb', 'directo'
        ];


        $vista = View::make('folios.lineaCaptura.pdf', compact($vars));

		$pdf = PDF::load($vista)->show();
		//load(variable, tamaño de hoja, orientacion landscape)
		$response = Response::make($pdf, 200);
		$response->header('Content-Type', 'application/pdf');
		return $response;
    }




}