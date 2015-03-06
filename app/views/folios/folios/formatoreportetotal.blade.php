<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Rerporte Total Anual</title>
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
			
		?>

		<h1>Reporte de Folios Hasta {{date("d") . " de " .$mes[date('m')]." del ". date("Y");}}</h1>

		<table border="1">
			<thead>
				<tr>
					<th>Año</th>
					<th>Folios Urbanos</th>
					<th>Folios Rusticos</th>
					<th>Total Urbanos</th>
					<th>Total Rusticos</th>
					<th>Total de Recaudación</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($folios_historial as $folios)
					<tr>
						<td>{{date('Y')}}</td>
						<td align="center">{{$folios->folios_urbanos}}</td>
						<td align="center">{{$folios->folios_rustico}}</td>
						<td align="center">$ {{number_format($folios->total_urbano, '2')}}</td>
						<td align="center">$ {{number_format($folios->total_rustico, '2')}}</td>
						<td align="center">$ {{number_format($folios->total,'2')}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</body>
</html>