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
      //DIAS DE VIGENCIA
      $feriados = array('1-01','5-02', '21-03', '1-05','16-09','20-11', '25-12');
      //conversion de fecha
      $fechas_convercion=explode('/',$fecha);
      $fecha=$fechas_convercion[2].'-'.$fechas_convercion[1].'-'.$fechas_convercion[0];
      //$fecha=date('Y-m-j', strtotime ( $fechas ));
      //VARIABLES DE CONTROL PARA SABADOS Y DOMINGOS Y DIAS HABILES
      $sabadosydomingos=0;
      $diashabiles=0;
      //OBTENEMOS LA FECHA ACTUAL
   //$fecha= date('Y-m-d');
     //CICLO PARA RECORRER LAS FECHAS SEGUN LOS DIAS DE VIGENCIA
      for ($i=0; $i < $dias; $i++) {
        //OBTENEMOS LA FECHA SUMANDOLE LOS DIAS DE VIGENCIA Y LE DAMOS FORMATO
        $nuevafecha= strtotime ( $i.' day' , strtotime ( $fecha ) ) ;
        $nuevafecha1 = date ( 'Y-m-j' , $nuevafecha );
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

}
