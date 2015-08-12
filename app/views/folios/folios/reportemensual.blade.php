@extends('layouts.default')

@section('content')

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

<h1>Reporte de Folios</h1>

<div class="panel panel-primary">
	<div class="panel-heading">

		<h4 class="panel-title">Reporte de Folios mensual </h4>
		<a href="formatoreportemensual" target="_blank" class="btn btn-xs btn-warning" title="imprimir"><i class="glyphicon glyphicon-print"></i></a></p>
	</div>

	<div class="panel-body">


	<table class="table">
			<thead align="right">
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
						<td align="left" >{{$fecha[$reporte->mes]}}</td>
						<td align="left" >{{$reporte->urbano}}</td>
						<td align="left" >{{$reporte->rustico}}</td>
						<td align="left" >$ {{number_format($reporte->total,2)}}</td>
						<?php $acum = $acum + $reporte->total;?>
						<td align="left" >$ {{number_format($acum,2)}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	
	</div>
</div>
<div>
@include('folios.reportes.mensual.grafica')
</div>
	@stop