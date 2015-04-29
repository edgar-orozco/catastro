<?php

class PdfHelper 
{

  public static function imprimirpdf($clave = null, $fecha = null)
  {
if(count($clave)==1)
{
  $claves=$clave[0];
  $resultado = DB::select("select sp_get_datos_predio('$claves')");
    foreach ($resultado as $key)
      {
        $vales = explode(',', $key->sp_get_datos_predio);
      }
       // $fecha=date("Y-m-d");
         $nombre=str_replace('"', '',$vales[1]);
           $nombre=str_replace('{', '',$nombre);
           $nombre=str_replace('}', '',$nombre);

        //array de fecha y nombre para el pdf
        $vale[] = array('0' =>str_replace('(', '',$vales[0]), '1' => $nombre, '2' => str_replace('"', '',$vales[8]), '3' => str_replace('"', '',$vales[9]));
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
           //$fecha=date("Y-m-d");
           //array de fecha y nombre para el pdf
           $nombre=str_replace('"', '',$vales[1]);
           $nombre=str_replace('{', '',$nombre);
           $nombre=str_replace('}', '',$nombre);

          $vale[] = array('0' =>str_replace('(', '',$vales[0]), '1' => $nombre, '2' => str_replace('"', '',$vales[8]), '3' => str_replace('"', '',$vales[9]));

  }

 $vista    = View::make('CartaInvitacion.carta', compact('vale','fecha'));
                  $pdf      = PDF::load($vista)->show("Copia-CartaInvitacion");
                  $response = Response::make($pdf, 200);
                  $response->header('Content-Type', 'application/pdf');
                  return $response;
  }

}}