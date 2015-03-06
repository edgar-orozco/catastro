@extends('layouts.master')

@section('contenido')
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

<div class="panel panel-primary">

	<div class="panel-heading">

		<h4 class="panel-title">Reporte de Folios<p align="right"></h4>
		<a href="formatoreporteperito" target="_blank" class="btn btn-xs btn-warning" title="Reimprimir"><i class="glyphicon glyphicon-print"></i></a></p>

	</div>

	<div class="panel-body">


	<table class="table datatable">
			<thead>
				<tr>
					<th>Corevat No.</th>
					<th>Perito</th>
					<th>Folios Urbanos</th>
					<th>Folios Rusticos</th>
					<th>Total de Ingresos</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($folios_historial as $folios)
					<tr>
						<td align="left">{{$folios->perito->corevat}}</td>
						<td align="left">{{$folios->perito->nombre}}</td>
						<td align="center">{{$folios->folio_urbano_final}}</td>
						<td align="center">{{$folios->folio_rustico_final}}</td>

						<?php 

							$totalingresos = ($folios->folio_urbano_final*($conf->salario_minimo*$conf->salario_folio_urbano))
							                +($folios->folio_rustico_final*($conf->salario_minimo*$conf->salario_folio_rustico));


						?>
						<td align="center">$ {{number_format($totalingresos,'2')}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop