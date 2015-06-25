<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Reporte Mensual de Folios</title>
</head>
<body>
<center><img src="css/images/folios/Encabezado SPF 2014.png" WIDTH=400 HEIGHT=80 ></
	<?php
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
		$fecha['0'] = "Octubre";
		$fecha['11'] = "Noviembre";
		$fecha['12'] = "Diciembre";
	
	?>

<h1>Reporte de Folios mensual</h1>

<div class="panel panel-primary">

	<div class="panel-body">


	<table border="1" WIDTH="100%">
			<thead>
				<tr>
					<th>Mes</th>
					<th>Urbanos</th>
					<th>Rusticos</th>
					<th>Total del Mes</th>
					<th>Acumulado</th>
					</tr>
			</thead>
			<tbody>
			<?php $acum = 0;?>
				@foreach($folios_historial as $reporte)
					<tr>
						<td align="center" >{{$fecha[$reporte->mes]}}</td>
						<td align="center" >{{$reporte->urbano}}</td>
						<td align="center" >{{$reporte->rustico}}</td>
						<td align="right" >$ {{number_format($reporte->total,2)}}</td>
						<?php $acum = $acum + $reporte->total;?>
						<td align="right" >$ {{number_format($acum,2)}}</td>
						
					</tr>
				@endforeach
			</tbody>
		</table>
	
	</div>
</div>
</body>
</html>
