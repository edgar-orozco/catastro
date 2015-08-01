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
						<th rowspan="2">Ultima Entrega</th>
					</tr>
					<tr>
						<th>U</th>
						<th>R</th>
						<th>U</th>
						<th>R</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($peritos as $perito)
						<tr>
							
							<td align="left">{{$perito->nombre}}</td>
							<td align="center">{{$perito->sumFoliosE('U')->autorizado}}</td>
							<td align="center">{{$perito->sumFoliosE('R')->autorizado}}</td>
							<td align="center">{{$perito->sumFoliosE('U')->entregado}}</td>
							<td align="center">{{$perito->sumFoliosE('R')->entregado}}</td>
							<td align="center">{{$perito->ultimaFechaE()}}</td>
						</tr>
					@endforeach
				</tbody>
		</table>
	</body>
</html>