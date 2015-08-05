<!DOCTYPE html>
<html>
<style type="text/css">
	

	/* Tables */
	.Table-Normal {
	    position: relative;
	    margin: 10px auto;
	    padding: 0;
	    width: 100%;
	    height: auto;
	    border-collapse: collapse;
	    text-align: center;
	}

	.Table-Normal thead tr {

	    font-weight: bold;
	}

	.Table-Normal tbody tr {
	    margin: 0;
	    padding: 0;
	    border: 0;
	    border: 1px solid #999;
	    width: 100%;
	}

	.Table-Normal tbody tr td {
	    margin: 0;
	    padding: 4px 8px;
	    border: 0;
	    border: 1px solid #999;
	}

	/* Tables */


</style>
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
		$fecha['10'] = "Octubre";
		$fecha['11'] = "Noviembre";
		$fecha['12'] = "Diciembre";
	
	?>

<h1>Reporte de Folios mensual</h1>

<div class="panel panel-primary">

	<div class="panel-body">


	<table border="1" align="center" class="Table-Normal">
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
			<tfoot>
				<tr>
					<td rowspan="2">Total</td>
					<td>{{perito::All()[0]->sumFoliosE('U','total')->autorizado}}</td>
					<td>{{perito::All()[0]->sumFoliosE('R','total')->autorizado}}</td>
					<td colspan="2" rowspan="2"></td>
				</tr>
				<tr>
					<td colspan="2">{{perito::All()[0]->sumFoliosE()->autorizado}}</td>
				</tr>
			</tfoot>
		</table>

		<h4>Fecha de impresión: {{date("d") . " de " .$fecha[date('n')]." del ". date("Y");}}</h4>
	
	</div>
</div>
</body>
</html>
