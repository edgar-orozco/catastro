@extends('layouts.default')

@section('content')


<div class="page-header">
    <h3>Detalles de Perito</h3>
</div>

<div class="panel panel-default">

	<div class="panel-heading">

		<h4 class="panel-title">Datos del Perito</h4>

	</div>
	<?php $conf = FoliosConf::first();

	 ?>
	<div class="panel-body">

	<table class="table">
        <tr style="background-color: #e3e3e3; color: #333;">
			<th>Tipo de Folio</th>
			<th colspan="3"  align="center">Cantidad Total de Folios Comprados</th>
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
			<td align="left">{{$fu->numero_folio}}</td>
			<td align="left">${{number_format((($conf->salario_minimo*$conf->salario_folio_urbano)*$fu->numero_folio),2)}}</td>
		</tr>
		@endif

		@if($fr)
		<tr>
			<td>{{$perito->nombre}}</td>
			<th>Rustico</th>
			<td align="left">{{$fr->numero_folio}}</td>
			<td align="left">${{number_format((($conf->salario_minimo*$conf->salario_folio_rustico)*$fr->numero_folio),2)}}</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<th>TOTAL</th>
			<th>${{number_format(((($conf->salario_minimo*$conf->salario_folio_urbano)*$fu->numero_folio)+(($conf->salario_minimo*$conf->salario_folio_rustico)*$fr->numero_folio )),2)}}</th>
		</tr>
		@endif
		<tr style="background-color: #e3e3e3; color: #333;">
			<th></th>
			<th colspan="3"  align="center">Cantidad Total de Folios Reportados</th>
		</tr>
		<tr>
			<td></td>
			<th>Tipo de Folio</th>
			<th align="center" >Cantidad de Folios</th>
			<th align="center" >Ultima Entrega</th>
		</tr>
		@foreach( $fe as $e)
		<tr>
			<th></th>
			@if($e->tipo_folio == "U")
			<th>Urbano</th>
			@else
			<th>Rustico</th>
			@endif
			<td align="center">{{$e->entrega}}</td>
			<td align="center">{{$e->fecha}}</td>
		</tr>
		@endforeach
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
					<td style="text-align: left;">${{number_format($h->total, 2, '.', '')}}</td>
					
				</tr>
				@endforeach
			</tbody>
		</table>
		
	</div>

	@stop