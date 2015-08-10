<h3 class="header">{{$title}}</h3>
<hr>
{{Form::model($row, ['route' => array('updateAvaluoEnfoqueMercado', $idavaluo), 'method'=>'post', 'id'=>'formAvaluoMercado' ]) }}
{{Form::hidden('idavaluoenfoquemercado', $row->idavaluoenfoquemercado, ['id'=>'idavaluoenfoquemercado'])}}
<div class="row">
	<div class="col-md-12"><h2>Venta de Terrenos</h2></div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-10"><h4>Investigación de Terrenos Comparables</h4></div>
    <div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title">
        <a class="btn nuevo" id="btnNewAemComp" title="Nuevo Registro">
            <span class="glyphicon glyphicon-plus-sign"></span>
            Nuevo
        </a>
    </div>
    <br/>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aemCompTerrenosDataTable">
			<thead>
				<tr>
					<th colspan="7"></th>
					<th colspan="2">OPCIONES</th>
				</tr>
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>UBICACIÓN</th>
					<th>PRECIO</th>
					<th>SUP. TERRENO</th>
					<th>P.U. M&sup2;</th>
					<th>OBSERVACIÓN</th>
					<th style="width:5%;"></th>
					<th style="width:5%;"></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>

    <div class="col-md-12"><hr></div>

	<div class="col-md-12"><h4>Homologación del Terreno en función del lote tipo o predominante en la zona...</h4></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aemHomologacionDataTable">
			<thead>
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>COMPARABLE</th>
					<th>SUP.</th>
					<th>V. UNIT.</th>
					<th>ZONA;</th>
					<th>UBICACIÓN</th>
					<th>FRENTE</th>
					<th>FORMA</th>
					<th>SUPERFICIE</th>
					<th>NEGOCIACIÓN</th>
					<th>RESULT. ($/m&sup2;)</th>
					<th>OPCIONES</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-default" colspan="6">&nbsp;</td>
					<td class="bg-default" colspan="4" style="text-align: right;">Valor Unitario Promedio ($/m&sup2;)</td>
					<td class="bg-info" colspan="2" id="valor_unitario_promedio">{{$row->valor_unitario_promedio}}</td>
					<td class="bg-default">&nbsp;</td>
				</tr>
				<tr>
					<td class="bg-default" colspan="6">&nbsp;</td>
					<td class="bg-default" colspan="4" style="text-align: right;">Valor Aplicado por M&sup2;</td>
					<td class="bg-info" colspan="2" id="valor_aplicado_m2">{{$row->valor_aplicado_m2}}</td>
					<td class="bg-default">&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12"><h2>Venta de Inmuebles</h2></div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-10">
        <h4>Venta de inmuebles similares en uso al que se valua(sujeto)</h4></div>
    <div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title">
        <a class="btn btn-primary nuevo" id="btnNewAemInf" title="Nuevo Registro">
            <span class="glyphicon glyphicon-plus-sign"></span>
            Nuevo
        </a>
    </div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aemInformacionDataTable">
			<thead>
				<tr>
					<th colspan="6"></th>
					<th colspan="2">OPCIONES</th>
				</tr>
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>UBICACIÓN</th>
					<th>EDAD</th>
					<th>TELÉFONO</th>
					<th>OBSERVACIONES</th>
					<th style="width:5%;"></th>
					<th style="width:5%;"></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
					<td class="bg-default">&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12"><h3>Análisis por Homologación de Mercado</h3></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aemAnalisisDataTable">
			<thead>
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>PRECIO</th>
					<th>SUP. TERR.</th>
					<th>SUP. CONS.</th>
					<th>V.U. ($/m&sup2;)</th>
					<th>ZONA</th>
					<th>UBIC.</th>
					<th>F. SUP.</th>
					<th>F. EDAD</th>
					<th>F. CONS.</th>
					<th>F. NEGA.</th>
					<th>F. FR.</th>
					<th>RESULT. ($/m&sup2;</th>
					<th>&nbsp;</th>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-default" colspan="8">&nbsp;</td>
					<td class="bg-default" colspan="5" style="text-align: right;">Promedio:</td>
					<td class="bg-info" id="promedio_analisis">{{$row->promedio_analisis}}</td>
					<td class="bg-default">&nbsp;</td>
				</tr>
				<tr>
					<td class="bg-default" colspan="8">&nbsp;</td>
					<td class="bg-default" colspan="5" style="text-align: right;">Superficie Construida del Sujeto:</td>
					<td class="bg-info" id="superficie_construida">{{$row->superficie_construida}}</td>
					<td class="bg-default">&nbsp;</td>
				</tr>
				<tr>
					<td class="bg-default" colspan="8">&nbsp;</td>
					<td class="bg-default" colspan="5" style="text-align: right;">Valor comparativo de mercado:</td>
					<td class="bg-info" id="valor_comparativo_mercado">{{$row->valor_comparativo_mercado}}</td>
					<td class="bg-default">&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12 form-actions">
		<a href="{{URL::route('indexAvaluos')}}" class="btn btn-primary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	</div>
	
</div>
{{Form::close()}}
<div id="divDialogFormMercado" style="display: none;">
	{{Form::model($row, ['route' => array('updateAvaluoEnfoqueMercado', $idavaluo), 'method'=>'post', 'id'=>'formDialogMercado' ]) }}
		{{Form::hidden('ctrl', '', ['id'=>'ctrl'])}}
		{{Form::hidden('idAem', $row->idavaluoenfoquemercado, ['id'=>'idAem'])}}
		{{Form::hidden('idTable', '', ['id'=>'idTable'])}}

		<div class="row" id="containerDialogForm" style="margin-top: 10px;"></div>
		
		<div style="text-align: center; margin-top: 10px;" id="messagesDialogForm"></div>
		
	{{Form::close()}}
</div>
<div id="divDialogConfirm" style="display: none;">
	{{Form::model($row, ['route' => array('delAvaluoEnfoqueMercado', $idavaluo), 'method'=>'post', 'id'=>'formDialogConfirm' ]) }}
		{{Form::hidden('ctrlDel', '', ['id'=>'ctrlDel'])}}
		{{Form::hidden('idAemDel', $row->idavaluoenfoquemercado, ['id'=>'idAemDel'])}}
		{{Form::hidden('idTableDel', '', ['id'=>'idTableDel'])}}

		<div class="alert alert-danger text-center"><h3>¿Realmente desea eliminar el registro?</h3></div>
		
	{{Form::close()}}
</div>
@section('javascript')
{{ HTML::script('/js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
{{ HTML::script('/js/jquery.corevat.js') }}
{{ HTML::script('/js/jquery.corevat.mercado.js') }}
<script>
    $(document).ready(function () {
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btn3EnfoqueMercado').removeClass("btn-info").addClass("btn-primary");

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	*  
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	var aemCompTerrenosDataTable = $('#aemCompTerrenosDataTable').DataTable({
		language: {
			lengthMenu: "Mostrar _MENU_ Registros por página",
			zeroRecords: "No se encontraron registros",
			info: "Mostrando pagina _PAGE_ de _PAGES_",
			infoEmpty: "No hay registros", "search": "Filter records:",
			search: "Buscar: ", "infoFiltered": "(Filtrado en _MAX_ total de registros)",
			oPaginate: {
				sPrevious: "Anterior",
				sNext: "Siguiente"
			}
		},
		ordering: true,
		searching: false,
		lengthMenu: [10, 20, 30]
	});
	aemCompTerrenosDataTable.ajax.url( '/corevat/AemCompTerrenosGetAjax/' + $("#idavaluoenfoquemercado").val() ).load();

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	*  
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	var aemHomologacionDataTable = $('#aemHomologacionDataTable').DataTable({
		language: {
			lengthMenu: "Mostrar _MENU_ Registros por página",
			zeroRecords: "No se encontraron registros",
			info: "Mostrando pagina _PAGE_ de _PAGES_",
			infoEmpty: "No hay registros", "search": "Filter records:",
			search: "Buscar: ", "infoFiltered": "(Filtrado en _MAX_ total de registros)",
			oPaginate: {
				sPrevious: "Anterior",
				sNext: "Siguiente"
			}
		},
		ordering: true,
		searching: false,
		lengthMenu: [10, 20, 30]
	});
	aemHomologacionDataTable.ajax.url( '/corevat/AemHomologacionGetAjax/' + $("#idavaluoenfoquemercado").val() ).load();

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	*  
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	var aemInformacionDataTable = $('#aemInformacionDataTable').DataTable({
		language: {
			lengthMenu: "Mostrar _MENU_ Registros por página",
			zeroRecords: "No se encontraron registros",
			info: "Mostrando pagina _PAGE_ de _PAGES_",
			infoEmpty: "No hay registros", "search": "Filter records:",
			search: "Buscar: ", "infoFiltered": "(Filtrado en _MAX_ total de registros)",
			oPaginate: {
				sPrevious: "Anterior",
				sNext: "Siguiente"
			}
		},
		ordering: true,
		searching: false,
		lengthMenu: [10, 20, 30]
	});
	aemInformacionDataTable.ajax.url( '/corevat/AemInformacionGetAjax/' + $("#idavaluoenfoquemercado").val() ).load();

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	*  
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	var aemAnalisisDataTable = $('#aemAnalisisDataTable').DataTable({
		language: {
			lengthMenu: "Mostrar _MENU_ Registros por página",
			zeroRecords: "No se encontraron registros",
			info: "Mostrando pagina _PAGE_ de _PAGES_",
			infoEmpty: "No hay registros", "search": "Filter records:",
			search: "Buscar: ", "infoFiltered": "(Filtrado en _MAX_ total de registros)",
			oPaginate: {
				sPrevious: "Anterior",
				sNext: "Siguiente"
			}
		},
		ordering: true,
		searching: false,
		lengthMenu: [10, 20, 30]
	});
	aemAnalisisDataTable.ajax.url( '/corevat/AemAnalisisGetAjax/' + $("#idavaluoenfoquemercado").val() ).load();

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNewAemComp').click(function () {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnNewAemComp');
		$('#idTable').val( '0' );
		$('#containerDialogForm').empty();
		$.createFormAemCompTerrenos();
		$('#divDialogFormMercado').dialog({title: 'Nuevo Registro Comparable'}).dialog('open');
	});
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNewAemInf').click(function () {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnNewAemInf');
		$('#idTable').val( '0' );
		$('#containerDialogForm').empty();
		$.createFormAemInformacion();
		$('#divDialogFormMercado').dialog({title: 'Nuevo Registro Comparable Mercado'}).dialog('open');
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAemCompTerrenos = function(id) {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnEditAemComp');
		$('#idTable').val( id );
		$('#containerDialogForm').empty();
		$.createFormAemCompTerrenos();
		$.loadFormAemCompTerrenos(id);
		$('#divDialogFormMercado').dialog({title: 'Modificar Registro Comparable: ' + id }).dialog('open');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAemHomologacion = function(id) {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnEditAemHom');
		$('#idTable').val( id );
		$('#containerDialogForm').empty();
		$.createFormAemHomologacion();
		$.loadFormAemHomologacion(id);
		$('#divDialogFormMercado').dialog({title: 'Homologable: ' + id }).dialog('open');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAemInformacion = function(id) {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnEditAemInf');
		$('#idTable').val( id );
		$('#containerDialogForm').empty();
		$.createFormAemInformacion();
		$.loadFormAemInformacion(id);
		$('#divDialogFormMercado').dialog({title: 'Modificar Registro Comparable Mercado: ' + id }).dialog('open');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAemAnalisis = function(id) {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnEditAemAna');
		$('#idTable').val( id );
		$('#containerDialogForm').empty();
		$.createFormAemAnalisis();
		$.loadFormAemAnalisis(id);
		$('#divDialogFormMercado').dialog({title: 'Homologable: ' + id }).dialog('open');
	};

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$.delAemCompTerrenos = function(id) {
			$('#ctrlDel').val('btnDelAemComp');
			$('#idTableDel').val( id );
			$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');
		}
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$.delAemInformacion = function(id) {
			$('#ctrlDel').val('btnDelAemInf');
			$('#idTableDel').val( id );
			$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');
		}

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		$('.btnEditAemComp').click(function () {
			$('#messagesDialogForm').empty().removeClass();
			$('#ctrl').val('btnEditAemComp');
			$('#idTable').val( $(this).attr('idTable') );
			$('#containerDialogForm').empty();
			$.createFormAemCompTerrenos();
			$.loadFormAemCompTerrenos();
			$('#divDialogFormMercado').dialog({title: 'Modificar Registro Comparable: ' + $(this).attr('idTable') }).dialog('open');
		});
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		$('.btnDelAemComp').click(function () {
			$('#ctrlDel').val('btnDelAemComp');
			$('#idTableDel').val( $(this).attr('idTable') );
			$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');
		});
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		$('.btnEditAemHom').click(function () {
			$('#messagesDialogForm').empty().removeClass();
			$('#ctrl').val('btnEditAemHom');
			$('#idTable').val( $(this).attr('idTable') );
			$('#containerDialogForm').empty();
			$.createFormAemHomologacion();
			$.loadFormAemHomologacion();
			$('#divDialogFormMercado').dialog({title: 'Homologable: ' + $(this).attr('idTable') }).dialog('open');
		});
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		$('.btnEditAemInf').click(function () {
			$('#messagesDialogForm').empty().removeClass();
			$('#ctrl').val('btnEditAemInf');
			$('#idTable').val( $(this).attr('idTable') );
			$('#containerDialogForm').empty();
			$.createFormAemInformacion();
			$.loadFormAemInformacion();
			// $.loadFormAemAnaInformacion();
			$('#divDialogFormMercado').dialog({title: 'Modificar Registro Comparable Mercado: ' + $(this).attr('idTable') }).dialog('open');
		});
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		$('.btnDelAemInf').click(function () {
			$('#ctrlDel').val('btnDelAemInf');
			$('#idTableDel').val( $(this).attr('idTable') );
			$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');
		});
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
        $('.btnEditAemAna').click(function () {
			$('#messagesDialogForm').empty().removeClass();
			$('#ctrl').val('btnEditAemAna');
			$('#idTable').val( $(this).attr('idTable') );
			$('#containerDialogForm').empty();
			$.createFormAemAnalisis();
			$.loadFormAemAnalisis();
			$('#divDialogFormMercado').dialog({title: 'Homologable: ' + $(this).attr('idTable') }).dialog('open');
		});
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('#divDialogFormMercado').dialog({
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			closeOnEscape: true,
			width: 900,
			height: 600,
			buttons: {
				Guardar: function () {
					$("#formDialogMercado").submit();
				},
				Cerrar: function () {
					$(this).dialog('close');
				}
			},
			close: function() {
				if ( $('#messagesDialogForm').attr('class') == 'alert alert-success' ) {
					//window.location.href = '/corevat/AvaluoEnfoqueMercado/<?php echo $row->idavaluo ?>';
				}
			}
		});

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$("#formDialogMercado").submit(function () {
			$('#messagesDialogForm').empty().removeClass();
			$.ajax({
				global: false,
				cache: false,
				dataType: 'json',
				url: $(this).attr("action"),
				type: $(this).attr("method"),
				data: $(this).serialize(),
				success: function (data) {
					datos = eval(data);
					if (datos.success) {
						$('#messagesDialogForm').removeClass().addClass('alert').addClass('alert-success').append(datos.message);
						//$('#idTable').val( datos.idTable );
						//$('#ctrl').val( datos.ctrl );
						if (  $('#ctrl').val() === 'btnNewAemComp' ) {
							$('#containerDialogForm').empty();
							$.createFormAemCompTerrenos();
						}
						if ( $('#ctrl').val() === 'btnNewAemInf' ) {
							$('#containerDialogForm').empty();
							$.createFormAemInformacion();
						}
						if ( $('#ctrl').val() === 'btnNewAemComp' || $('#ctrl').val() === 'btnEditAemComp' ) {
							aemCompTerrenosDataTable.ajax.reload();
							aemHomologacionDataTable.ajax.reload();

						} else if ( $('#ctrl').val() === 'btnEditAemHom' ) {
							aemHomologacionDataTable.ajax.reload();
							$('#valor_unitario_promedio').empty().append(datos.valor_unitario_promedio);
							$('#valor_aplicado_m2').empty().append(datos.valor_aplicado_m2);

						} else if ( $('#ctrl').val() === 'btnNewAemInf' || $('#ctrl').val() === 'btnEditAemInf' ) {
							aemInformacionDataTable.ajax.reload();
							aemAnalisisDataTable.ajax.reload();

						} else if ( $('#ctrl').val() === 'btnEditAemAna' ) {
							aemAnalisisDataTable.ajax.reload();
							$('#promedio_analisis').empty().append(datos.promedio_analisis);
							$('#superficie_construida').empty().append(datos.superficie_construida);
							$('#valor_comparativo_mercado').empty().append(datos.valor_comparativo_mercado);

						}
					} else {
						var errores = '';
						for(datos in data.errors) {
							errores += '<p>' + data.errors[datos] + '</p>';
						}
						$('#messagesDialogForm').removeClass().addClass('alert').addClass('alert-danger').append(errores);
					}
				}
			});
			return false;
        });

        /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
         * 
         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('#divDialogConfirm').dialog({
            modal: true,
            resizable: false,
            draggable: false,
            autoOpen: false,
            closeOnEscape: true,
            width: 600,
            height: 400,
			buttons: {
				Aceptar: function() {
					$("#formDialogConfirm").submit();
				},
				Cancelar: function() {$(this).dialog('close');}
			}
		});
		//
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$("#formDialogConfirm").submit(function () {
			$.ajax({
				global: false,
				cache: false,
				dataType: 'json',
				url: $(this).attr("action"),
				type: $(this).attr("method"),
				data: $(this).serialize(),
				success: function (data) {
					datos = eval(data);
					alert( datos.message );
					if (datos.success === true) {
						if ( $('#ctrlDel').val() === 'btnDelAemComp') {
							aemCompTerrenosDataTable.ajax.reload();
							aemHomologacionDataTable.ajax.reload();
						} else if ( $('#ctrlDel').val() === 'btnDelAemInf' ) {
							aemInformacionDataTable.ajax.reload();
							aemAnalisisDataTable.ajax.reload();
						}
					}
				}
			});
			return false;
        });


    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAemCompTerrenos = function () {
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="ubicacion">Ubicación:</label>').appendTo(div);
        $('<input type="text" name="ubicacion" id="ubicacion" value="" maxlength="200"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="precio">Precio:</label>').appendTo(div);
        $('<input type="number" name="precio" id="precio" value="0.00" min="0.00" max="99999999.99" step="0.01" size="11" pattern="[0-9]{8}[.]{1}[0-9]{2}" style="width:200px;" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="superficie_terreno">Superficie del Terreno:</label>').appendTo(div);
        $('<input type="number" name="superficie_terreno" id="superficie_terreno" value="0.00" min="0.00" max="9999999.99" step="0.01" size="11" pattern="[0-9]{8}[.]{1}[0-9]{2}" style="width:200px;" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="precio_unitario_m2_terreno">Precio Unitario M&sup2; Terreno:</label>').appendTo(div);
        $('<input type="text" name="precio_unitario_m2_terreno" id="precio_unitario_m2_terreno" size="11" style="width:200px;" />').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="observaciones">Observaciones:</label>').appendTo(div);
        $('<input type="text" name="observaciones" id="observaciones" value="" maxlength="100"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        $("input[type=number]").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });


    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAemHomologacion = function () {
        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="comparable">Comparable:</label>').appendTo(div);
        $('<input type="text" name="comparable" id="comparable"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="superficie_terreno">Superficie del Terreno:</label>').appendTo(div);
        $('<input type="text" name="superficie_terreno" id="superficie_terreno"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_unitario">Valor Unitario:</label>').appendTo(div);
        $('<input type="text" name="valor_unitario" id="valor_unitario"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="idfactorzona">Zona:</label>').appendTo(div);
		$('<select id="idfactorzona" name="idfactorzona"><//select>').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="idfactorubicacion">Ubicación:</label>').appendTo(div);
		$('<select id="idfactorubicacion" name="idfactorubicacion"><//select>').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="idfactorfrente">Frente:</label>').appendTo(div);
		$('<select id="idfactorfrente" name="idfactorfrente"><//select>').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="idfactorforma">Forma:</label>').appendTo(div);
		$('<select id="idfactorforma" name="idfactorforma"><//select>').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="superficie">Superficie:</label>').appendTo(div);
        $('<input type="text" name="superficie" id="superficie"/>').attr('readonly', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_unitario_negociable">Negociación:</label>').appendTo(div);
        $('<input type="number" name="valor_unitario_negociable" id="valor_unitario_negociable" value="0.00" min="0.00" max="0.99º" step="0.01" regex="[0]{1}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_unitario_resultante_m2">Resultante ($/m&sup2;):</label>').appendTo(div);
        $('<input type="text" name="valor_unitario_resultante_m2" id="valor_unitario_resultante_m2"/>').attr('readonly', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="in_promedio">Interviene en el Promedio:</label>').appendTo(div);
        $('<input type="checkbox" name="in_promedio" id="in_promedio" />').appendTo(div);
        div.appendTo('#containerDialogForm');

    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAemInformacion = function () {
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="ubicacion">Ubicacion:</label>').appendTo(div);
        $('<input type="text" name="ubicacion" id="ubicacion" value="" maxlength="200"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="edad">Edad:</label>').appendTo(div);
        $('<input type="number" name="edad" id="edad" value="0" min="0" max="9999999" step="1" pattern="[0-9]{1,3}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="telefono">Teléfono:</label>').appendTo(div);
        $('<input type="text" name="telefono" id="telefono" value="" maxlength="100"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="observaciones">Observaciones:</label>').appendTo(div);
        $('<input type="text" name="observaciones" id="observaciones" value="" maxlength="100"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        $("input[type=number]").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });


    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAemAnalisis = function () {
        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="precio_venta">Precio de Venta:</label>').appendTo(div);
        $('<input type="number" name="precio_venta" id="precio_venta" value="0.00" min="0.00" max="9999999999999.99" step="0.01" pattern="[0-9]{1,13}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="superficie_terreno">Superficie del Terreno:</label>').appendTo(div);
        $('<input type="number" name="superficie_terreno" id="superficie_terreno" value="0.00" min="0.00" max="9999999999999.99" step="0.01" pattern="[0-9]{1,13}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="superficie_construccion">Superficie de la Construcción:</label>').appendTo(div);
        $('<input type="number" name="superficie_construccion" id="superficie_construccion" value="0.00" min="0.00" max="9999999999999.99" step="0.01" pattern="[0-9]{1,13}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_unitario_m2">Valor Unitario ($/m&sup2;):</label>').appendTo(div);
        $('<input type="text" name="valor_unitario_m2" id="valor_unitario_m2"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="idfactorzona">Zona:</label>').appendTo(div);
        $('<select name="idfactorzona" id="idfactorzona"/>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="idfactorubicacion">Ubicación:</label>').appendTo(div);
        $('<select name="idfactorubicacion" id="idfactorubicacion"/>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_superficie">Factor Superficie:</label>').appendTo(div);
        $('<input type="number" name="factor_superficie" id="factor_superficie" value="0.00" min="0.00" max="100.00" step="0.01" pattern="[0-9]{1,3}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_edad">Factor Edad:</label>').appendTo(div);
        $('<input type="number" name="factor_edad" id="factor_edad" value="0.00" min="0.00" max="99999999.99" step="0.01" pattern="[0-9]{1,8}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="idfactorconservacion">Conservación:</label>').appendTo(div);
        $('<select name="idfactorconservacion" id="idfactorconservacion"/>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_negociacion">Negociación:</label>').appendTo(div);
        $('<input type="number" name="factor_negociacion" id="factor_negociacion" value="0.00" min="0.00" max="100.00º" step="0.01" pattern="[0-9]{1,3}[.]{1}[0-9]{2}"/>').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="factor_resultante">Factor Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="valor_unitario_resultante_m2">Resultante ($/m&sup2;):</label>').appendTo(div);
        $('<input type="text" name="valor_unitario_resultante_m2" id="valor_unitario_resultante_m2"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-12');
        $('<label for="in_promedio">Interviene en el Promedio:</label>').appendTo(div);
        $('<input type="checkbox" name="in_promedio" id="in_promedio" />').appendTo(div);
        div.appendTo('#containerDialogForm');

    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAemCompTerrenos = function (id) {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AemCompTerrenosGet/' + id,
            type: 'get',
            success: function (data) {
                datos = eval(data);
                $('#ubicacion').val(datos.ubicacion);
                $('#precio').val(datos.precio);
                $('#superficie_terreno').val(datos.superficie_terreno);
                $('#precio_unitario_m2_terreno').val(datos.precio_unitario_m2_terreno);
                $('#observaciones').val(datos.observaciones);
            }
        });

    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAemHomologacion = function (id) {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AemHomologacionGet/' + id,
            type: 'get',
            success: function (data) {
                datos = eval(data);
                $('#comparable').val(datos.comparable);
                $('#superficie_terreno').val(datos.superficie_terreno);
                $('#valor_unitario').val(datos.valor_unitario);
				
				for (var i = 0; i < datos.cat_factores_zonas.length; i++) {
					$('<option value="' + datos.cat_factores_zonas[i].idfactorzona + '">('+ datos.cat_factores_zonas[i].valor_factor_zona  + ') ' + datos.cat_factores_zonas[i].factor_zona + '</option>').appendTo('#idfactorzona');
				}
                $("#idfactorzona option[value=" + datos.idfactorzona + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_ubicacion.length; i++) {
					$('<option value="' + datos.cat_factores_ubicacion[i].idfactorubicacion + '">('+ datos.cat_factores_ubicacion[i].valor_factor_ubicacion  + ') ' + datos.cat_factores_ubicacion[i].factor_ubicacion + '</option>').appendTo('#idfactorubicacion');
				}
                $("#idfactorubicacion option[value=" + datos.idfactorubicacion + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_frente.length; i++) {
					$('<option value="' + datos.cat_factores_frente[i].idfactorfrente + '">('+ datos.cat_factores_frente[i].valor_factor_frente  + ') ' + datos.cat_factores_frente[i].factor_frente + '</option>').appendTo('#idfactorfrente');
				}
                $("#idfactorfrente option[value=" + datos.idfactorfrente + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_forma.length; i++) {
					$('<option value="' + datos.cat_factores_forma[i].idfactorforma + '">('+ datos.cat_factores_forma[i].valor_factor_forma  + ') ' + datos.cat_factores_forma[i].factor_forma + '</option>').appendTo('#idfactorforma');
				}
                $("#idfactorforma option[value=" + datos.idfactorforma + "]").attr("selected", true);
				
                $('#superficie').val(datos.superficie);
                $('#valor_unitario_negociable').val(datos.valor_unitario_negociable);
                $('#valor_unitario_resultante_m2').val(datos.valor_unitario_resultante_m2);
				$('#in_promedio').prop('checked',  (datos.in_promedio === 1 ? true:false) );
            }
        });
    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAemInformacion = function (id) {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AemInformacionGet/' + id,
            type: 'get',
            success: function (data) {
                datos = eval(data);
                $('#ubicacion').val(datos.ubicacion);
                $('#edad').val(datos.edad);
                $('#telefono').val(datos.telefono);
                $('#observaciones').val(datos.observaciones);

            }
        });
    };

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAemAnalisis = function (id) {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AemAnalisisGet/' + id,
            type: 'get',
            success: function (data) {
                datos = eval(data);
                $('#precio_venta').val(datos.precio_venta);
                $('#superficie_terreno').val(datos.superficie_terreno);
                $('#superficie_construccion').val(datos.superficie_construccion);
                $('#valor_unitario_m2').val(datos.valor_unitario_m2);
				
				for (var i = 0; i < datos.cat_factores_zonas.length; i++) {
					$('<option value="' + datos.cat_factores_zonas[i].idfactorzona + '">('+ datos.cat_factores_zonas[i].valor_factor_zona  + ') ' + datos.cat_factores_zonas[i].factor_zona + '</option>').appendTo('#idfactorzona');
				}
                $("#idfactorzona option[value=" + datos.idfactorzona + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_ubicacion.length; i++) {
					$('<option value="' + datos.cat_factores_ubicacion[i].idfactorubicacion + '">('+ datos.cat_factores_ubicacion[i].valor_factor_ubicacion  + ') ' + datos.cat_factores_ubicacion[i].factor_ubicacion + '</option>').appendTo('#idfactorubicacion');
				}
                $("#idfactorubicacion option[value=" + datos.idfactorubicacion + "]").attr("selected", true);
				
                $('#factor_superficie').val(datos.factor_superficie);
                $('#factor_edad').val(datos.factor_edad);
				
				for (var i = 0; i < datos.cat_factores_conservacion.length; i++) {
					$('<option value="' + datos.cat_factores_conservacion[i].idfactorconservacion + '">('+ datos.cat_factores_conservacion[i].valor_factor_conservacion  + ') ' + datos.cat_factores_conservacion[i].factor_conservacion + '</option>').appendTo('#idfactorconservacion');
				}
                $("#idfactorconservacion option[value=" + datos.idfactorconservacion + "]").attr("selected", true);
				
                $('#factor_negociacion').val(datos.factor_negociacion);
                $('#factor_resultante').val(datos.factor_resultante);
                $('#valor_unitario_resultante_m2').val(datos.valor_unitario_resultante_m2);
				$('#in_promedio').prop('checked',  (datos.in_promedio === 1 ? true:false) );
            }
        });
    };

    


    });
</script>
@stop
