<h3 class="header">{{$title}}</h3>
<hr>
{{Form::model($row, ['route' => array('updateAvaluoInmueble', $idavaluo), 'method'=>'post', 'id'=>'formAvaluoInmueble', 'enctype'=>'multipart/form-data' ]) }}
{{Form::hidden('idavaluoinmueble', $row->idavaluoinmueble)}}
<div class="row">
	<div class="col-md-12 bg-primary"><h4>Subir imagenes</h4></div>
	<div class="col-md-5">
		{{Form::label('croquis', 'Croquis')}}
		{{Form::file('croquis') }}	
		<hr>
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		{{Form::label('fachada', 'Fachada')}}
		{{Form::file('fachada') }}	
		<hr>
	</div>

	<div class="col-md-11"><h3>Medidas y Colindancias</h3></div>
	<div class="col-md-1"><a href="#" class="btn btn-primary nuevo" id="btnNew" title="Nuevo Avaluo">Nuevo</a></div>

	<div class="col-md-12 bg-primary"><h4>Detalles de Medidas y Colindancias</h4></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped corevatDataTable" id="ai_medidas_colindanciase-table">
			<thead>
				<tr>
					<th>#</th>
					<th>ORIENTACIÓN</th>
					<th>MEDIDAS</th>
					<th>OBSERVACIONES</th>
					<th>OPCIONES</th>
				</tr>
			</thead>
			<tbody>
				@if ( count($ai_medidas_colindancias) > 0 )
				@foreach ($ai_medidas_colindancias as $item)
				<tr>
					<td>{{$item->idaimedidacolindancia}}</td>
					<td>{{$item->orientacion}}</td>
					<td>{{$item->medida}}</td>
					<td>{{$item->colindancia}}</td>
					<td>
						<a href="#" class="btn btn-xs btn-info btnEdit"  idAi="{{$item->idaimedidacolindancia}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
						<a href="#" class="btn btn-xs btn-danger btnDel" idAi="{{$item->idaimedidacolindancia}}" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>
	<hr>

	<div class="col-md-12 bg-primary"><h4>Características de la Construcción</h4></div>

	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12">
		{{Form::label('id_cimentacion', 'Cimentación')}}
		{{Form::select('id_cimentacion', $cat_cimentaciones, $row->id_cimentacion, ['id' => 'id_cimentacion', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('id_estructura', 'Estructuras')}}
		{{Form::select('id_estructura', $cat_estructuras, $row->id_estructura, ['id' => 'id_estructura', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('id_muro', 'Muros')}}
		{{Form::select('id_muro', $cat_muros, $row->id_muro, ['id' => 'id_muro', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('id_entrepiso', 'Entrepisos')}}
		{{Form::select('id_entrepiso', $cat_entrepisos, $row->id_entrepiso, ['id' => 'id_entrepiso', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('id_techo', 'Techos')}}
		{{Form::select('id_techo', $cat_techos, $row->id_techo, ['id' => 'id_techo', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('id_barda', 'Bardas')}}
		{{Form::select('id_barda', $cat_bardas, $row->id_barda, ['id' => 'id_barda', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('idusossuelo', 'Uso de suelo')}}
		{{Form::select('idusossuelo', $cat_usos_suelos, $row->idusossuelo, ['id' => 'idusossuelo', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('servidumbre_restricciones', 'Servidumbres y Restricciones')}}
		{{Form::textarea('servidumbre_restricciones', $row->servidumbre_restricciones, ['class'=>'form-control'] )}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-5">
		{{Form::label('numero_niveles_unidad', 'Número de niveles de la Unidad')}}
		{{Form::select('numero_niveles_unidad', $cat_niveles, $row->numero_niveles_unidad, ['id' => 'numero_niveles_unidad', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-5">
		{{Form::label('unidades_rentables_escritura', 'Unidades Rentables en la misma Estructura')}}
		{{Form::number('unidades_rentables_escritura', $row->unidades_rentables_escritura, ['class'=>'form-control', 'step'=>'1', 'min' => '0', 'max' => '9999', 'pattern' => '[0-9]{4}'] )}}
		{{$errors->first('unidades_rentables_escritura', '<span class=text-danger>:message</span>')}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('descripcion_inmueble', 'Descripción general del inmueble')}}
		{{Form::textarea('descripcion_inmueble', $row->descripcion_inmueble, ['class'=>'form-control'] )}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12 bg-primary">
		<h4>Acabados</h4>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table">
			<thead>
				<tr>
					<th class="bg-primary"></th>
					<th class="bg-primary">PISOS</th>
					<th class="bg-primary">MUROS</th>
					<th class="bg-primary">PLAFONES</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th class="bg-primary">RECÁMARAS</th>
					<td>
						{{Form::select('id_recamara0', $cat_pisos, $row->id_recamara0, ['id' => 'id_recamara0', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_recamara1', $cat_aplanados, $row->id_recamara1, ['id' => 'id_recamara1', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_recamara2', $cat_plafones, $row->id_recamara2, ['id' => 'id_recamara2', 'class'=>'form-control'])}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">ESTANCIA COMEDOR</th>
					<td>
						{{Form::select('id_estancia_comedor0', $cat_pisos, $row->id_estancia_comedor0, ['id' => 'id_estancia_comedor0', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_estancia_comedor1', $cat_aplanados, $row->id_estancia_comedor1, ['id' => 'id_estancia_comedor1', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_estancia_comedor2', $cat_plafones, $row->id_estancia_comedor2, ['id' => 'id_estancia_comedor2', 'class'=>'form-control'])}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">BAÑOS</th>
					<td>
						{{Form::select('id_bano0', $cat_pisos, $row->id_bano0, ['id' => 'id_bano0', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_bano1', $cat_aplanados, $row->id_bano1, ['id' => 'id_bano1', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_bano2', $cat_plafones, $row->id_bano2, ['id' => 'id_bano2', 'class'=>'form-control'])}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">ESCALERAS</th>
					<td>
						{{Form::select('id_escalera0', $cat_pisos, $row->id_escalera0, ['id' => 'id_escalera0', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_escalera1', $cat_aplanados, $row->id_escalera1, ['id' => 'id_escalera1', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_escalera2', $cat_plafones, $row->id_escalera2, ['id' => 'id_escalera2', 'class'=>'form-control'])}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">COCINA</th>
					<td>
						{{Form::select('id_cocina0', $cat_pisos, $row->id_cocina0, ['id' => 'id_cocina0', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_cocina1', $cat_aplanados, $row->id_cocina1, ['id' => 'id_cocina1', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_cocina2', $cat_plafones, $row->id_cocina2, ['id' => 'id_cocina2', 'class'=>'form-control'])}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">PATIO DE SERVICIO</th>
					<td>
						{{Form::select('id_patio_servicio0', $cat_pisos, $row->id_patio_servicio0, ['id' => 'id_patio_servicio0', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_patio_servicio1', $cat_aplanados, $row->id_patio_servicio1, ['id' => 'id_patio_servicio1', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_patio_servicio2', $cat_plafones, $row->id_patio_servicio2, ['id' => 'id_patio_servicio2', 'class'=>'form-control'])}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">ESTACIONAMIENTO</th>
					<td>
						{{Form::select('id_estacionamiento0', $cat_pisos, $row->id_estacionamiento0, ['id' => 'id_estacionamiento0', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_estacionamiento1', $cat_aplanados, $row->id_estacionamiento1, ['id' => 'id_estacionamiento1', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_estacionamiento2', $cat_plafones, $row->id_estacionamiento2, ['id' => 'id_estacionamiento2', 'class'=>'form-control'])}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">FACHADA</th>
					<td>
						{{Form::select('id_fachada0', $cat_pisos, $row->id_fachada0, ['id' => 'id_fachada0', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_fachada1', $cat_aplanados, $row->id_fachada1, ['id' => 'id_fachada1', 'class'=>'form-control'])}}
					</td>
					<td>
						{{Form::select('id_fachada2', $cat_plafones, $row->id_fachada2, ['id' => 'id_fachada2', 'class'=>'form-control'])}}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12 bg-primary">
		<h4>Otros datos</h4>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('hidraulico_sanitarias', 'Hidráulico Sanitarias')}}
		{{Form::text('hidraulico_sanitarias', $row->hidraulico_sanitarias, ['class'=>'form-control', 'maxlength'=>'150'] )}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('electricas', 'Eléctricas')}}
		{{Form::text('electricas', $row->electricas, ['class'=>'form-control', 'maxlength'=>'150'] )}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('carpinteria', 'Carpintería')}}
		{{Form::text('carpinteria', $row->carpinteria, ['class'=>'form-control', 'maxlength'=>'150'] )}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('herreria', 'Herrería')}}
		{{Form::text('herreria', $row->herreria, ['class'=>'form-control', 'maxlength'=>'150'] )}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12 bg-primary">
		<h4>Superficies </h4>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table">
			<tbody>
				<tr>
					<th class="bg-primary">{{Form::label('superficie_total_terreno', 'Superficie Total del Terreno')}}</th>
					<td>
						{{Form::number('superficie_total_terreno', $row->superficie_total_terreno, ['class'=>'form-control', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999', 'pattern'=>'[0-9]{9}[.]{1}[0-9]{4}'] )}}
						{{$errors->first('superficie_total_terreno', '<span class=text-danger>:message</span>')}}
					</td>
					<th class="bg-primary">{{Form::label('indiviso_terreno', 'Indiviso del Terreno (%)')}}</th>
					<td>
						{{Form::number('indiviso_terreno', $row->indiviso_terreno, ['class'=>'form-control', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999', 'pattern'=>'[0-9]{9}[.]{1}[0-9]{4}'] )}}
						{{$errors->first('indiviso_terreno', '<span class=text-danger>:message</span>')}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">{{Form::label('superficie_terreno', 'Superficie del Terreno')}}</th>
					<td>
						{{Form::number('superficie_terreno', $row->superficie_terreno, ['id'=>'superficie_terreno','class'=>'form-control', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999', 'pattern'=>'[0-9]{9}[.]{1}[0-9]{4}'] )}}
						{{$errors->first('superficie_terreno', '<span class=text-danger>:message</span>')}}
					</td>

					<th class="bg-primary">{{Form::label('indiviso_areas_comunes', 'Indiviso de Áreas Comunes (%)')}}</th>
					<td>
						{{Form::number('indiviso_areas_comunes', $row->indiviso_areas_comunes, ['id'=>'indiviso_areas_comunes','class'=>'form-control', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999', 'pattern'=>'[0-9]{9}[.]{1}[0-9]{4}'] )}}
						{{$errors->first('indiviso_areas_comunes', '<span class=text-danger>:message</span>')}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">{{Form::label('superficie_construccion', 'Superficie de Construcción')}}</th>
					<td>
						{{Form::number('superficie_construccion', $row->superficie_construccion, ['id'=>'superficie_construccion','class'=>'form-control', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999', 'pattern'=>'[0-9]{9}[.]{1}[0-9]{4}'] )}}
						{{$errors->first('superficie_construccion', '<span class=text-danger>:message</span>')}}
					</td>

					<th class="bg-primary">{{Form::label('indiviso_accesoria', 'Indiviso Accesoría (%)')}}</th>
					<td>
						{{Form::number('indiviso_accesoria', $row->indiviso_accesoria, ['id'=>'indiviso_accesoria','class'=>'form-control', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999', 'pattern'=>'[0-9]{9}[.]{1}[0-9]{4}'] )}}
						{{$errors->first('indiviso_accesoria', '<span class=text-danger>:message</span>')}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">{{Form::label('superficie_escritura', 'Superficie Asentada en Escritura')}}</th>
					<td>
						{{Form::number('superficie_escritura', $row->superficie_escritura, ['id'=>'superficie_escritura','class'=>'form-control', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999', 'pattern'=>'[0-9]{9}[.]{1}[0-9]{4}'] )}}
						{{$errors->first('superficie_escritura', '<span class=text-danger>:message</span>')}}
					</td>

					<th class="bg-primary">{{Form::label('superficie_vendible', 'Superficie Vendible')}}</th>
					<td>
						{{Form::number('superficie_vendible', $row->superficie_vendible, ['id'=>'superficie_vendible','class'=>'form-control', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999', 'pattern'=>'[0-9]{9}[.]{1}[0-9]{4}'] )}}
						{{$errors->first('superficie_vendible', '<span class=text-danger>:message</span>')}}
					</td>
				</tr>
			</tbody>
		</table>
		<div class="col-md-12">&nbsp;</div>
		<hr>
		<div class="col-md-12 form-actions">
			{{Form::submit('Guardar', ['class'=>'btn btn-primary'])}}
			<a href="{{URL::route('indexAvaluos')}}" class="btn btn-primary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
		</div>
	</div>
</div>
{{Form::close()}}
<div id="divDialogForm" style="display: none;">
	{{Form::model($row, ['route' => array('setAiMedidasColindancias'), 'id'=>'formAiMedidasColindancias', 'method'=>'post' ]) }}
	<input type="hidden" name="ctrl" id="ctrl" value="" />
	<input type="hidden" name="idavaluoinmueble2" id="idavaluoinmueble2" value="{{$row->idavaluoinmueble}}" />
	<input type="hidden" name="idaimedidacolindancia" id="idaimedidacolindancia" value="0" />
	<div class="row">
		<div class="col-md-12">
			{{Form::label('idorientacion', 'Orientación')}}
			{{Form::select('idorientacion', $cat_orientaciones, 1, ['id' => 'idorientacion', 'class'=>'form-control'])}}
			<hr>
		</div>
		<div class="col-md-12">
			{{Form::label('medida', 'Medidas')}}
			{{Form::text('medida', '', ['class'=>'form-control', 'required' => 'required', 'maxlength'=>'50'] )}}
			<hr>
		</div>
		<div class="col-md-12">
			{{Form::label('colindancia', 'Colindancias')}}
			{{Form::text('colindancia', '', ['class'=>'form-control', 'required' => 'required', 'maxlength'=>'100'] )}}
			<hr>
		</div>
	</div>
		<div style="text-align: center; margin-top: 10px;" id="messagesDialogForm"></div>
	{{Form::close()}}
</div>
<div id="divDialogConfirm" style="display: none;">
	<div class="alert alert-danger text-center"><h3>¿Realmente desea eliminar el registro?</h3></div>
</div>
{{ HTML::style('/css/fileinput.min.css') }}
@section('javascript')
{{ HTML::script('/js/jquery/jquery.min.js') }}
{{ HTML::script('/js/jquery/jquery.mask.min.js') }}
{{ HTML::script('/js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
{{ HTML::script('/js/jquery.corevat.js') }}
{{ HTML::script('/js/fileinput.min.js') }}
{{ HTML::script('/js/fileinput_locale_es.js') }}
<script>
	$(document).ready(function () {
		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('#btn3Inmueble').removeClass("btn-info").addClass("btn-primary");


		// Va la validación a pie con JS Pure
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



		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('#btnNew').click(function () {
			$('#ctrl').val('ins');
			$('#idaimedidacolindancia').val('0');
			$('#medida, #colindancia').val('');
			$("#idorientacion option[value=1]").attr("selected", true);
			$('#divDialogForm').dialog({title: 'Capturar un nuevo registro'}).dialog('open');
		});

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('.btnEdit').click(function () {
			$('#ctrl').val('upd');
			$('#idaimedidacolindancia').val($(this).attr('idAi'));
			$.ajax({
				global: false,
				cache: false,
				dataType: 'json',
				url: '/corevat/AiMedidasColindanciasGet/' + $('#idaimedidacolindancia').val(),
				type: 'get',
				success: function (data) {
					datos = eval(data);
					$("#idorientacion option[value=" + datos.idorientacion + "]").attr("selected", true);
					$('#medida').val(datos.medida);
					$('#colindancia').val(datos.colindancia);
					$('#divDialogForm').dialog({title: 'Modificar registro'}).dialog('open');
				}
			});
		});

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('.btnDel').click(function () {
			$('#idaimedidacolindancia').val($(this).attr('idAi'));
			$('#divDialogConfirm').dialog({title: 'Eliminar registro'}).dialog('open');

		});

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$("#formAiMedidasColindancias").submit(function () {
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
		$('#divDialogForm').dialog({
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			closeOnEscape: true,
			width: 600,
			height: 550,
			buttons: {
				Guardar: function () {
					$("#formAiMedidasColindancias").submit();
				},
				Cerrar: function () {
					$(this).dialog('close');
				}
			},
			close: function() {
				if ( $('#messagesDialogForm').attr('class') == 'alert alert-success' ) {
					window.location.href = '/corevat/AvaluoInmueble/<?php echo $row->idavaluo ?>';
				}
			}
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
			width: 400,
			height: 300,
			buttons: {
				Aceptar: function () {
					$.ajax({
						global: false,
						cache: false,
						dataType: 'json',
						url: '/corevat/AiMedidasColindanciasDel/' + $('#idaimedidacolindancia').val(),
						type: 'get',
						success: function (data) {
							datos = eval(data);
							alert(datos.message);
							if (datos.success === true) {
								window.location.href = '/corevat/AvaluoInmueble/<?php echo $row->idavaluo ?>';
							}
						}
					});
					$('#divDialogConfirm').dialog("close");
				},
				Cancelar: function () {
					$(this).empty().dialog("close");
				}
			}
		});

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('#fachada, #croquis').fileinput({
			maxFileSize: 2000,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg"]
		});
	});
</script>
@stop
