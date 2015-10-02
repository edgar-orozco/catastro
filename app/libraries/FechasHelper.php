<?php

class FechasHelper 
{

    public static function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = $start_date;
        $end_ts = $end_date;
        $user_ts = $evaluame;
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }
    public function diasprueba($dias, $fecha)
      {
        //VARIABLES DE CONTROL PARA SABADOS Y DOMINGOS Y DIAS HABILES
      $sabadosydomingos=0;
      $diashabiles=0;
      //DIAS DE VIGENCIA
      $feriados = array('1-01','5-02', '21-03', '1-05','16-09','20-11', '25-12');
      //conversion de fecha
      $fechas_convercion=explode('/',$fecha);
      $fecha=$fechas_convercion[2].'-'.$fechas_convercion[1].'-'.$fechas_convercion[0];
     //CICLO PARA RECORRER LAS FECHAS SEGUN LOS DIAS DE VIGENCIA
      for ($i=0; $i < $dias; $i++) {
        //OBTENEMOS LA FECHA SUMANDOLE LOS DIAS DE VIGENCIA Y LE DAMOS FORMATO
        $nuevafecha= strtotime ( $i.' day' , strtotime ( $fecha ) ) ;
      //  $nuevafecha1 = date ( 'Y-m-j' , $nuevafecha );
       $fecha_festivo= date('j-m', $nuevafecha);
       //validacion  de dias festivos
        if (in_array($fecha_festivo,$feriados))
        {
          $sabadosydomingos =$sabadosydomingos+1;
        }
      //OBTEMOS EL DIA EN LETRAS
         $dia=utf8_encode(strftime("%A",$nuevafecha));
      //SI EL DIA ES SABADO O DOMINGO SE SUMA 1 A LA VARIABLE SABADO O DOMINGO SINO SE SUMA UNO A LOS DIAS HABILES
          if($dia           =='sábado' || $dia=='domingo')
            {
              $sabadosydomingos =$sabadosydomingos+1;
            }
          else
            {
              $diashabiles      =$diashabiles+1;
            }
      }
     // $sabadosydomingos;

      //$diashabiles;

      $nuevafecha1 = date ( 'Y-m-j' , $fecha_fianl= strtotime ( $dias+$sabadosydomingos.' day' , strtotime ( $fecha ) )  );
      $dia_final=utf8_encode(strftime("%A",$fecha_fianl));
       if($dia_final                            =='sábado')
       {
       $nuevafechas = date ( 'Y-m-j' , $result=strtotime ( '+2 day' , strtotime ( $nuevafecha1 )));
       } elseif($dia_final                      =='domingo')
       {
        $nuevafechas = date ( 'Y-m-j' , $result=strtotime ( '+1 day' , strtotime ( $nuevafecha1 )));
       }else
       {
        $nuevafechas = date ( 'j-m-Y' , $fecha_fianl= strtotime ( $dias+$sabadosydomingos.' day' , strtotime ( $fecha ) )  );
       }return $nuevafechas;
       }


       public static function imprimirpdf($clave = null)
  {
        $resultado = DB::select("select sp_get_datos_predio('$clave')");

    foreach ($resultado as $key)
            {
                $vales = explode(',', $key->sp_get_datos_predio);
            }
            //sacamos la clave del array y la limpiamos
            $clave  = str_replace('(', '',$vales[0]);
              //sacamos el nomrbe del array y la limpiamos
            $nombre = str_replace('"', '',$vales[1]);

             //$municipio = str_replace('"', '',$vales[2]);
             //obtenemos id del municipio
            $id_mun =substr($clave, 3, 3);
            //obtenemos el nombre del municipio
            $mun_actual    =Municipio::where('municipio',$id_mun)->pluck('nombre_municipio');
            //obtenemos el git del municipio
            $gid    =Municipio::where('municipio',$id_mun)->pluck('gid');
            //obtenemos la configuracion del municipio
            $configutacion = configuracionMunicipal::where('municipio',$gid)->take(1)->get();
          //print_r($configutacion);

            $id_ejecucion=ejecucion::where('clave',$clave)->pluck('id_ejecucion_fiscal');
           // $fecha=requerimientos::where('id_ejecucion_fiscal',$id_ejecucion)->pluck('f_requerimiento');
           // obtenemos la fecha actual
           $fecha=date("Y-m-d");
           //array de fecha y nombre para el pdf
         $vale[] = array('0' =>str_replace('(', '',$vales[0]), '1' => str_replace('"', '',$vales[1]), '2' => str_replace('"', '',$vales[8]), '3' => str_replace('"', '',$vales[9]));
         //print_r($vale);
          //  $id_mun =substr($mun, 3, 3);
          //  $gid    =Municipio::where('municipio',$id_mun)->pluck('gid');
                  //--$vista = View::make('CartaInvitacion.carta', compact('data', 'fecha', 'nombre_eje', '--mun_actual','--vale'));
                  $vista    = View::make('CartaInvitacion.carta', compact('gid','vale','fecha', 'clave','nombre','mun_actual','configutacion'));
                  $pdf      = PDF::load($vista)->show("Copia-CartaInvitacion");
                  $response = Response::make($pdf, 200);
                  $response->header('Content-Type', 'application/pdf');
                  return $response;
  }

  static function fechaFC($date)
  {

    $mes = array();
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

    $date = date_parse($date);


    $mes[$date['month']];

    return $date['day'].' - '.$mes[$date['month']].' - '. $date['year'];



  }

}
