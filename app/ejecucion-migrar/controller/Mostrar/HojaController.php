<?php
//--Controlador para generar carta invitacion
class Mostrar_HojaController extends BaseController {

public function get_pdf()
    {
      //creamos array de todas las claves enviadas para generar carta invitacióm
       $clave = Input::all();
       
        //limpiamos y ordenamos el array
        $token = $clave['_token'];
        $fecha = $clave['date1'];
        $id_ejecutor=$clave['size'];
        $boton=$clave['boton'];
      
        unset($clave['size']);
        unset($clave['boton']);
        unset($clave['_token']);
        unset($clave['date1']);
            
       foreach($clave as $cla => $value) 
        {
         $cv=($claves2['captura']['clave']=$value);         
         $fecha=($claves2['captura']['fecha']=$fecha);
     

        //insert a la tabla ejecucion_fiscal
       $ejecucion = new ejecucion;
       $ejecucion->clave =$cv;
       $ejecucion->cve_status ='CI';
       $ejecucion->f_inicio_ejecucion=$fecha;
       $ejecucion->save();
        
        //select a la tabla ejecucion fiscal
       $id_ejecucion = $ejecucion->id_ejecucion_fiscal; 
       //array de nuevos id_ejecucion para insertar a la tabla requerimientos
        $data[]= $id_ejecucion;
   
        //insert a la tabla requerimientos
      $requerimiento = new requerimientos;
      $requerimiento->id_ejecucion_fiscal=$id_ejecucion;
      $requerimiento->cve_status='CI';
      $requerimiento->save();

    }
   
$vista = View::make('pdf.image')->with('data', $data);
 
    $pdf = PDF::load($vista)->show();
    $response = Response::make($pdf, 200);
    $response->header('Content-Type', 'application/pdf');
    return $response;
  }
}
