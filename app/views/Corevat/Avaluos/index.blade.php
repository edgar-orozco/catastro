@extends('layouts.default')
@section('content')
{{ HTML::style('/css/bootstrap.min.css') }}
{{ HTML::style('/css/dataTables.bootstrap.css') }}
{{ HTML::style('/js/jquery/jquery-ui.css') }}
<div class="row">
	<div class="col-md-10"><h1>Avalúos</h1></div>
	<div class="col-md-2"><h3><a href="{{action('corevat_AvaluosController@create')}}" class="btn btn-primary nuevo" title="Nuevo Avalúo">Nuevo Avalúo</a></h3></div>
	<hr>
</div>
<div class="panel-heading"><h4 class="panel-title">Tabla de Avalúos</h4></div>
<div class="panel-body">
	<table cellpadding="0" cellspacing="0" border="0" class="table datatable  table-striped" id="avaluos-table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Folio</th>
				<th>Fecha</th>
				<th>Solicitante</th>
				<th>Ubicación</th>
				<th>Predial</th>
				<th>Terreno</th>
				<th>Cons.</th>
				<th>Catastral</th>
				<th>Concluido</th>
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($rows as $row)
			<tr>
				<td>{{$row->idavaluo}}</td>
				<td>{{$row->foliocoretemp}}</td>
				<td>{{$row->fecha_avaluo}}</td>
				<td>{{$row->nombre_solicitante}}</td>
				<td>{{$row->ubicacion}}</td>
				<td>{{$row->cuenta_predial}}</td>
				<td>{{$row->superficie_terreno}}</td>
				<td>{{$row->superficie_construccion}}</td>
				<td>{{$row->cuenta_catastral}}</td>
				<td>{{$row->valor_concluido}}</td>
				<td>
					<a href="{{ action('corevat_AvaluosController@editGeneral', ['id'=>$row->idavaluo] )}}" class="btn btn-xs btn-info" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
					<a href="/corevat/AvaluoDel/{{$row->idavaluo}}" class="eliminar btn btn-xs btn-danger" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop
@section('javascript')
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
<script type="text/javascript" charset="utf-8">
	$(document).ready(function () {
		//$('#avaluos-table').dataTable();
		$('#avaluos-table').dataTable({
			"language": {
				"lengthMenu": "Mostrar _MENU_ Registros por página",
				"zeroRecords": "No se encontraron registros",
				"info": "Mostrando pagina _PAGE_ de _PAGES_",
				"infoEmpty": "No hay registros", "search": "Filter records:",
				"search": "Buscar:",
						"infoFiltered": "(Filtrado en _MAX_ total de registros)",
				"oPaginate": {
					"sPrevious": "Anterior",
					"sNext": "Siguiente"
				}
			},
			"ordering": true,
			"searching": false
		});
		$("body").delegate('.eliminar', 'click', function () {
			if (!confirm("¿Seguro que quiere eliminar el registro?")) {
				return false;
			}
		});
	});
</script>
@stop
