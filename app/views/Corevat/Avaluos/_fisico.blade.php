<h3 class="header">{{$title}}</h3>
<hr>
{{Form::model($row, ['route' => array('updateAvaluoEnfoqueFisico', $row->idavaluo), 'method'=>'post', 'id'=>'formAvaluoFisico' ]) }}
{{Form::hidden('idavaluoenfoquefisico', $row->idavaluoenfoquefisico, ['id'=>'idavaluoenfoquefisico'])}}
<div class="row">
	<div class="col-md-10 col-sm-10 col-xs-10"><h4>Terreno</h4></div>
    <div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title">
        <a class="btn btn-primary nuevo" id="btnNewAefTerr" title="Nuevo Registro">
            <span class="glyphicon glyphicon-plus-sign"></span>
            Nuevo</a>
    </div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aefTerrenosDataTable">
			<thead>
				<tr>
					<th>ID</th>
					<th>FRACC</th>
					<th>SUP.</th>
					<th>IRRE.</th>
					<th>TOP</th>
					<th>FRENTE</th>
					<th>FORMA</th>
					<th>OTROS</th>
					<th>F. R.</th>
					<th>V.U. NETO</th>
					<th>INDIVISO</th>
					<th>V. PARCIAL</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-default" colspan="7">&nbsp;</td>
					<td class="bg-default" colspan="3" style="text-align: right;">Valor del Terreno:</td>
					<td class="bg-info" colspan="3" style="text-align: right;" id="valor_terreno">{{number_format($row->valor_terreno, 2, ".", ",")}}</td>
					<td class="bg-default"></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12"><hr></div>

	<div class="col-md-12"><h4>DE LA CONSTRUCCIÓN</h4></div>
    <div class="clearfix"></div>
    <br/>
    <br/>
	<div class="col-md-3">
		{{Form::label('idclasegeneralinmueble', 'Clase General')}}
		{{Form::select('idclasegeneralinmueble', $cat_clase_general_inmueble, $row->idclasegeneral, ['id' => 'idclasegeneralinmueble', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('idtipoinmueble', 'Tipo de Inmueble')}}
		{{Form::select('idtipoinmueble', $cat_tipo_inmueble, $row->idtipoinmueble, ['id' => 'idtipoinmueble', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('idestadoconservacion', 'Estado de Conservacion')}}
		{{Form::select('idestadoconservacion', $cat_estado_conservacion, $row->idestado_conservacion, ['id' => 'idestadoconservacion', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('idcalidadproyecto', 'Calidad del Proyecto')}}
		{{Form::select('idcalidadproyecto', $cat_calidad_proyecto, $row->idcalidadproyecto, ['id' => 'idcalidadproyecto', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-3">
		{{Form::label('edad_construccion', 'Edad de la Construcción (Años)')}}
		{{Form::number('edad_construccion', $row->edad_construccion, ['id'=>'edad_construccion','class'=>'form-control clsNumeric', 'min'=>'0', 'max' => '999', 'pattern' => '^[0-9]{3}$'] )}}
		{{$errors->first('edad_construccion', '<span class=text-danger>:message</span>')}}
	</div>
	<div class="col-md-3">
		{{Form::label('vida_util', 'Vida Útil Remanente')}}
		{{Form::number('vida_util', $row->vida_util, ['id'=>'vida_util','class'=>'form-control clsNumeric', 'min'=>'0', 'max' => '999', 'pattern' => '^[0-9]{3}$'] )}}
		{{$errors->first('vida_util', '<span class=text-danger>:message</span>')}}
	</div>
	<div class="col-md-3">
		{{Form::label('numero_niveles', 'Número Niveles')}}
		{{Form::select('numero_niveles', array('1'=>'1', '2'=>'2', '3'=>'3'), $row->idcalidadproyecto, ['id' => 'numero_niveles', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('nivel_edificio_condominio', 'Nivel en Edificio (condiminio)')}}
		{{Form::select('nivel_edificio_condominio', 
					array('0'=>'N/A', '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'), 
					$row->nivel_edificio_condominio, ['id' => 'nivel_edificio_condominio', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-12"><hr></div>
	
	<div class="col-md-10 col-sm-10 col-xs-10"><h4>Datos de la Construcción</h4></div>
    <div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title">
        <a class="btn btn-primary nuevo" id="btnNewAefCons" title="Nuevo Registro">
            <span class="glyphicon glyphicon-plus-sign"></span>
            Nuevo
        </a>
    </div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aefConstruccionesDataTable">
			<thead>
				<tr>
					<th>ID</th>
					<th>TIPO</th>
					<th>EDAD</th>
					<th>SUPERFICIE M&sup2;</th>
					<th>V.R. NUEVO</th>
					<th>F. EDAD</th>
					<th>F. CONS.</th>
					<th>F. RESUL.</th>
					<th>V.R. NETO</th>
					<th>V. PARCIAL</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-default" colspan="4" style="text-align: right;">Total Metros Construcción</td>
					<td class="bg-info" style="text-align: right;" id="total_metros_construccion">{{number_format($row->total_metros_construccion, 2, ".", ",")}}</td>
					<td class="bg-default" colspan="2"></td>
					<td class="bg-default" colspan="3" style="text-align: right;">Valor del Terreno</td>
					<td class="bg-info" style="text-align: right;" id="valor_construccion">{{number_format($row->valor_construccion, 2, ".", ",")}}</td>
					<td class="bg-default"></td>
                </tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12"><hr></div>

	<div class="col-md-11"><h3>Áreas y Elementos adicionales comunes (solo en Condominios)</h3></div>
	<div class="col-md-1"><a class="btn btn-primary nuevo" id="btnNewAefCon" title="Nuevo Registro">Nuevo</a></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aefCondominiosDataTable">
			<thead>
				<tr>
					<th>ID</th>
					<th>DESCRIPCIÓN</th>
					<th>UNIDAD</th>
					<th>CANTIDAD</th>
					<th>V.R. NUEVO</th>
					<th>VIDA UTIL</th>
					<th>EDAD (años)</th>
					<th>F. EDAD</th>
					<th>F. CONS.</th>
					<th>F. RESUL.</th>
					<th>INDIVISO</th>
					<th>V. PARCIAL</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-default" colspan="8" style="text-align: right;">Valor del Área</td>
					<td class="bg-info" colspan="2" style="text-align: right;" id="subtotal_area_condominio">{{number_format($row->subtotal_area_condominio, 2, ".", ",")}}</td>
					<td class="bg-default" colspan="2"></td>
					<td class="bg-default" colspan="2"></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12"><hr style="border-width: 6px;"></div>

	<div class="col-md-11"><h3>Instalaciones Especiales, Elementos, Accesorios y Obras Complementarias</h3></div>
	<div class="col-md-1"><a class="btn btn-primary nuevo" id="btnNewAefIns" title="Nuevo Registro">Nuevo</a></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aefInstalacionesDataTable">
			<thead>
				<tr>
					<th>ID</th>
					<th>DESCRIPCIÓN</th>
					<th>UNIDAD</th>
					<th>CANTIDAD</th>
					<th>V.R. NUEVO</th>
					<th>VIDA UTIL</th>
					<th>EDAD (años)</th>
					<th>F. EDAD</th>
					<th>F. CONS.</th>
					<th>F. RESUL.</th>
					<th>V. NETO</th>
					<th>V. PARCIAL</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-default" colspan="8" style="text-align: right;">Valor del Área</td>
					<td class="bg-info" colspan="2" style="text-align: right;" id="subtotal_instalaciones_especiales">{{number_format($row->subtotal_instalaciones_especiales, 2, ".", ",")}}</td>
					<td class="bg-default" colspan="2"></td>
					<td class="bg-default" colspan="2"></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12"><hr style="border-width: 6px;"></div>

	<div class="col-md-12"><hr></div>
	
	<div class="col-md-9"><h1>Enfoque Físico</h1></div>
	<div class="col-md-3"><h1 id="total_valor_fisico">{{number_format($row->total_valor_fisico, 2, ".", ",")}}</h1></div>
	
	<div class="col-md-12"><hr></div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12 form-actions">
		{{Form::submit('Guardar', ['class'=>'btn btn-primary'])}}
		<a href="{{URL::route('indexAvaluos')}}" class="btn btn-primary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	</div>

</div>
{{Form::close()}}
<div id="divDialogFormFisico" style="display: none;">
	{{Form::model($row, ['route' => array('updateAvaluoEnfoqueFisico', $idavaluo), 'method'=>'post', 'id'=>'formDialogFisico' ]) }}
		{{Form::hidden('ctrl', '', ['id'=>'ctrl'])}}
		{{Form::hidden('idAef', $row->idavaluoenfoquefisico, ['id'=>'idAef'])}}
		{{Form::hidden('idTable', '', ['id'=>'idTable'])}}

		<div class="row" id="containerDialogForm" style="margin-top: 10px;"></div>
		
		<div style="text-align: center; margin-top: 10px;" id="messagesDialogForm"></div>
		
	{{Form::close()}}
</div>
<div id="divDialogConfirm" style="display: none;">
	{{Form::model($row, ['route' => array('delAvaluoEnfoqueFisico', $idavaluo), 'method'=>'post', 'id'=>'formDialogConfirm' ]) }}
		{{Form::hidden('ctrlDel', '', ['id'=>'ctrlDel'])}}
		{{Form::hidden('idAefDel', $row->idavaluoenfoquefisico, ['id'=>'idAefDel'])}}
		{{Form::hidden('idTableDel', '', ['id'=>'idTableDel'])}}

		<div class="alert alert-danger text-center"><h3>¿Realmente desea eliminar el registro?</h3></div>
		
	{{Form::close()}}
</div>
@section('javascript')
{{ HTML::script('/js/jquery/jquery.min.js') }}
{{ HTML::script('/js/jquery/jquery.mask.min.js') }}
{{ HTML::script('/js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
{{ HTML::script('/js/jquery.corevat.js') }}
<script>
    $(document).ready(function () {
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btn3EnfoqueFisico').removeClass("btn-info").addClass("btn-primary");

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	* 
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	var aefTerrenosDataTable = $("#aefTerrenosDataTable").DataTable({
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
	aefTerrenosDataTable.ajax.url( '/corevat/AefTerrenosGetAjax/' + $("#idavaluoenfoquefisico").val() ).load();

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	* 
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	var aefConstruccionesDataTable = $('#aefConstruccionesDataTable').DataTable({
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
	aefConstruccionesDataTable.ajax.url( '/corevat/AefConstruccionesGetAjax/' + $("#idavaluoenfoquefisico").val() ).load();

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	* 
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	var aefCondominiosDataTable = $('#aefCondominiosDataTable').DataTable({
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
	aefCondominiosDataTable.ajax.url( '/corevat/AefCondominiosGetAjax/' + $("#idavaluoenfoquefisico").val() ).load();

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	* 
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	var aefInstalacionesDataTable = $('#aefInstalacionesDataTable').DataTable({
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
	aefInstalacionesDataTable.ajax.url( '/corevat/AefInstalacionesGetAjax/' + $("#idavaluoenfoquefisico").val() ).load();

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNewAefTerr').click(function () {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnNewAefTerrenos');
		$('#idTable').val( '0' );
		$('#containerDialogForm').empty();
		$.createFormAefTerrenos();
		$.loadFormAefTerrenos();
		$('#divDialogFormFisico').dialog({title: 'Nuevo Registro Factores de Eficiencia'}).dialog('open');
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNewAefCons').click(function () {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnNewAefConstrucciones');
		$('#idTable').val( '0' );
		$('#containerDialogForm').empty();
		$.createFormAefConstrucciones();
		$.loadFormAefConstrucciones();
		$('#divDialogFormFisico').dialog({title: 'Nuevo Construcción'}).dialog('open');
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNewAefCon').click(function () {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnNewAefCondominios');
		$('#idTable').val( '0' );
		$('#containerDialogForm').empty();
		$.createFormAefCondominios();
		$.loadFormAefCondominios();
		$('#divDialogFormFisico').dialog({title: 'Nuevo Elemento'}).dialog('open');
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#btnNewAefIns').click(function () {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnNewAefInstalaciones');
		$('#idTable').val( '0' );
		$('#containerDialogForm').empty();
		$.createFormAefInstalaciones();
		$.loadFormAefInstalaciones();
		$('#divDialogFormFisico').dialog({title: 'Nueva Instalación'}).dialog('open');
	});



	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAefTerrenos = function(id) {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnEditAefTerrenos');
		$('#idTable').val( id );
		$('#containerDialogForm').empty();
		$.createFormAefTerrenos();
		$.loadFormAefTerrenos();
		$('#divDialogFormFisico').dialog({title: 'Factor Eficiencia: ' + id }).dialog('open');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAefConstrucciones = function(id) {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnEditAefConstrucciones');
		$('#idTable').val( id );
		$('#containerDialogForm').empty();
		$.createFormAefConstrucciones();
		$.loadFormAefConstrucciones();
		$('#divDialogFormFisico').dialog({title: 'Construcción: ' + id }).dialog('open');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAefCondominios = function(id) {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnEditAefCondominios');
		$('#idTable').val( id );
		$('#containerDialogForm').empty();
		$.createFormAefCondominios();
		$.loadFormAefCondominios();
		$('#divDialogFormFisico').dialog({title: 'Elemento: ' + id }).dialog('open');
	};

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.editAefInstalaciones = function(id) {
		$('#messagesDialogForm').empty().removeClass();
		$('#ctrl').val('btnEditAefInstalaciones');
		$('#idTable').val( id );
		$('#containerDialogForm').empty();
		$.createFormAefInstalaciones();
		$.loadFormAefInstalaciones();
		$('#divDialogFormFisico').dialog({title: 'Instalación: ' + id }).dialog('open');
	};


	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.delAefTerrenos = function(id) {
		$('#ctrlDel').val('btnDelAefTerreno');
		$('#idTableDel').val( id );
		$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.delAefConstrucciones = function(id) {
		$('#ctrlDel').val('btnDelAefConstrucciones');
		$('#idTableDel').val( id );
		$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.delAefCondominios = function(id) {
		$('#ctrlDel').val('btnDelAefCondominios');
		$('#idTableDel').val( id );
		$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.delAefInstalaciones = function(id) {
		$('#ctrlDel').val('btnDelAefInstalaciones');
		$('#idTableDel').val( id );
		$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');
	}



	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$('#divDialogFormFisico').dialog({
		modal: true,
		resizable: false,
		draggable: false,
		autoOpen: false,
		closeOnEscape: true,
		width: 900,
		height: 600,
		buttons: {
			Guardar: function () {
				$("#formDialogFisico").submit();
			},
			Cerrar: function () {
				$(this).dialog('close');
			}
		},
		close: function() {
			if ( $('#messagesDialogForm').attr('class') === 'alert alert-success' ) {
				//window.location.href = '/corevat/AvaluoEnfoqueFisico/<?php echo $row->idavaluo ?>';
				
			}
		}
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 
	 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$("#formDialogFisico").submit(function () {
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
					if (  $('#ctrl').val() === 'btnNewAefTerrenos' ) {
						aefTerrenosDataTable.ajax.reload();
						$('#containerDialogForm').empty();
						$.createFormAefTerrenos();
					} else if (  $('#ctrl').val() === 'btnNewAefConstrucciones' ) {
						aefConstruccionesDataTable.ajax.reload();
						$('#containerDialogForm').empty();
						$.createFormAefConstrucciones();
					} else if (  $('#ctrl').val() === 'btnNewAefCondominios' ) {
						aefCondominiosDataTable.ajax.reload();
						$('#containerDialogForm').empty();
						$.createFormAefCondominios();
					} else if (  $('#ctrl').val() === 'btnNewAefInstalaciones' ) {
						aefInstalacionesDataTable.ajax.reload();
						$('#containerDialogForm').empty();
						$.createFormAefInstalaciones();

					} else if (  $('#ctrl').val() === 'btnEditAefTerrenos' ) {
						aefTerrenosDataTable.ajax.reload();
						$('#valor_terreno').empty().append(datos.valor_terreno);
					} else if (  $('#ctrl').val() === 'btnEditAefConstrucciones' ) {
						aefConstruccionesDataTable.ajax.reload();
						$('#total_metros_construccion').empty().append(datos.total_metros_construccion);
						$('#valor_construccion').empty().append(datos.valor_construccion);
					} else if (  $('#ctrl').val() === 'btnEditAefCondominios' ) {
						aefCondominiosDataTable.ajax.reload();
						//$('#subtotal_area_condominio').empty().append(datos.subtotal_area_condominio);
					} else if (  $('#ctrl').val() === 'btnEditAefInstalaciones' ) {
						aefInstalacionesDataTable.ajax.reload();
						//$('#subtotal_instalaciones_especiales').empty().append(datos.subtotal_instalaciones_especiales);
					}
					$('#total_valor_fisico').empty().append(datos.total_valor_fisico);

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
				$(this).dialog('close');
			},
			Cancelar: function() {$(this).dialog('close');}
		}
	});

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$("#formDialogConfirm").submit(function () {
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
					alert( datos.message );
					if (datos.success === true) {
						if (  $('#ctrlDel').val() === 'btnDelAefTerreno' ) {
							aefTerrenosDataTable.ajax.reload();
							$('#valor_terreno').empty().append(datos.valor_terreno);
						} else if ( $('#ctrlDel').val() === 'btnDelAefConstrucciones' ) {
							aefConstruccionesDataTable.ajax.reload();
						} else if (  $('#ctrlDel').val() === 'btnDelAefCondominios' ) {
							aefCondominiosDataTable.ajax.reload();
						} else if (  $('#ctrlDel').val() === 'btnDelAefInstalaciones' ) {
							aefInstalacionesDataTable.ajax.reload();
						}
					}
				}
			});
			return false;
        });































    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefTerrenos = function () {
        div = $('<div  />');
        div.addClass('col-md-4');
        $('<label for="fraccion">Fracción:</label>').appendTo(div);
        $('<input type="text" name="fraccion" id="fraccion" maxlength="50" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="superficie">Superficie:</label>').appendTo(div);
        $('<input type="text" name="superficie" id="superficie"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="irregular">Irregular:</label>').appendTo(div);
        $('<input type="number" name="irregular" id="irregular" value="0.00" step="0.01" min="0.00" max="99999999.99" pattern="[-+]?[0-9]*[.,]?[0-9]+" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
		$('<div">&nbsp;</div>').addClass('col-md-12').appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactortop">Top:</label>').appendTo(div);
        $('<select name="idfactortop" id="idfactortop" class="form-control" style="width:100%" />').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactorfrente">Frente:</label>').appendTo(div);
        $('<select name="idfactorfrente" id="idfactorfrente" class="form-control" style="width:100%" />').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactorforma">Forma:</label>').appendTo(div);
        $('<select name="idfactorforma" id="idfactorforma" class="form-control" style="width:100%"/>').appendTo(div);
        div.appendTo('#containerDialogForm');

		$('<div">&nbsp;</div>').addClass('col-md-12').appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactorconservacion">Otros:</label>').appendTo(div);
        $('<select name="idfactorconservacion" id="idfactorconservacion" class="form-control" style="width:100%"/>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_resultante">F. Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_unitario_neto">V.U. Neto:</label>').appendTo(div);
        $('<input type="text" name="valor_unitario_neto" id="valor_unitario_neto"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

		$('<div">&nbsp;</div>').addClass('col-md-12').appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="indiviso">Indiviso (%):</label>').appendTo(div);
        $('<input type="number" name="indiviso" id="indiviso" value="0.01" min="0" max="100" pattern="[-+]?[0-9]*[.,]?[0-9]+" step="0.01" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_parcial">V. Parcial:</label>').appendTo(div);
        $('<input type="text" name="valor_parcial" id="valor_parcial"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

		$('<div">&nbsp;</div>').addClass('col-md-4').appendTo('#containerDialogForm');

        $("#idfactortop, #irregular, #indiviso").keydown(function (e) {
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
     * DATOS DE LA CONSTRUCCION
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefConstrucciones = function () {
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idtipo">Tipo:</label>').appendTo(div);
        $('<select name="idtipo" id="idtipo" class="form-control" style="width:100%"></select>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="edad">Edad:</label>').appendTo(div);
        $('<input type="text" name="edad" />').attr('id', 'edad').addClass('form-control').addClass('clsNumeric').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="superficie_m2">Superficie M&sup2:</label>').appendTo(div);
        $('<input type="text" name="superficie_m2" id="superficie_m2"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_nuevo">V.R. Nuevo:</label>').appendTo(div);
        $('<input type="number" name="valor_nuevo" id="valor_nuevo" value="0.00" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_edad">Factor Edad:</label>').appendTo(div);
        $('<input type="text" name="factor_edad" id="factor_edad"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idfactorconservacion">Factor Conservación:</label>').appendTo(div);
        $('<select name="idfactorconservacion" id="idfactorconservacion" class="form-control" style="width:100%"></select>').appendTo(div);
        div.appendTo('#containerDialogForm');
	
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_resultante">Factor Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_neto">Valor Neto:</label>').appendTo(div);
        $('<input type="text" name="valor_neto" id="valor_neto"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_parcial_construccion">Valor Parcial:</label>').appendTo(div);
        $('<input type="text" name="valor_parcial_construccion" id="valor_parcial_construccion"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

    };
    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * Áreas y Elementos adicionales comunes(solo en Condominios)
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefCondominios = function () {
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="descripcion">Descripción:</label>').appendTo(div);
        $('<input type="text" name="descripcion" id="descripcion" maxlength="200" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="unidad">Unidad:</label>').appendTo(div);
        $('<input type="text" name="unidad" id="unidad" maxlength="10" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="cantidad">Cantidad:</label>').appendTo(div);
        $('<input type="number" name="cantidad" id="cantidad" value="0.00" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_nuevo">V. R. Nuevo:</label>').appendTo(div);
        $('<input type="number" name="valor_nuevo" id="valor_nuevo" value="0" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="vida_remanente">Vida Remanente:</label>').appendTo(div);
        $('<input type="number" name="vida_remanente" id="vida_remanente" value="0" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="edad">Edad:</label>').appendTo(div);
        $('<input type="number" name="edad" id="edad" value="0" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_edad">Factor Edad:</label>').appendTo(div);
        $('<input type="text" name="factor_edad" id="factor_edad"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_conservacion">Factor Conservación:</label>').appendTo(div);
        $('<input type="number" name="factor_conservacion" id="factor_conservacion" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_resultante">Factor Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="indiviso">Indiviso (%):</label>').appendTo(div);
        $('<input type="number" name="indiviso" id="indiviso" value="0.00" step="0.01" min="0.00" max="99999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_parcial">Valor Parcial:</label>').appendTo(div);
        $('<input type="text" name="valor_parcial" id="valor_parcial"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        $("input[type=number], #unidad").keydown(function (e) {
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
    $.createFormAefCompConstrucciones = function () {
    }
    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * Instalaciones Especiales, Elementos, Accesorios y Obras Complementarias
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.createFormAefInstalaciones = function () {
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="idobracomplementaria">Descripción:</label>').appendTo(div);
        $('<select name="idobracomplementaria" id="idobracomplementaria" class="form-control" style="width:100%"></select>').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="cantidad">Cantidad:</label>').appendTo(div);
        $('<input type="number" name="cantidad" id="cantidad" value="0.00" step="0.01" min="0.00" max="9999999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="unidad">Unidad:</label>').appendTo(div);
        $('<input type="text" name="unidad" id="unidad"  value="0" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="valor_nuevo">V. R. Nuevo:</label>').appendTo(div);
        $('<input type="number" name="valor_nuevo" id="valor_nuevo" value="0.00" step="0.01" min="0.00" max="9999999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="eaf_Instalacion_vida_util">Vida Útil:</label>').appendTo(div);
        $('<input type="text" name="eaf_Instalacion_vida_util" id="eaf_Instalacion_vida_util" value="0" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="edad">Edad:</label>').appendTo(div);
        $('<input type="number" name="edad" id="edad" value="0.00" step="0.01" min="0.00" max="9999999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_edad">Factor Edad:</label>').appendTo(div);
        $('<input type="text" name="factor_edad" id="factor_edad"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_conservacion">Factor Conservación:</label>').appendTo(div);
        $('<input type="number" name="factor_conservacion" id="factor_conservacion" value="0.00" step="0.01" min="0.00" max="9999999999.99" pattern="[0-9]{1,8}[.]{1}[0-9]{1,2}" />').attr('required', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');
		
        div = $('<div />');
        div.addClass('col-md-4');
        $('<label for="factor_resultante">Factor Resultante:</label>').appendTo(div);
        $('<input type="text" name="factor_resultante" id="factor_resultante"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_neto">V. N. Rep.:</label>').appendTo(div);
        $('<input type="text" name="valor_neto" id="valor_neto"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        div = $('<div />');
        div.addClass('col-md-6');
        $('<label for="valor_parcial">Valor Parcial:</label>').appendTo(div);
        $('<input type="text" name="valor_parcial" id="valor_parcial"/>').attr('disabled', 'true').addClass('form-control').appendTo(div);
        div.appendTo('#containerDialogForm');

        $("input[type=number], #factor_conservacion, #cantidad, #unidad, #valor_nuevo, #eaf_Instalacion_vida_util, #edad ").keydown(function (e) {
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
	$.loadFormAefTerrenos = function () {
		var xx = $('#idTable').val();
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: '/corevat/AefTerrenosGet/' + $('#idTable').val() + '/' + $('#idAef').val(),
			type: 'get',
			success: function (data) {
				datos = eval(data);

				for (var i = 0; i < datos.cat_factores_top.length; i++) {
					$('<option value="' + datos.cat_factores_top[i].idfactorconservacion + '">('+ datos.cat_factores_top[i].valor_factor_conservacion  + ') ' + datos.cat_factores_top[i].factor_conservacion + '</option>').appendTo('#idfactortop');
				}
				$("#idfactortop option[value=" + datos.idfactortop + "]").attr("selected", true);

				for (var i = 0; i < datos.cat_factores_frente.length; i++) {
					$('<option value="' + datos.cat_factores_frente[i].idfactorfrente + '">('+ datos.cat_factores_frente[i].valor_factor_frente  + ') ' + datos.cat_factores_frente[i].factor_frente + '</option>').appendTo('#idfactorfrente');
				}
                $("#idfactorfrente option[value=" + datos.idfactorfrente + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_forma.length; i++) {
					$('<option value="' + datos.cat_factores_forma[i].idfactorforma + '">('+ datos.cat_factores_forma[i].valor_factor_forma  + ') ' + datos.cat_factores_forma[i].factor_forma + '</option>').appendTo('#idfactorforma');
				}
                $("#idfactorforma option[value=" + datos.idfactorforma + "]").attr("selected", true);
				
				for (var i = 0; i < datos.cat_factores_conservacion.length; i++) {
					$('<option value="' + datos.cat_factores_conservacion[i].idfactorconservacion + '">('+ datos.cat_factores_conservacion[i].valor_factor_conservacion  + ') ' + datos.cat_factores_conservacion[i].factor_conservacion + '</option>').appendTo('#idfactorconservacion');
				}
                $("#idfactorconservacion option[value=" + datos.idfactorconservacion + "]").attr("selected", true);

				$('#fraccion').val( datos.fraccion );
				$('#superficie').val(datos.superficie);
				$('#irregular').val(datos.irregular);
				$('#factor_resultante').val(datos.factor_resultante);
				$('#valor_unitario_neto').val(datos.valor_unitario_neto);
				$('#indiviso').val(datos.indiviso);
				$('#valor_parcial').val(datos.valor_parcial);
				
            }
        });
    };

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	* 
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	$.loadFormAefConstrucciones = function () {
		$.ajax({
			global: false,
			cache: false,
			dataType: 'json',
			url: '/corevat/AefConstruccionesGet/' + $('#idTable').val(),
			type: 'get',
			success: function (data) {
				datos = eval(data);
				for (var i = 0; i < datos.cat_tipo.length; i++) {
					$('<option value="' + datos.cat_tipo[i].idtipo + '">' + datos.cat_tipo[i].tipo + '</option>').appendTo('#idtipo');
				}
				$("#idtipo option[value=" + datos.idtipo + "]").attr("selected", true);

				for (var i = 0; i < datos.cat_factores_conservacion.length; i++) {
					$('<option value="' + datos.cat_factores_conservacion[i].idfactorconservacion + '">('+ datos.cat_factores_conservacion[i].valor_factor_conservacion  + ') ' + datos.cat_factores_conservacion[i].factor_conservacion + '</option>').appendTo('#idfactorconservacion');
				}
				$("#idfactorconservacion option[value=" + datos.idfactorconservacion + "]").attr("selected", true);

				$('#edad').val(datos.edad);
				$('#superficie_m2').val(datos.superficie_m2);
				$('#valor_nuevo').val(datos.valor_nuevo);
				$('#factor_edad').val(datos.factor_edad);
				$('#factor_resultante').val(datos.factor_resultante);
				$('#valor_neto').val(datos.valor_neto);
				$('#valor_parcial_construccion').val(datos.factor_edad);

			}
		});
	};

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAefCondominios = function () {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AefCondominiosGet/' + $('#idTable').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
				
				$('#descripcion').val(datos.descripcion);
				$('#unidad').val(datos.unidad);
				$('#cantidad').val(datos.cantidad);
				$('#valor_nuevo').val(datos.valor_nuevo);
				$('#vida_remanente').val(datos.vida_remanente);
				$('#edad').val(datos.edad);
				$('#factor_edad').val(datos.factor_edad);
				$('#factor_conservacion').val(datos.factor_conservacion);
				$('#factor_resultante').val(datos.factor_resultante);
				$('#indiviso').val(datos.indiviso);
				$('#valor_parcial').val(datos.valor_parcial);

            }
        });
    };
    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAefCompConstrucciones = function () {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AefCompConstruccionesGet/' + $('#idTable').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
            }
        });
    };
    
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     * 
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $.loadFormAefInstalaciones = function () {
        $.ajax({
            global: false,
            cache: false,
            dataType: 'json',
            url: '/corevat/AefInstalacionesGet/' + $('#idTable').val(),
            type: 'get',
            success: function (data) {
                datos = eval(data);
				
				for (var i = 0; i < datos.cat_obras_complementarias.length; i++) {
					$('<option value="' + datos.cat_obras_complementarias[i].idobracomplementaria + '">' + datos.cat_obras_complementarias[i].obra_complementaria + '</option>').appendTo('#idobracomplementaria');
				}
                $("#idobracomplementaria option[value=" + datos.idobracomplementaria + "]").attr("selected", true);
				
				$('#cantidad').val(datos.cantidad);
				$('#unidad').val(datos.unidad);
				$('#valor_nuevo').val(datos.valor_nuevo);
				$('#eaf_Instalacion_vida_util').val(datos.vida_util);
				$('#edad').val(datos.edad);
				$('#factor_edad').val(datos.factor_edad);
				$('#factor_conservacion').val(datos.factor_conservacion);
				$('#factor_resultante').val(datos.factor_resultante);
				$('#valor_neto').val(datos.valor_neto);
				$('#valor_parcial').val(datos.valor_parcial);
				
			}
		});
	};

    $('.edad, #edad').mask('YYY', {placeholder: "___", translation: {Y: {pattern: /[0-9]/}}});
    });
</script>
@stop
