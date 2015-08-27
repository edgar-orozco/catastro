<?php
/**
* 
*/
class folios_reportes_MensualController extends BaseController
{
	
      public function reportemensual()
      {
            $mes = [];
            $mes['1'] = "Enero";
            $mes['2'] = "Febrero";
            $mes['3'] = "Marzo";
            $mes['4'] = "Abril";
            $mes['5'] = "Mayo";
            $mes['6'] = "Junio";
            $mes['7'] = "Julio";
            $mes['8'] = "Agosto";
            $mes['9'] = "Septiembre";
            $mes['10'] = "Octubre";
            $mes['11'] = "Noviembre";
            $mes['12'] = "Diciembre";
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
            $meses = [];
            $urbanos = [];
            $rusticos = [];
            foreach ($folios_historial as $folio) 
            {
                  $meses[] = $mes[$folio->mes];
                  $urbanos[] = $folio->urbano;
                  $rusticos[] = $folio->rustico;
            }
            $meses = json_encode($meses);
            $urbanos = json_encode($urbanos, JSON_NUMERIC_CHECK);
            $rusticos = json_encode($rusticos, JSON_NUMERIC_CHECK);
            return View::make('folios.folios.reportemensual', compact('meses', 'urbanos', 'rusticos'))->withFolios_historial($folios_historial);
      }

      public function formatoreportemensual(){

            $mes = [];
            $mes['1'] = "Enero";
            $mes['2'] = "Febrero";
            $mes['3'] = "Marzo";
            $mes['4'] = "Abril";
            $mes['5'] = "Mayo";
            $mes['6'] = "Junio";
            $mes['7'] = "Julio";
            $mes['8'] = "Agosto";
            $mes['9'] = "Septiembre";
            $mes['10'] = "Octubre";
            $mes['11'] = "Noviembre";
            $mes['12'] = "Diciembre";
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
            $totalF=FoliosHistorial::select(db::raw('Sum(total) as total'))->first()->toArray();
            $totalF=$totalF['total'];
            $meses = [];
            $urbanos = [];
            $rusticos = [];
            foreach ($folios_historial as $folio) 
            {
                  $meses[] = $mes[$folio->mes];
                  $urbanos[] = $folio->urbano;
                  $rusticos[] = $folio->rustico;
            }
            $meses = json_encode($meses);
            $urbanos = json_encode($urbanos, JSON_NUMERIC_CHECK);
            $rusticos = json_encode($rusticos, JSON_NUMERIC_CHECK);
            $vista = View::make('folios.folios.formatoreportemensual', compact('totalF', 'urbanos', 'meses', 'rusticos'))->withFolios_historial($folios_historial);
            return $vista;
            $pdf = PDF::load($vista)->show();
            
            //load(variable, tamaño de hoja, orientacion landscape)
            $response = Response::make($pdf, 200);
            $response->header('Content-Type', 'application/pdf');
            return $response;

      }

	public function grafica()
      {
            return View::make('folios.reportes.mensual.grafica');
      }
}


?>