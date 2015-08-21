@extends('layouts.default')

@section('content')
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

<div class="page-header">
    <h3>Reporte de Folios Anual</h3>
</div>

<div class="panel panel-default">
	<div class="panel-heading">

		<h4 class="panel-title">Reporte Total de Folios </h4>
		<a href="formatoreportetotal" target="_blank" class="btn btn-xs btn-warning" title="Reimprimir"><i class="glyphicon glyphicon-print"></i></a></p>


	</div>

	<div class="panel-body">


	<table class="table">
			<thead>
				<tr>
					<th>Año</th>
					<th>Ultimo Folio Comprado</th>
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
						<td align="center">{{$folios->year}}</td>
						<td align="center">{{$folios->fecha_oficio}}</td>
						<td align="center">{{$folios->folios_urbanos}}</td>
						<td align="center">{{$folios->folios_rustico}}</td>
						<td align="center">$ {{number_format($folios->total_urbano, '2')}}</td>
						<td align="center">$ {{number_format($folios->total_rustico, '2')}}</td>
						<td align="center">$ {{number_format($folios->total,'2')}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	
	</div>
</div>
	@stop