@extends('layouts.master')

@section('contenido')

<div class="page-header">
    <h3>Detalles de Perito</h3>
</div>

<div class="panel panel-default">

	<div class="panel-heading">

		<h4 class="panel-title">Datos del Perito</h4>

	</div>

	<div class="panel-body">
	
		<label>COREVAT</label>
		<h5>{{$perito->corevat}}</h5>

		<label>NOMBRE</label>
		<h5>{{$perito->nombre}}</h5>

		<hr>
		<h4>Folios Urbanos</h4>
		{{Form::open()}}
		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th>Folio</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
				@foreach($fu as $u)
				<tr>
					<td>
						@if($u->entrega_estatal == 0)
						{{Form::checkbox('urbanos[]', $u->numero_folio)}}
						@endif
					</td>
					<td>{{$u->numero_folio}}</td>
					<td>
					@if($u->entrega_estatal == 0)
						Vigente
					@else
						Usado
					@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<hr>
		<h4>Folios Rústicos</h4>

		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th>Folio</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
				@foreach($fr as $r)
				<tr>
					<td>
					@if($r->entrega_estatal == 0)
					{{Form::checkbox('rusticos[]', $r->numero_folio)}}
					@endif
					</td>
					<td>{{$r->numero_folio}}</td>
					<td>
					@if($r->entrega_estatal == 0)
						Vigente
					@else
						Usado
					@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{Form::submit('Guardar', ['class'=>'btn btn-success'])}}
		{{Form::close()}}
	</div>

	@stop