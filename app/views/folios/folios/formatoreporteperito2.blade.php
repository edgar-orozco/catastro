<!DOCTYPE html>
<html>
<style type="text/css">
	tbody td{
		font-size: 70%;
	}
</style>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Reporte de Folios Por Perito</title>
	</head>
	<body>
		<?php
		$mes = array();

		$mes['01'] = "Enero";
		$mes['02'] = "Febrero";
		$mes['03'] = "Marzo";
		$mes['04'] = "Abril";
		$mes['05'] = "Mayo";
		$mes['06'] = "Junio";
		$mes['07'] = "Julio";
		$mes['08'] = "Agosto";
		$mes['09'] = "Septiembre";
		$mes['10'] = "Octubre";
		$mes['11'] = "Noviembre";
		$mes['12'] = "Diciembre";
		

		
		//echo $fecha['day']. " de " . $mes[$fecha['month']] . " del " . $fecha['year'];
	?>

		<h1>Reporte de Folios Hasta {{date("d") . " de " .$mes[date('m')]." del ". date("Y");}}</h1>

			<table border="1">
				<thead>
					<tr>
						<th rowspan="2">Perito</th>
						<th colspan="2">Folios Autorizados</th>
						<th colspan="2">Folios Entregados</th>
						<th colspan="2">Folios Disponibles</th>
					</tr>
					<tr>
						<th>U</th>
						<th>R</th>
						<th>U</th>
						<th>R</th>
						<th>U</th>
						<th>R</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($folios_historial as $folios)
						<tr>
							
							<td align="left">{{$folios->perito->nombre}}</td>
							<td align="center">{{$folios->folio_urbano_final}}</td>
							<td align="center">{{$folios->folio_rustico_final}}</td>
							<td align="center">{{$folios->folio_urbano_final}}</td>
							<td align="center">{{$folios->folio_rustico_final}}</td>

							<?php 

								$totalingresos = ($folios->folio_urbano_final*($conf->salario_minimo*$conf->salario_folio_urbano))
								                +($folios->folio_rustico_final*($conf->salario_minimo*$conf->salario_folio_rustico));


							?>
							<td align="center">$ {{number_format($totalingresos,'2')}}</td>
							<td align="center">$ {{number_format($totalingresos,'2')}}</td>
						</tr>
					@endforeach
					@foreach ($folios_totales as $totales)
						<tr>
							<td></td>
							<th>TOTAL</th>
							<th align="center">{{$totales->folios_urbanos}}</th>
							<th align="center">{{$totales->folios_rusticos}}</th>
							<th align="center">{{$totales->folios_urbanos}}</th>
							<th align="center">{{$totales->folios_rusticos}}</th>
							<th align="center">${{number_format($totales->total,'2')}}</th>
							
						</tr>
					@endforeach 
				</tbody>
		</table>
	</body>
</html>