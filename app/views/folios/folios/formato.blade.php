<!DOCTYPE html>
<html>
	<head>
		<title>Folio Emitido</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<img src="imagenes/EncabezadoDC.jpg" WIDTH=500 HEIGHT=80 >

		<p align="right">SPF/SI/DGCyEF/DC/{{$folios_historial->no_oficio}}/2015
		<br>

		Villahermosa, Tab., 
			
			<?php

			$fechaBD=date_parse($folios_historial->fecha_oficio);
			$fechaBD1=date_parse($folios_historial->fecha_solicitud);
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
				

			
				echo $fechaBD['day']. " de " . $fecha[$fechaBD['month']] . " del " . $fechaBD['year'];

			//echo $fecha2 = date('d B Y',  strftime($folios_historial->fecha_solicitud));
			//echo date_format($mifecha, 'd-m-Y');
				
			?>

		 
		</p>
		<br><br>
		<B>{{$datos_perito->nombre}} <br>
		PERITO VALUADOR  {{$datos_perito->corevat}}<br>
		P R E S E N T E</B><br>

		<p align="justify">
			En respuesta a su solicitud de fecha {{$fechaBD1['day']. " de " . $fecha[$fechaBD1['month']]}} del presente Año, informo a Usted, que previo el pago de los Derechos correspondientes se le autoriza los folios que a continuación se mencionan, para ejercer la práctica de Perito Valuador de la Comisión del Registro Estatal de Valuadores (COREVAT):
		</p>	

				
		
		<table width="100%" align="center" border="1">
			<tr>
				<td></td>
				<td height="25" align="center" >No. de Folios URBANOS</td>
				<td align="center">No. de Folios RUSTICOS</td>
			</tr>
			<tr >
				<?php

									

					$inputcantu=$folios_historial->cantidad_urbanos;
					$inputcantr=$folios_historial->cantidad_rusticos;

					//Condicion 0 folios Urbanos

					if($inputcantu==0)
					{
						$urbanoinicio=0;
						$urbanofinal=0;
					}
					else //Condicion si compran folios Urbanos
					{
					$cantidadinicio = $folios_historial->folio_urbano_inicio;
					$cantidadinicio = str_pad($cantidadinicio, 4, "0", STR_PAD_LEFT);
					$cantidadfinal = $folios_historial->folio_urbano_final;
					$cantidadfinal = str_pad($cantidadfinal, 4, "0", STR_PAD_LEFT);
					$urbanoinicio = $datos_perito->corevat.'-'.$cantidadinicio.'U-'.$conf->ano_folio;
					$urbanofinal = $datos_perito->corevat.'-'.$cantidadfinal.'U-'.$conf->ano_folio;
					}

					//Condicion 0 folios Rusticos
					
					if($inputcantr==0)
					{
						$rusticoinicio=0;
						$rusticofinal=0;
					}
					else //Condicion si compran folios Rusticos
					{
					$cantidadinicio = $folios_historial->folio_rustico_inicio;
					$cantidadinicio = str_pad($cantidadinicio, 4, "0", STR_PAD_LEFT);
					$cantidadfinal = $folios_historial->folio_rustico_final;
					$cantidadfinal = str_pad($cantidadfinal, 4, "0", STR_PAD_LEFT);
					$rusticoinicio = $datos_perito->corevat.'-'.$cantidadinicio.'R-'.$conf->ano_folio;
					$rusticofinal = $datos_perito->corevat.'-'.$cantidadfinal.'R-'.$conf->ano_folio;
					}

					




				?>
				<td height="25" align="center">DESDE FOLIO</td>
				<td align="center">{{$urbanoinicio}}</td>
				<td align="center">{{$rusticoinicio}}</td>
			</tr>
			<tr>
				<?php
					$inputu = $folios_historial->folio_urbano_final;
					$inputu = str_pad($inputu, 4, "0", STR_PAD_LEFT);
					$inputr = $folios_historial->folio_rustico_final;
					$inputr = str_pad($inputr, 4, "0", STR_PAD_LEFT);
				?>
				<td height="25" align="center"> HASTA FOLIO</td>
				<td align="center">{{$urbanofinal}}</td>
				<td align="center">{{$rusticofinal}}</td>

			</tr>
		</table>
		<br>
		Cabe hacer mención que la vigencia de éstos folios es hasta el día 31 de diciembre del 2015
		
		<br>
		<p align="justify">
			De igual manera informo a usted, que con fundamento en el Art. 30 de la Ley de Valuacion y al Art. 25 de su Reglamento, tiene obligación de proporcionar a la Comisión la información y documentación que se le sea requerida en ejercicio de dichas facultades, motivo por el cual, mensualmente los primeros seis días hábiles de cada mes, deberán remitir a la Comisión, copia de los avalúos realizados y el informe o relación del uso o destino de cada uno de los folios autorizados.
		</p>
		Sin otro particular, aprovecho la ocasión para enviarle un cordial saludo.
		<br><br><br>
		<p align="center">
			<B>A T E N T A M E N T E<br>
			SUFRAGIO EFECTIVO. NO REELECCION<br>
			EL DIRECTOR DE CATASTRO<br><br><br><br>
		
			{{$conf->director_catastro}}
			</B>
		</p>
		<!--<font size=1>-->
		<p style="font-size: 10px;">Fueron Pagados los Derechos según Folio {{$folios_historial->no_recibo}}</p>
		<p style="font-size: 10px;">C.c.p. {{$conf->director_general}}.- DIRECTOR GENERAL DE CATASTRO Y EJECUCION FISCAL
		<br>C.c.p. Archivo.</p>

		<table style="font-size: 10px;">
			<tr>
				<td width="200" >
					Av. Adolfo Ruiz Cortinez s/n<br>
					Col. Casa Blanca, C.P.86060<br>
					Tel. 3-58-03-30 y 3-58-03-54<br>
					Villahermosa, Tabasco, México<br>
					<b>www.spf.tabasco.gob.mx</b>
				</td>
				<td width="300" align="center">
					{{$conf->frase_anual}}
				</td>
			</tr>
			
		</table>
		<!--</font>-->
	</body>
</html>