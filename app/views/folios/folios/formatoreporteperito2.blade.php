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
	    background-color: #E74C3C;
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

	.Table-Normal tbody tr:nth-child(2) {
	    background-color: #EEE;
	}
	/* Tables */


</style>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Reporte de folios Por Perito</title>
	</head>
	<body>

	<img src="css/images/folios/EncabezadoDC.jpg" WIDTH=560 HEIGHT=100 >


	<br>

	<h2 align="center">Dirección de catastro</h2>


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

		<h4>Reporte de entrega de folios hasta {{date("d") . " de " .$mes[date('m')]." del ". date("Y");}}</h4>

			<table border="1" align="center" class="Table-Normal">
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
							
							<td align="left">{{$perito->corevat}}</td>
							<td align="center">{{$perito->sumFoliosE('U')->autorizado}}</td>
							<td align="center">{{$perito->sumFoliosE('R')->autorizado}}</td>
							<td align="center">{{$perito->sumFoliosE('U')->entregado}}</td>
							<td align="center">{{$perito->sumFoliosE('R')->entregado}}</td>
							<td align="center">{{$perito->ultimaFechaE()}}</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td rowspan="2">Total</td>
						<td>{{$perito->sumFoliosE('U', 'total')->autorizado}}</td>
						<td>{{$perito->sumFoliosE('R', 'total')->autorizado}}</td>
						<td>{{$perito->sumFoliosE('U', 'total')->entregado}}</td>
						<td>{{$perito->sumFoliosE('R', 'total')->entregado}}</td>
						<td rowspan="2"></td>
					</tr>

					<tr>
						<td colspan="2">{{$perito->sumFoliosE('U', 'total')->autorizado+$perito->sumFoliosE('R', 'total')->autorizado}}</td>
						<td colspan="2">{{$perito->sumFoliosE('U', 'total')->entregado+$perito->sumFoliosE('R', 'total')->entregado}}</td>
					</tr>
				</tfoot>
		</table>																
		<br>
		<br>

		<div class="row" align="center">Revisado por</div>
		<br>
		<br>
		<div class="row" align="center">__________________________________</div>
		<div class="row" align="center">Alfredo Lopez Carrasco</div>
	</body>

</html>