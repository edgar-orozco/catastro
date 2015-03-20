<html>
    <header>
        <style type="text/css">
            @page invitacion {
              size: A4 portrait;
              margin: 2cm;
            }
            .invitacionPage {
               page: invitacion;
               page-break-after: always;
            }
            #texto{
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-size: 10px;
  color: #0000000;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  line-height:15px;
 }
 #datos{
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-size: 10px;
 }
 #encabezado{
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-size: 12px;
  color: #0000000;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
 }
        </style>
    </header>
    <body>
      <?php
  $fechas=date_parse($fecha);
      $fecha = array();

        $fecha['1'] = "ENERO";
        $fecha['2'] = "FEBRERO";
        $fecha['3'] = "MARZO";
        $fecha['4'] = "ABRIL";
        $fecha['5'] = "MAYO";
        $fecha['6'] = "JUNIO";
        $fecha['7'] = "JULIO";
        $fecha['8'] = "AGOSTO";
        $fecha['9'] = "SEPTIEMBRE";
        $fecha['10'] = "OCTUBRE";
        $fecha['11'] = "NOVIEMBRE";
        $fecha['12'] = "DICIEMBRE";
        ?>
        <!-- Recorro todos los elementos -->
        <?php foreach($vale as $key ){ ?>
        <div class="invitacionPage">
            <!-- saco el valor de cada elemento -->
            <!-- nuevo fotmato -->
            <p align="center"><img src="logos/escudo.png" width="90" height="90">AYUNTAMIENTO CONSTITUCIONAL DE <?php echo $mun_actual; ?>, TAB. <img src="css/images/logos/LogoHuimanguillo.png" width="90" height="90"><br/>
2013-2015<br/>
DIRECCIÓN DE FINANZAS MUNICIPALES<br/><br/>
“TIERRA DE AUTORIDADES GRANDE”<br/>
</p>
<p align="right">
INVITACION: DF/INV/0/2015
</p>


  ESTIMADO (A): <b> <?php echo $key[1] ?> </b> R.F.C:
  </p>
<p id="texto" align="justify">
La dirección de finanzas del municipio de <?php echo $mun_actual; ?>, no tiene registrado el cumplimiento del pago impuesto predial de un predio inscrito a su nombre, con número  de cuenta: <b> <?php echo $key[0] ?>, Ubicado en: CHICOACAN ?, Sup. Predio: 710430m2, Sup. Construcion: 0 m2 de este municipio; por lo que confundamento   en los artículos 1,6,8 fracción IV, 16 fracciones I, II y XII, 19, 22, 24, 31, 44, 45, 46, 47, 48, 72 fracciones I y IV, 87, 88 fracciones I, II y III, 103 y 105 fracciones IV y VII, 153, 154 y 155   de la ley de Hacienda Municipal del Estado de Tabasco; se le invita   a que realice su pago correspondiente de  a los años detallados a continuación :</strong></p>
<p id="texto" align="justify">&nbsp;</p>
<p align="justify">&nbsp;</p>
<p align="justify">&nbsp;</p>
<p align="justify">&nbsp;</p>
<p id="texto" align="justify">
  <strong>No olvide que pagando a tiempo nuestro impuesto predial, los ciudadanos hacemos posible que en nuestro municipio se cumpla con una gran variedad  de servicios, se mejoren los ya existentes  e incluso se desarrollen algunos nuevos, pensando siempre en el bienestar de los Huimanguillenses. </p>
</p>
<p align="right"><?php echo $mun_actual; ?>, Tab. A <?php echo $fechas['day']. " DE " . $fecha[$fechas['month']] . " DEL " . $fechas['year']; ?></p>

<br/>
<p id="texto" align="center">ATENTAMENTE</p>
<hr align="center" color="#000000" width="250">
<p id="texto" align="center">L.C.P Jose Adalberto Cerino Cordova</p>
<p id="texto" align="center">RESPONSABLE DE INGRESOS</p>
<p>
  _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ _ _ _ _ _  _ _ _ </p>
C. <b> <?php echo $key[1] ?> </b>                       VALE <img src="css/images/logos/LogoHuimanguillo.png" width="90" height="90" align"right"><br>
CUENTA: 08-R-005373<br>
ENTREGA dd/mm/aaaa:<br>
<hr align="left" color="#000000" width="250">


<p id="texto" align="justify">
  <strong>La Autoridad Municipal, en apoyo al contribuyente, brinda un plazo de 5 días hábiles para efectuar el pago correspondiente; al presentar este vale en caja usted recibirá la CONDENACION DEL 100% en MULTAS y GASTOS DE EJECUCION, además de un DESCUENTO DEL 0% sobre los RECARGOS, Pagando solamente Usted:</p>
<p align="right">TOTAL A PAGAR: $732.00</p>

<p align="center">¡ACTUALIZATE!<br/>

<p id="texto" align="center"><strong>¡ESTE VALE SE HACE EXTENSIVO PARA TODOS SUS PREDIOS! Si usted ya realizo sus pagos, hace caso omiso de esta Invitación.</strong>.
         <br>
          <?php } ?>
    </body>
</html>
