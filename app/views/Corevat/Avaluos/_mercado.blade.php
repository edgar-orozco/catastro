<h3 class="header">{{$title}}</h3>
<hr>
{{Form::model($row, ['route' => array('updateAvaluoEnfoqueMercado', $idavaluo), 'method'=>'post', 'id'=>'formAvaluoMercado' ]) }}
<div class="row">
	<div class="col-md-12"><h2>Venta de Terrenos</h2></div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-11"><h3>Investigación de Terrenos Comparables</h3></div>
	<div class="col-md-1"><a href="#" class="btn btn-primary nuevo" id="btnNewAemComp" title="Nuevo Registro">Nuevo</a></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped corevatDataTable" id="aem_comp_terrenos-table">
			<thead>
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>UBICACIÓN</th>
					<th>PRECIO</th>
					<th>SUP. TERRENO</th>
					<th>P.U. M&sup2;</th>
					<th>OBSERVACIÓN</th>
					<th>OPCIONES</th>
				</tr>
			</thead>
			<tbody>
				@if ( count($aem_comp_terrenos) > 0 )
				@foreach ($aem_comp_terrenos as $item)
				<tr>
					<td></td>
					<td>{{$item->idaemcompterreno}}</td>
					<td>{{$item->ubicacion}}</td>
					<td>{{$item->precio}}</td>
					<td>{{$item->superficie_terreno}}</td>
					<td>{{$item->precio_unitario_m2_terreno}}</td>
					<td>{{$item->observaciones}}</td>
					<td>
						<a href="#" class="btn btn-xs btn-info btnEditAemComp"  idTable="{{$item->idaemcompterreno}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
						<a href="#" class="btn btn-xs btn-danger btnDelAemComp" idTable="{{$item->idaemcompterreno}}" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12"><h3>Homologación del Terreno en función del lote tipo o predominante en la zona...</h3></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped corevatDataTable" id="aem_homologacion-table">
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
				@if ( count($aem_homologacion) > 0 )
				@foreach ($aem_homologacion as $item)
				<tr>
					<td></td>
					<td>{{$item->idaemhomologacion}}</td>
					<td>{{$item->comparable}}</td>
					<td>{{$item->superficie_terreno}}</td>
					<td>{{$item->valor_unitario}}</td>
					<td>{{$item->zona}}</td>
					<td>{{$item->ubicacion}}</td>
					<td>{{$item->frente}}</td>
					<td>{{$item->forma}}</td>
					<td>{{$item->superficie}}</td>
					<td>{{$item->valor_unitario_negociable}}</td>
					<td>{{$item->valor_unitario_resultante_m2}}</td>
					<td>
						<a href="#" class="btn btn-xs btn-info btnEditAemHom"  idTable="{{$item->idaemhomologacion}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-primary" colspan="6">&nbsp;</td>
					<td class="bg-primary" colspan="4" style="text-align: right;">Valor Unitario Promedio ($/m&sup2;)</td>
					<td class="bg-info" colspan="2">{{$row->valor_unitario_promedio}}</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
				<tr>
					<td class="bg-primary" colspan="6">&nbsp;</td>
					<td class="bg-primary" colspan="4" style="text-align: right;">Valor Aplicado por M&sup2;</td>
					<td class="bg-info" colspan="2">{{$row->valor_aplicado_m2}}</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12"><h2>Venta de Inmuebles</h2></div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-11"><h3>Venta de inmuebles similares en uso al que se valua(sujeto)</h3></div>
	<div class="col-md-1"><a href="#" class="btn btn-primary nuevo" id="btnNewAemInf" title="Nuevo Registro">Nuevo</a></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped corevatDataTable" id="aem_informacion-table">
			<thead>
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>UBICACIÓN</th>
					<th>PRECIO</th>
					<th>EDAD</th>
					<th>TELÉFONO</th>
					<th>OPCIONES</th>
				</tr>
			</thead>
			<tbody>
				@if ( count($aem_informacion) > 0 )
				@foreach ($aem_informacion as $item)
				<tr>
					<td></td>
					<td>{{$item->idaeminformacion}}</td>
					<td>{{$item->ubicacion}}</td>
					<td>{{$item->edad}}</td>
					<td>{{$item->telefono}}</td>
					<td>{{$item->observaciones}}</td>
					<td>
						<a href="#" class="btn btn-xs btn-info btnEditAemInf"  idTable="{{$item->idaeminformacion}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
						<a href="#" class="btn btn-xs btn-danger btnDelAemInf" idTable="{{$item->idaeminformacion}}" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12"><h3>Análisis por Homologación de Mercado</h3></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped corevatDataTable" id="aem_analisis-table">
			<thead>
				<tr>
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
				@if ( count($aem_analisis) > 0 )
				@foreach ($aem_analisis as $item)
				<tr>
					<td>{{$item->idaemanalisis}}</td>
					<td>{{$item->precio_venta}}</td>
					<td>{{$item->superficie_terreno}}</td>
					<td>{{$item->superficie_construccion}}</td>
					<td>{{$item->valor_unitario_m2}}</td>
					<td>{{$item->factor_zona}}</td>
					<td>{{$item->factor_ubicacion}}</td>
					<td>{{$item->factor_superficie}}</td>
					<td>{{$item->factor_edad}}</td>
					<td>{{$item->factor_conservacion}}</td>
					<td>{{$item->factor_negociacion}}</td>
					<td>{{$item->factor_resultante}}</td>
					<td>{{$item->valor_unitario_resultante_m2}}</td>
					<td>
						<a href="#" class="btn btn-xs btn-info btnEditAemAna"  idTable="{{$item->idaemanalisis}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-primary" colspan="8">&nbsp;</td>
					<td class="bg-primary" colspan="4" style="text-align: right;">Promedio:</td>
					<td class="bg-info">{{$row->promedio_analisis}}</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
				<tr>
					<td class="bg-primary" colspan="8">&nbsp;</td>
					<td class="bg-primary" colspan="4" style="text-align: right;">Superficie Construida del Sujeto:</td>
					<td class="bg-info">{{$row->superficie_construida}}</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
				<tr>
					<td class="bg-primary" colspan="8">&nbsp;</td>
					<td class="bg-primary" colspan="4" style="text-align: right;">Valor comparativo de mercado:</td>
					<td class="bg-info">{{$row->valor_comparativo_mercado}}</td>
					<td class="bg-primary">&nbsp;</td>
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
<script>
    $(document).ready(function () {
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('#btn3EnfoqueMercado').removeClass("btn-info").addClass("btn-primary");


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
		$('.btnEditAemComp').click(function () {
			$('#messagesDialogForm').empty().removeClass();
			$('#ctrl').val('btnEditAemComp');
			$('#idTable').val( $(this).attr('idTable') );
			$('#containerDialogForm').empty();
			$.createFormAemCompTerrenos();
			$.loadFormAemCompTerrenos();
			$('#divDialogFormMercado').dialog({title: 'Modificar Registro Comparable: ' + $(this).attr('idTable') }).dialog('open');
		});
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('.btnDelAemComp').click(function () {
			$('#ctrlDel').val('btnDelAemComp');
			$('#idTableDel').val( $(this).attr('idTable') );
			$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');
		});
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        $('.btnEditAemHom').click(function () {
			$('#messagesDialogForm').empty().removeClass();
			$('#ctrl').val('btnEditAemHom');
			$('#idTable').val( $(this).attr('idTable') );
			$('#containerDialogForm').empty();
			$.createFormAemHomologacion();
			$.loadFormAemHomologacion();
			
			
			
			
			$('#divDialogFormMercado').dialog({title: 'Homologable: ' + $(this).attr('idTable') }).dialog('open');
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
		$('.btnEditAemInf').click(function () {
			$('#messagesDialogForm').empty().removeClass();
			$('#ctrl').val('btnEditAemInf');
			$('#idTable').val( $(this).attr('idTable') );
			$('#containerDialogForm').empty();
			$.createFormAemInformacion();
			$.loadFormAemAnaInformacion();
			$('#divDialogFormMercado').dialog({title: 'Modificar Registro Comparable Mercado: ' + $(this).attr('idTable') }).dialog('open');
		});
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('.btnDelAemInf').click(function () {
			$('#ctrlDel').val('btnDelAemInf');
			$('#idTableDel').val( $(this).attr('idTable') );
			$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');
		});
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        $('.btnEditAemAna').click(function () {
			$('#messagesDialogForm').empty().removeClass();
			$('#ctrl').val('btnEditAemAna');
			$('#idTable').val( $(this).attr('idTable') );
			$('#containerDialogForm').empty();
			$.createFormAemAnalisis();
			$.loadFormAemAnalisis();
			$('#divDialogFormMercado').dialog({title: 'Homologable: ' + $(this).attr('idTable') }).dialog('open');
		});

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
					window.location.href = '/corevat/AvaluoEnfoqueMercado/<?php echo $row->idavaluo ?>';
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
						$('#idTable').val( datos.idTable );
						$('#ctrl').val( datos.ctrl );
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
						window.location.href = '/corevat/AvaluoEnfoqueMercado/<?php echo $row->idavaluo ?>';
					}
				}
			});
			return false;
        });




    });
</script>
@stop
