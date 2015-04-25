<?php

class PdfHelper 
{

  public static function imprimirpdf($clave = null)
  {
if(count($clave)==1)
{
        $resultado = DB::select("select sp_get_datos_predio('$clave')");

            foreach ($resultado as $key)
            {
                $vales = explode(',', $key->sp_get_datos_predio);
            }
          //valores amitidos para prueva
          // $clave  = str_replace('(', '',$vales[0]);
          // $nombre = str_replace('"', '',$vales[1]);
          //$municipio = str_replace('"', '',$vales[2]);
          // $id_mun =substr($clave, 3, 3);  //$mun_actual    =Municipio::where('municipio',$id_mun)->pluck('nombre_municipio');
          //  $gid    =Municipio::where('municipio',$id_mun)->pluck('gid');
          // $configutacion = configuracionMunicipal::where('municipio',$gid)->take(1)->get();
          //print_r($configutacion);
          //$id_ejecucion=ejecucion::where('clave',$clave)->pluck('id_ejecucion_fiscal');
          // $fecha=requerimientos::where('id_ejecucion_fiscal',$id_ejecucion)->pluck('f_requerimiento');
          // obtenemos la fecha actual
           $fecha=date("Y-m-d");
           //array de fecha y nombre para el pdf
          $vale[] = array('0' =>str_replace('(', '',$vales[0]), '1' => str_replace('"', '',$vales[1]), '2' => str_replace('"', '',$vales[8]), '3' => str_replace('"', '',$vales[9]));
         //print_r($vale);
          //  $id_mun =substr($mun, 3, 3);
          //  $gid    =Municipio::where('municipio',$id_mun)->pluck('gid');
                  //--$vista = View::make('CartaInvitacion.carta', compact('data', 'fecha', 'nombre_eje', '--mun_actual','--vale'));
                 $vista    = View::make('CartaInvitacion.carta', compact('vale','fecha'));
                  $pdf      = PDF::load($vista)->show("Copia-CartaInvitacion");
                  $response = Response::make($pdf, 200);
                  $response->header('Content-Type', 'application/pdf');
                  return $response;
    }


if(count($clave) > 1)
{
  foreach ($clave as $keys ) {

    $resultado = DB::select("select sp_get_datos_predio('$keys')");

            foreach ($resultado as $key)
            {
                $vales = explode(',', $key->sp_get_datos_predio);
            }
           $fecha=date("Y-m-d");
           //array de fecha y nombre para el pdf
          $vale[] = array('0' =>str_replace('(', '',$vales[0]), '1' => str_replace('"', '',$vales[1]), '2' => str_replace('"', '',$vales[8]), '3' => str_replace('"', '',$vales[9]));

  }


  }

}