<?php
//--Controlador para generar carta invitacion
setlocale(LC_MONETARY, 'es_MX');

class CartaInvitacion_PdfController extends BaseController {

public function get_pdf()
    {
      //creamos array de todas las claves enviadas para generar carta invitacióm
       $clave = Input::all();
    //print_r($clave);
        //limpiamos y ordenamos el array
        $token      = $clave['_token'];
        $fecha      = $clave['date'];
        $ejecutor   = $clave['ejecutores'];
        $boton      = $clave['boton'];
        $mun_actual = strtoupper($clave['mun']);
        $pagi       =$clave['pagi'];
        $id_mun     =$clave['id_municipio'];

        unset($clave['id_municipio']);
        unset($clave['pagi']);
        unset($clave['mun']);
        unset($clave['ejecutores']);
        unset($clave['boton']);
        unset($clave['_token']);
        unset($clave['date']);
            //BUCLE PARA GUARDAR LOS DATOS A LA BASE DE DATOS
       $ejecutor   =($claves2['captura']['ejecutores']=$ejecutor);
       $nombre_eje = personas::where('id_p', $ejecutor)->pluck('nombrec');
       $usuario = Auth::user()->id;
       $fecha_server=date('Y-m-d');

       foreach($clave as $cla => $value)
        {

          $cv       =($claves2['captura']['clave']=$value);
          $cv       = str_replace('(', '',$cv);
          $vale[]   = explode(',',$cv);
          $fecha    =($claves2['captura']['fecha']=$fecha);

foreach ($vale as $clave ) {
            $claves=$clave[0];
            $verificacion = ejecucion::where('clave',$claves)->pluck('clave');
            //echo $resul=$verificacion;
          if($verificacion==''){
        //insert a la tabla ejecucion_fiscal
           $ejecucion = new ejecucion;
           $ejecucion->clave =$claves;
           $ejecucion->cve_status ='CI';
           $ejecucion->usuario = $usuario;
           $ejecucion->f_alta = $fecha_server;
           //$ejecucion->f_inicio_ejecucion=$fecha;
           $ejecucion->save();

        //select a la tabla ejecucion fiscal
           $id_ejecucion = $ejecucion->id_ejecucion_fiscal;
           //array de nuevos id_ejecucion para insertar a la tabla requerimientos
           $data[]= $id_ejecucion;

        //insert a la tabla requerimientos
        $requerimiento                      = new requerimientos;
        $requerimiento->id_ejecucion_fiscal =$id_ejecucion;
        $requerimiento->cve_status          ='CI';
        $requerimiento->f_requerimiento     = $fecha;
        $requerimiento->usuario             = $usuario;
        $requerimiento->f_alta              = $fecha_server;
        $requerimiento->save();
      }
 }
    }
//print_r($vale);

   //ENVIO A LA VISTA DEL PDF CARTA INVITACION
 $vista = View::make('CartaInvitacion.carta', compact('data', 'fecha', 'nombre_eje', 'mun_actual','vale'));
   $pdf = PDF::load($vista)->show("CartaInvitacion");
   $response = Response::make($pdf, 200);
   $response->header('Content-Type', 'application/pdf');
   return $response;
    }
}
