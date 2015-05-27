<h3 class="header">{{$title}}</h3>
<hr>
{{ Form::model($row, ['route' => array('updateAvaluoEnfoqueFisico', $row->idavaluo), 'method'=>'post', 'id'=>'formAvaluoFisico' ]) }}
<div class="row">
	<div class="col-md-11"><h3>Terreno</h3></div>
	<div class="col-md-1"><a href="#" class="btn btn-primary nuevo" id="btnNewAefTerr" title="Nuevo Registro">Nuevo</a></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped corevatDataTable" id="aef_terrenos-table">
			<thead>
				<tr>
					<th>#</th>
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
				</tr>
			</thead>
			<tbody>
				@if ( count($aef_terrenos) > 0 )
				@foreach ($aef_terrenos as $item)
				<tr>
					<td></td>
					<td>{{$item->idaefterreno}}</td>
					<td>{{$item->fraccion}}</td>
					<td>{{$item->superficie}}</td>
					<td>{{$item->irregular}}</td>
					<td>{{$item->top}}</td>
					<td>{{$item->frente}}</td>
					<td>{{$item->forma}}</td>
					<td>{{$item->otros}}</td>
					<td>{{$item->factor_resultante}}</td>
					<td>{{$item->valor_unitario_neto}}</td>
					<td>{{$item->indiviso}}</td>
					<td>{{$item->valor_parcial}}</td>
					<td>
						<a href="#" class="btn btn-xs btn-info btnEditAefTerr"  idTable="{{$item->idaefterreno}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
						<a href="#" class="btn btn-xs btn-danger btnDelAefTerr" idTable="{{$item->idaefterreno}}" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-primary" colspan="7">&nbsp;</td>
					<td class="bg-primary" colspan="3" style="text-align: right;">Valor del Terreno:</td>
					<td class="bg-info" colspan="3" style="text-align: right;"></td>
					<td class="bg-primary"></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12"><hr></div>

	<div class="col-md-11"><h3>DE LA CONSTRUCCIÓN</h3></div>
	<div class="col-md-3">
		{{Form::label('idclasegeneralinmueble', 'Clase General')}}
		{{Form::select('idclasegeneralinmueble', $cat_clase_general_inmueble, $row->idclasegeneralinmueble, ['id' => 'idclasegeneralinmueble', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('idtipoinmueble', 'Tipo Inmueble')}}
		{{Form::select('idtipoinmueble', $cat_tipo_inmueble, $row->idtipoinmueble, ['id' => 'idtipoinmueble', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('idestadoconservacion', 'Estado Conservacion')}}
		{{Form::select('idestadoconservacion', $cat_calidad_proyecto, $row->idestadoconservacion, ['id' => 'idestadoconservacion', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('idcalidadproyecto', 'Calidad Proyecto')}}
		{{Form::select('idcalidadproyecto', $cat_estado_conservacion, $row->idcalidadproyecto, ['id' => 'idcalidadproyecto', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-3">
		{{Form::label('edad_construccion', 'Edad de la Construcción (Años)')}}
		{{Form::number('edad_construccion', $row->edad_construccion, ['class'=>'form-control', 'maxlength'=>'10'] )}}
		{{$errors->first('edad_construccion', '<span class=text-danger>:message</span>')}}
	</div>
	<div class="col-md-3">
		{{Form::label('vida_util', 'Vida Útil Remanente')}}
		{{Form::number('vida_util', $row->vida_util, ['class'=>'form-control', 'maxlength'=>'10'] )}}
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
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-11"><h3>Datos de la Construcción</h3></div>
	<div class="col-md-1"><a href="#" class="btn btn-primary nuevo" id="btnNewAefCons" title="Nuevo Registro">Nuevo</a></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped corevatDataTable" id="aef_construcciones-table">
			<thead>
				<tr>
					<th>#</th>
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
				</tr>
			</thead>
			<tbody>
				@if ( count($aef_construcciones) > 0 )
				@foreach ($aef_construcciones as $item)
				<tr>
					<td></td>
					<td>{{$item->idaefconstruccion}}</td>
					<td>{{$item->tipo}}</td>
					<td>{{$item->edad}}</td>
					<td>{{$item->superficie_m2}}</td>
					<td>{{$item->valor_nuevo}}</td>
					<td>{{$item->factor_edad}}</td>
					<td>{{$item->factor_conservacion}}</td>
					<td>{{$item->factor_resultante}}</td>
					<td>{{$item->valor_neto}}</td>
					<td>{{$item->valor_parcial_construccion}}</td>
					<td>
						<a href="#" class="btn btn-xs btn-info btnEditAefCons"  idTable="{{$item->idaefconstruccion}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
						<a href="#" class="btn btn-xs btn-danger btnDelAefCons" idTable="{{$item->idaefconstruccion}}" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-primary" colspan="4" style="text-align: right;">Total Metros Construcción</td>
					<td class="bg-info"></td>
					<td class="bg-primary" colspan="2"></td>
					<td class="bg-primary" colspan="3" style="text-align: right;">Valor del Terreno</td>
					<td class="bg-info"></td>
					<td class="bg-primary"></td>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-11"><h3>Áreas y Elementos adicionales comunes (solo en Condominios)</h3></div>
	<div class="col-md-1"><a href="#" class="btn btn-primary nuevo" id="btnNewAefCon" title="Nuevo Registro">Nuevo</a></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped corevatDataTable" id="aef_condominios-table">
			<thead>
				<tr>
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
				</tr>
			</thead>
			<tbody>
				@if ( count($aef_condominios) > 0 )
				@foreach ($aef_condominios as $item)
				<tr>
					<td>{{$item->descripcion}}</td>
					<td>{{$item->unidad}}</td>
					<td>{{$item->cantidad}}</td>
					<td>{{$item->valor_nuevo}}</td>
					<td>{{$item->vida_remanente}}</td>
					<td>{{$item->edad}}</td>
					<td>{{$item->factor_edad}}</td>
					<td>{{$item->factor_conservacion}}</td>
					<td>{{$item->factor_resultante}}</td>
					<td>{{$item->indiviso}}</td>
					<td>{{$item->valor_parcial}}</td>
					<td>
						<a href="#" class="btn btn-xs btn-info btnEditAefCon"  idTable="{{$item->idaefcondominio}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
						<a href="#" class="btn btn-xs btn-danger btnDelAefCon" idTable="{{$item->idaefcondominio}}" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-primary" colspan="8" style="text-align: right;">Valor del Área</td>
					<td class="bg-info" colspan="2"></td>
					<td class="bg-primary" colspan="2"></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12"><hr style="border-width: 6px;"></div>

	<div class="col-md-11"><h3>Instalaciones Especiales, Elementos, Accesorios y Obras Complementarias</h3></div>
	<div class="col-md-1"><a href="#" class="btn btn-primary nuevo" id="btnNewAefCom" title="Nuevo Registro">Nuevo</a></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped corevatDataTable" id="aef_comp_construcciones-table">
			<thead>
				<tr>
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
				</tr>
			</thead>
			<tbody>
				@if ( count($aef_comp_construcciones) > 0 )
				@foreach ($aef_comp_construcciones as $item)
				<tr>
					<td>{{$item->descripcion}}</td>
					<td>{{$item->unidad}}</td>
					<td>{{$item->cantidad}}</td>
					<td>{{$item->valor_nuevo}}</td>
					<td>{{$item->vida_remanente}}</td>
					<td>{{$item->edad}}</td>
					<td>{{$item->factor_edad}}</td>
					<td>{{$item->factor_conservacion}}</td>
					<td>{{$item->factor_resultante}}</td>
					<td>{{$item->valor_neto}}</td>
					<td>{{$item->valor_parcial}}</td>
					<td>
						<a href="#" class="btn btn-xs btn-info btnEditAefCom"  idTable="{{$item->idaefcompconstruccion}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
						<a href="#" class="btn btn-xs btn-danger btnDelAefCom" idTable="{{$item->idaefcompconstruccion}}" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-primary" colspan="8" style="text-align: right;">Valor del Área</td>
					<td class="bg-info" colspan="2"></td>
					<td class="bg-primary" colspan="2"></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12"><hr></div>
	<div class="col-md-9"> Enfoque Físico </div>
	<div class="col-md-3">$000.00</div>
	<div class="col-md-12"><hr></div>
	<div class="col-md-12">&nbsp;</div>


</div>
{{Form::close()}}
<div style="display: none;">
	{{Form::select('idfactorfrente', $cat_factores_frente, null, ['id' => 'idfactorfrente', 'class'=>'form-control'])}}
	{{Form::select('idfactorforma', $cat_factores_forma, null, ['id' => 'idfactorforma', 'class'=>'form-control'])}}
	{{Form::select('idfactorconservacion', $cat_factores_conservacion, null, ['id' => 'idfactorconservacion', 'class'=>'form-control'])}}
	{{Form::select('idobracomplementaria', $cat_obras_complementarias, null, ['id' => 'idobracomplementaria', 'class'=>'form-control'])}}
	{{Form::select('idtipo', $cat_tipo, null, ['id' => 'idtipo', 'class'=>'form-control'])}}
	
</div>
<div id="divDialogFormFisico" style="display: none;">
	{{Form::model($row, ['route' => array('updateAvaluoEnfoqueFisico', $idavaluo), 'method'=>'post', 'id'=>'formDialogFisico' ]) }}
		{{Form::hidden('ctrl', '', ['id'=>'ctrl'])}}
		{{Form::hidden('idAef', $row->idavaluoenfoquefisico, ['id'=>'idAef'])}}
		{{Form::hidden('idTable', '', ['id'=>'idTable'])}}

		<div class="row" id="containerDialogForm"></div>
		
		<div class="row"><div class="col-md-12">&nbsp;</div><div class="col-md-12" id="messagesDialogForm"></div></div>
		
	{{Form::close()}}
</div>
<div id="divDialogConfirm" style="display: none;">
	{{Form::model($row, ['route' => array('delAvaluoEnfoqueFisico', $idavaluo), 'method'=>'post', 'id'=>'formDialogConfirm' ]) }}
		{{Form::hidden('ctrlDel', '', ['id'=>'ctrlDel'])}}
		{{Form::hidden('idAemDel', $row->idavaluoenfoquefisico, ['id'=>'idAemDel'])}}
		{{Form::hidden('idTableDel', '', ['id'=>'idTableDel'])}}

		<h3 class="text-danger text-center">¿Realmente desea eliminar el registro?</h3>
		
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
         *  btnNewAefCon btnNewAefCon btnNewAefCom
		 * btnEditAefTerr btnDelAefTerr
		 * 
		 * btnNewAefCons
		 * 
         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        $('#btn3EnfoqueFisico').removeClass("btn-info").addClass("btn-primary");

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        $('#btnNewAefTerr').click(function () {
			$('#messagesDialogForm').empty().removeClass();
			$('#ctrl').val('btnNewAefTerrenos');
			$('#idTable').val( '0' );
			$('#containerDialogForm').empty();
			$.createFormAefTerrenos();
			$('#divDialogFormFisico').dialog({title: 'Nuevo Registro Factores de Eficiencia'}).dialog('open');
		});
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('.btnEditAefTerr').click(function () {
			$('#messagesDialogForm').empty().removeClass();
			$('#ctrl').val('btnEditAefTerrenos');
			$('#idTable').val( $(this).attr('idTable') );
			$('#containerDialogForm').empty();
			$.createFormAefTerrenos();
			$.loadFormAefTerrenos();
			$('#divDialogFormFisico').dialog({title: 'Factor Eficiencia: ' + $(this).attr('idTable') }).dialog('open');
		});

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
				if ( $('#messagesDialogForm').attr('class') == 'col-md-12 bg-success' ) {
					window.location.href = '/corevat/AvaluoEnfoqueFisico/<?php echo $row->idavaluo ?>';
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
						$('#messagesDialogForm').removeClass().addClass('col-md-12').addClass('bg-success').append(datos.message);
						$('#idTable').val( datos.idTable );
					} else {
						var errores = '';
						for(datos in data.errors) {
							errores += '<p>' + data.errors[datos] + '</p>';
						}
						$('#messagesDialogForm').removeClass().addClass('col-md-12').addClass('bg-danger').append(errores);
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
			//$('#messagesDialogForm').empty().removeClass();
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
						window.location.href = '/corevat/AvaluoEnfoqueFisico/<?php echo $row->idavaluo ?>';
					}
				}
			});
			return false;
        });

    });
</script>
@stop
