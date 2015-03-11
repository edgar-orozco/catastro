@extends('layouts.default')

@section('content')

<h1>Detalles de Perito</h1>

<div class="panel panel-primary">

	<div class="panel-heading">

		<h4 class="panel-title">Datos del Perito</h4>

	</div>
	<?php $conf =Conf::first(); ?>
	<div class="panel-body">

	<table class="table">
		<tr>
			<th>Tipo de Folio</th>
			<th colspan="2"  align="center">Cantidad Total de Folios Comprados</th>
		</tr>
		<tr>
			<td>{{$perito->corevat}}</td>
			<th>Tipo de Folio</th>
			<th align="center" >Cantidad de Folios</th>
			<th align="center" >Total de ventas</th>
		</tr>
		@if($fu)
		<tr>
			<th>Nombre del Perito</th>
			<th>Urbano</th>
			<td align="center">{{$fu->numero_folio}}</td>
			<td align="right">{{($conf->salario_minimo*$conf->salario_folio_urbano)*$fu->numero_folio}}</td>
		</tr>
		@endif

		@if($fr)
		<tr>
			<td>{{$perito->nombre}}</td>
			<th>Rustico</th>
			<td align="center">{{$fr->numero_folio}}</td>
			<td align="right">{{($conf->salario_minimo*$conf->salario_folio_rustico)*$fr->numero_folio}}</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<th>TOTAL</th>
			<th>{{(($conf->salario_minimo*$conf->salario_folio_urbano)*$fu->numero_folio)+(($conf->salario_minimo*$conf->salario_folio_rustico)*$fr->numero_folio )}}</th>
		</tr>
		@endif
</table>


		<hr>
		<h4>Historial</h4>

		<table class="table">
			<thead>
				<tr>
					<th>Fecha de Solicitud</th>
					<th>Fecha de Oficio</th>
					<th>Número de Recibo</th>
					<th>Cantidad Folios Urbanos</th>
					<th>Cantidad Folios Rústicos</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach($fh as $h)
				<tr>
					<td>{{$h->fecha_solicitud}}</td>
					<td>{{$h->fecha_oficio}}</td>
					<td>{{$h->no_recibo}}</td>
					<td>{{$h->cantidad_urbanos}}</td>
					<td>{{$h->cantidad_rusticos}}</td>
					<td>${{number_format($h->total, 2, '.', '')}}</td>
					
				</tr>
				@endforeach
			</tbody>
		</table>
		
	</div>

	@stop