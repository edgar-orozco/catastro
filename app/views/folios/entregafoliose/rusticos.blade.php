@extends('layouts.default')

@section('content')

<h1></h1>

<div class="panel panel-primary">

	<div class="panel-heading">

		<h2 class="panel-title">FOLIOS RUSTICOS AUTORIZADOS PARA</h2>

	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-md-3">
				<label>COREVAT</label>
				<h5>{{$perito->corevat}}</h5>
			</div>
			<div class="col-md-3">
				<label>NOMBRE</label>
				<h5>{{$perito->nombre}}</h5>				
			</div>
		</div>
		
		{{Form::open()}}
		<table class="table datatable">
			<thead>
				<tr>
					
					<!--<th>{{Form::checkbox('', '', '', ['id'=>'todos'])}}</th>-->
					<th>Marcar Folio Presentado</th>
					<th>Folio Autorizados</th>
					<th>Recibido Por:</th>
					<th>Fecha de Entrega Estatal</th>
					<th>Entregado en el municipio de:</th>
					<th>Fecha de Entrega Municipal</th>
					<th>Estado del Folio</th>
				</tr>
			</thead>
			<tbody>
				@foreach($fr as $r)
					<tr>
						<td align="center"> 
							@if($r->entrega_estatal == 0)
								{{Form::checkbox('rusticos[]', $r->numero_folio, '', ['class'=>'checkbox'])}}
							@endif
						</td>

						<?php
							$input = $r->numero_folio;
							$input = str_pad($input, 4, "0", STR_PAD_LEFT);
						?>
						
						<td>{{$perito->corevat."-".$input.$r->tipo_folio."-15"}}</td>
						<td align="center">
							@if($r->entrega_estatal == 1)
								{{$r->usuario->nombre}}
							@endif
						</td>
						<td align="center">
							@if($r->entrega_estatal == 1)
								{{$r->fecha_entrega_e}}
							@endif
						</td>
						<td align="center">
							@if($r->entrega_municipal == 1)
								{{$r->municipio->municipio}}
							@endif
						</td>
						<td align="center">
							@if($r->entrega_municipal == 1)
								{{$r->fecha_entrega_m}}
							@endif
						</td>
						<td align="center">
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

	@section('javascript')

	<script type="text/javascript">

	$(document).ready(function(){

		$("#todos").change(function(){

			if($(this).is(':checked')){

				$(".checkbox").prop('checked', 'checked');

			} else {

				$(".checkbox").attr('checked', false);				

			}

		});

	});

	</script>

	@stop