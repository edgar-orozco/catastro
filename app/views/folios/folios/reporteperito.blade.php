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
?>

<div class="page-header">
    <h3>Reporte de Folios</h3>
    <h4>Hasta {{date("d") . " de " .$mes[date('m')]." del ". date("Y");}}</h4>
</div>

<div class="panel panel-default">

	<div class="panel-heading">

		<h4 class="panel-title">Reporte de Folios<p align="right"></h4>
		Reporte Peritos Saldo: &nbsp;<a href="formatoreporteperito" target="_blank" class="btn btn-xs btn-warning" title="Reimprimir"><i class="glyphicon glyphicon-print"></i></a>
        <span> &nbsp;&nbsp;|&nbsp;&nbsp; </span>
		Reporte Folios - Perito: &nbsp;<a href="formatoreporteperito2" target="_blank" class="btn btn-xs btn-warning" title="Reimprimir"><i class="glyphicon glyphicon-print"></i></a></p>

	</div>

	<div class="panel-body">


	<table class="table">
			<thead>
                <tr>
                    <th>Total entrega folios estatal</th>
                    <th>{{$entrega_estatal}}</th>
                    <th colspan="3"></th>
                </tr>
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
						<td class="text-left">$ {{number_format($totalingresos,'2')}}</td>
					</tr>
				@endforeach
				@foreach ($folios_totales as $totales)
				<tr>
					<td></td>
					<th>TOTAL</th>
					<th align="center">{{$totales->folios_urbanos}}</th>
					<th align="center">{{$totales->folios_rusticos}}</th>
					<th align="center">${{number_format($totales->total,'2')}}</th>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop