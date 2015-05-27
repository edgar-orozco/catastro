<?php
//--Controlador para generar carta invitacion
setlocale(LC_MONETARY, 'es_MX');

class CartaInvitacion_masivoController extends BaseController {

public function get_pdf($clave=null)
    {
    	$vale=explode(',', $clave);
//print_r($vale);
    	$fecha=date('Y/m/d');
 		$total = count($vale);
    	for ($i=0; $i <= $total ; $i++) { 
 

              for ($i=0; $i <count($vale) ; $i++) 
                  {

                      $claves=$vale[$i];
                      $verificacion = ejecucion::where('clave',$claves)->pluck('clave');
                      //echo $resul=$verificacion;
                      if($verificacion=='')
                          {
                              //insert a la tabla ejecucion_fiscal
                              $ejecucion = new ejecucion;
                              $ejecucion->clave =$vale[$i];
                              $ejecucion->cve_status ='CI';
                              $ejecucion->usuario = Auth::user()->id;
                              $ejecucion->f_alta = date('Y-m-d');
                              //$ejecucion->f_inicio_ejecucion=$fecha;
                              $ejecucion->save();

                              //select a la tabla ejecucion fiscal
                              $id_ejecucion = $ejecucion->id_ejecucion_fiscal;
                              //array de nuevos id_ejecucion para insertar a la tabla requerimientos
                              $data[]= $id_ejecucion;

                              //insert a la tabla requerimientos
                              $requerimiento                      = new requerimientos;
                              $requerimiento->id_ejecucion_fiscal = $id_ejecucion;
                              $requerimiento->cve_status          = 'CI';
                              $requerimiento->f_requerimiento     = $fecha;
                              $requerimiento->usuario             = Auth::user()->id;
                              $requerimiento->f_alta              = date('Y-m-d');
                              $requerimiento->save();
                          }
                  }
        }

	if(count($vale) > 0)
		{
			$fechaven = PdfHelper::imprimirpdf($vale,$fecha);
			echo $fechaven;
		}else
		{
			 Session::flash('mensaje', 'No hay registros.');
        return Redirect::back();
		}
    }
}
