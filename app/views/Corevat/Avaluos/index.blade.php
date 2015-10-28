@extends('layouts.default')
@section('content')
{{ HTML::style('/css/bootstrap.min.css') }}
{{ HTML::style('/css/dataTables.bootstrap.css') }}
{{ HTML::style('/js/jquery/jquery-ui.css') }}
{{ HTML::style('/css/coverat.css') }}

<div class="modal fade" id="clonarConfirm" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">[COREVAT] Mensaje de confirmación</h4>
			</div>
{{Form::model($row, ['route' => array('clonarAvaluo'), 'class'=>'horizontal', 'method'=>'post', 'id'=>'formAvaluoClonar' ]) }}
{{Form::hidden('idavaluo_clonar', null, ['id'=>'idavaluo_clonar'])}}
			<div class="modal-body" style="min-height: 200px; text-align: left;">
				<h3 id="corevatConfirmContainer"></h3>
				<h2 id="corevatConfirmMessage"></h2>
				<label id="pato" for="folio_corevat">Folio:</label>
				<input type="text" name="folio_corevat" id="folio_corevat" class="form-control" value="" size="30" />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="clonarConfirmButton">Aceptar</button>
				<!-- submit -->
			</div>
{{Form::close()}}
		</div>
	</div>
</div>

<div id="listAvaluos">
	<h3 style="display: block; text-align: center;">Listado de Avalúos</h3>
	<div class="panel-heading" style="padding: 0;">
		<div class="col-md-offset-7 col-md-3 col-sm-3 col-xs-3 btn-beside-title">
			<a href="{{action('printAvaluosByValuador')}}" class="btn btn-success nuevo" title="Avalúos por Valuador" target="_blank">
				<span class="glyphicon glyphicon-briefcase"></span>Últimos Avalúos
			</a>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title" style="border-left:1px solid gray;">
			<a href="{{action('corevat_AvaluosController@create')}}" class="btn btn-primary nuevo" title="Nuevo Avalúo">
				<span class="glyphicon glyphicon-plus-sign"></span>Nuevo Avalúo
			</a>
		</div>
		<div class="clearfix"></div>
	</div>
	<br/>
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
					<td class="idEdit"><a href="{{ action('corevat_AvaluosController@edit', ['id'=>$row->idavaluo] )}}" class="btn btn-xs btn-info" title="Editar">{{$row->idavaluo}}</a></td>
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
						<a href="/corevat/AvaluoDel/{{$row->idavaluo}}" class="eliminar btn btn-xs btn-danger" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
						<a href="/corevat/AvaluoPrint/{{$row->idavaluo}}" target="_blank" class="print btn btn-xs btn-info" title="Imprimir"><i class="glyphicon glyphicon-print"></i></a>
						<a onclick="$.clonarAvaluo({{$row->idavaluo}}, '{{$row->foliocoretemp}}');" class="print btn btn-xs btn-primary" title="Clonar"><i class="glyphicon glyphicon-copy"></i></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop
@section('javascript')
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
<script type="text/javascript" charset="utf-8">
	$(document).ready(function () {
			$('#pato').hide();
			$('#folio_corevat').hide().val('');
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
			"ordering": false,
			"searching": false
		});
		
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$("body").delegate('.eliminar', 'click', function () {
			if (!confirm("¿Seguro que quiere eliminar el registro?")) {
				return false;
			}
		});
		
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * <h3 id="corevatConfirmContainer"></h3>
		++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$.clonarAvaluo = function(id, folio) {
			$('#idavaluo_clonar').val(id);
			$('#corevatConfirmContainer').empty().append('<h2>¿Realmente desea clonar el avalúo?...</h2>');
			$('#corevatConfirmMessage').empty().append('Folio: ' + folio);
			$('#clonarConfirm').modal('show');
		}
		//formAvaluoClonar
		
		$("#clonarConfirmButton").click(function(){
			$('#corevatConfirmContainer').empty().hide();
			$('#corevatConfirmMessage').empty().hide();
			$('#pato').show();
			$('#folio_corevat').show().val('');
		});
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: '/corevat/AvaluoClonar',
			type: 'post',
			data: id: id,
			success: function (data) {
				datos = eval(data);
			}
		});
		++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	});
</script>
@stop
