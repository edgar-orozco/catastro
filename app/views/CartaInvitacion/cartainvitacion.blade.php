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

        $fecha['1'] = "Enero";
        $fecha['2'] = "Febrero";
        $fecha['3'] = "Marzo";
        $fecha['4'] = "Abril";
        $fecha['5'] = "Mayo";
        $fecha['6'] = "Junio";
        $fecha['7'] = "Julio";
        $fecha['8'] = "Agosto";
        $fecha['9'] = "Septiembre";
        $fecha['10'] = "Octubre";
        $fecha['11'] = "Noviembre";
        $fecha['12'] = "Diciembre";
        ?>
        <!-- Recorro todos los elementos --> 
        <?php foreach($data as $key ){ ?>
        <div class="invitacionPage">
            <!-- saco el valor de cada elemento -->
            
             
          
            <!-- nuevo fotmato -->
            <p align="center">
H. AYUNTAMIENTO DEL MUNICIPIO DE CENTRO, TABASCO.<br/>
DIRECCION DE FINANZAS<br/>
SUBDIRECCION DE EJECUCION FISCAL<br/><br/>
MANTENIMIENTO DE EJECUCIÓN<br/>
</p>
<p align="right">
VILLAHERMOSA, TABASCO, <?php echo $fechas['day']. " de " . $fecha[$fechas['month']] . " del " . $fechas['year']; ?>
</p>


  <p  id="encabezado" align="left">CRÉDITO:
  DEUDOR<br/>
  DOMICILIO DEL PREDIO:<br/>
  DOMICILIO PARTICULAR:<br/>
  CONCEPTO:<br/>
  AÑOS DEADEUDO:<br/>
  TOTAL:
  </p>
  
    
    <p id="texto" align="justify">
VISTO EL EXPEDIENTE A NOMBRE DEL CONTRIBUYENTE <b>NOMBRE DEL DEUDOR  <?php echo $key ?> </b>. EL QUE SE DESPRENDE QUE NO HA CUBIERTO EL IMPORTE DEL CRÉDITO FISCAL ANTES MENCIONADO, EN EL PLAZO SEÑALADO POR LOS ARTÍCULOS 22 DE LA LEY DE HACIENDA MUNICIPAL DEL CRÉDITO FISCAL ANTES MENCIONADO, EN EL PLAZO SEÑALADO POR LOS ARTÍCULOS 22 DE LA LEY DE HACIENDA MUNICIPAL DEL ESTADO DE TABASCO; 15 DEL CÓDIGO FISCAL DEL ESTADO DE TABASCO, DE APLICACIÓN SUPLETORIA EN MATERIA MUNICIPAL, NO OBSTANTE HABÉRSELE NOTIFICADO EL DÍA <b>18 DE AGOSTO DE 2014</b>, POR CONDUCTO DE LA SUBDIRECCIÓN DE EJECUCIÓN FISCAL DE LA DIRECCIÓN DE FINANZAS DEL H. AYUNTAMIENTO CONSTITUCIONAL DEL MUNICIPIO DE CENTRO, Y HABIENDO TRANSCURRIDO LOS 45 Y 86 DE LA LEY DE HACIENDA MUNICIPAL Y 115 PRIMER PÁRRAFO DEL CÓDIGO FISCAL DEL ESTADO DE TABASCO, EN CONSECUENCIA LA SUSCRITA  <strong>LIC. DAYANA SILVIA GARRIDO ARGAEZ</strong>, <strong>SUBDIRECTORA DE EJECUCIÓN FISCAL</strong>, CON FUNDAMENTO EN LOS ARTÍCULOS ANTES MENCIONADOS 14 Y 16 DE LA CONSTITUCIÓN POLÍTICA DE LOS ESTADOS UNIDOS MEXICANOS, ASÍ COMO EN LOS NUMERALES 79 FRACCIONES V Y X DE LAY ORGÁNICA DE LOS MUNICIPIOS DEL ESTADO DE TABASCO, PUBLICADA EN EL SUPLEMENTO “C” AL PERIODO OFICIAL DEL ESTADO, NUMERO 6390 DE FECHA 3 DE DICIEMBRE 2003; 66, FRACCIONES IV, XI Y XXXVIII Y 77, FRACCIONES II, IV, VI, IX, X XI Y XII DEL REGLAMENTO DE LA ADMINISTRACIÓN PÚBLICA DEL MUNICIPIO DE CENTRO. TABASCO; PUBLICADO EN EL SUPLEMENTO “I” DEL PERIODO OFICIAL DEL ESTADO, NUMERO 6706 DE FECHA 13 DE DICIEMBRE DE 2006; <strong>ACUERDA:</strong></p>
<p id="texto" align="justify">
<strong>PRIMERO:</strong> QUE SE REQUIERE AL DEUDOR EN SU DOMICILIO, PARA EFECTUÉ EL PAGO DEL ADEUDO ARRIBA SEÑALADO, MAS ACTUALIZACIÓN SI LAS HUBIEREN, RECARGOS , MULTAS Y GASTOS DE EJECUCIÓN LOS CUALES SE CUANTIFICARAN EN EL MOMENTO DE HACERSE EL PAGO, TAL Y COMO LO DETERMINAN LOS ARTÍCULOS 31, 36 Y 37 DE LA LEY DE HACIENDA MUNICIPAL DEL ESTADO DE TABASCO  22 PÁRRAFOS PRIMERO Y 119 DEL CÓDIGO FISCAL DEL ESTADO DE TABASCO;  6, 13, 17, 23, 27, 61 Y ADEMÁS RELATIVOS DEL REGLAMENTO PARA EL COBRO Y APLICACIÓN DE GASTOS DE EJECUCIÓN Y PAGO DE HONORARIOS POR NOTIFICACIÓN DE CRÉDITOS DEL MUNICIPIO DEL CENTRO, TABASCO; PUBLICADO EN EL SUPLEMENTO  “E” DEL PERIODO OFICIAL DEL ESTADO, NÚMERO 6329 DE FECHA 3  DE MAYO DE 2003, APERCIBIÉNDOLO QUE NO HACERLO, EN LA MISMA DILIGENCIA SE LE EMBARGAN BIENES DE SU PROPIEDAD, SUFICIENTES PARA GARANTIZAR EL CRÉDITO A SU CARGO Y SUS ACCESORIOS.</p>
<p id="texto" align="justify">
<strong>SEGUNDO:</strong> QUE DE NO CUBRIRSE EL CRÉDITO FISCAL EN LA DILIGENCIA DE REQUERIMIENTOS DE PAGOS, DE CONFORMIDAD CON EL ARTÍCULO 120 FRACCIONES I Y II DEL CÓDIGO FISCAL DEL ESTADO DE TABASCO, SE EMBARGUEN BIENES PROPIEDADES DEL DEUDOR, SUFICIENTES PARA GARANTIZAR EL CRÉDITO FISCAL Y SUS ACCESORIOS. </p>

<p id="texto" align="justify">
<strong>TERCERO:</strong> SI DE LOS BIENES EMBARGADOS SE ENCUENTRAN BIENES DE FÁCIL DESCOMPOSICIÓN O DETERIORO, O MATERIALES INFLAMABLES QUE NO SE PUEDAN GUARDAR O DEPOSITAR EN LUGARES APROPIADOS PARA SU CONSERVACIÓN, EL NOTIFICADOR EJECUTOR QUE SE DESIGNA DEBERÁ INFORMAR AL DEUDOR O A LA PERSONA CON QUIEN SE ENTIENDA LA DILIGENCIA QUE LA DIRECCIÓN DE FINANZAS, PROCEDERÁ AL DEPÓSITO DE LOS MISMOS, SI FUERA POSIBLE, O EN SU DEFECTO, A REALIZAR LA VENTA DE LOS BIENES FUERA DE SUBASTA,  EN LOS TÉRMINOS DE LOS ARTÍCULOS 160 FRACCIÓN II Y 161 DEL CÓDIGO FISCAL DEL ESTADO DE TABASCO. </p>

<p id="texto" align="justify">
<strong>CUARTO:</strong> EN EL SUPUESTO DE QUE EL EMBARGO RECAIGA EN LA NEGOCIACIÓN DEL DEUDOR, QUEDARA FACULTADO EL EJECUTOR A DESIGNAR AL INTERVENTOR CORRESPONDIENTE, POR EL PLAZO QUE SE REQUIERA PARA OBTENER LOS INGRESOS QUE PERMITAN SATISFACER EL PAGO DEL CRÉDITO FISCAL Y SUS ACCESORIOS. </p>

<p id="texto" align="justify">
<strong>QUINTO:</strong> PARA EL CUMPLIMIENTO DEL PRESENTE MANDAMIENTO DE EJECUCIÓN, CON FUNDAMENTO EN EL ARTÍCULO 121 PRIMERO PÁRRAFO DEL CÓDIGO FISCAL DEL ESTADO DE TABASCO, SE DESIGNA COMO EJECUTOR AL <strong>C. <?php echo $nombre_eje ?></strong>, QUIEN PODRÁ DESIGNAR A ÉL O LOS DEPARTAMENTOS DE LOS BIENES QUE SE EMBARGUEN, DE CONFORMIDAD CON EL ARTÍCULO 122 DEL CÓDIGO DEL ESTADO DE TABASCO, ADVIRTIÉNDOLOS DE LAS PENAS EN QUE INCURREN LOS DEPOSITARIOS INFIELES, EN LOS TÉRMINOS DEL ARTÍCULO 90 DEL  CÓDIGO FISCAL DEL ESTADO DE TABASCO. </p>

<p id="texto" align="justify">
<strong>SEXTO: </strong>SE HACE SABER AL EJECUTOR, QUE SI EL DEUDOR O CUALQUIER OTRA PERSONA IMPIDIERA MATERIALMENTE EL ACCESO AL DOMICILIO DEL O LOS LUGARES EN QUE SE ENCUENTREN BIENES DE SU PROPIEDAD, CONFORME AL ARTÍCULO 131 DEL CÓDIGO FISCAL DEL ESTADO DE TABASCO, EL EJECUTOR PODRÁ SOLICITAR EL AUXILIO DE LA FUERZA PÚBLICA, PARA EFECTOS DE LLEVAR A CABO LA DILIGENCIA RESPECTIVA DE EMBARGO. </p>

<p id="texto" align="justify">
<strong>SÉPTIMO: </strong>ASI MISMO, CON FUNDAMENTO EN EL ARTÍCULO 132 DEL CÓDIGO FISCAL DEL ESTADO DE TABASCO, SI LA PERSONA CON QUIEN SE ENTIENDA LA DILIGENCIA NO ABRIERA LAS PUERTAS DEL O LOS INMUEBLES EN LOS QUE SE PRESUMA EXISTAN BIENES MUEBLES EMBARGABLES PROPIEDAD DEL DEUDOR O EXISTIERA OPOSICIÓN DE LA PERSONA CON QUIEN SE ENTIENDE LA DILIGENCIA, EL EJECUTOR QUEDA AUTORIZADO PARA QUE EN PRESENCIA DE DOS TESTIGOS SEAN ROTAS LAS CERRADURAS QUE FUERAN NECESARIO, A EFECTO DE EMBARGAR DICHOS BIENES Y EL DEPOSITARIO TOME POSESIÓN DE LOS MISMOS, O EN SU CASO, PARA QUE SIGA ADELANTE EN LA PRÁCTICA DE LA DILIGENCIA QUE SE LE ENCOMIENDA.</p>
<br/>
<br/>
<br/>
<br/>
<p id="texto" align="center">ATENTAMENTE</p>
<br/>
<br/>
<br/>
<hr align="center" color="#000000" width="250">
<p id="texto" align="center"><strong>LIC. DAYANA SILVIA  GARRIDO ARGAEZ</strong>.
         <br> <strong>SUBDIRECTORA DE EJECUCIÓN FISCAL</strong></p>
        </div>    
         <?php } ?>   
    </body>
</html>
