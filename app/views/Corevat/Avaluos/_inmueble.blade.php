<h3 class="header">{{$title}}</h3>
{{Form::model($row, ['route' => array('updateAvaluoInmueble', $idavaluo), 'class'=>'horizontal', 'method'=>'post', 'id'=>'formAvaluoInmueble', 'enctype'=>'multipart/form-data' ]) }}
{{Form::hidden('idavaluoinmueble', $row->idavaluoinmueble, ['id'=>'idavaluoinmueble'])}}
<div id="inmueblesCoverat">
<div class="row">
	<div class="col-md-12"><h4>Subir imagenes</h4></div>
	<div class="col-md-6">
		<hr>
		<div class="input-group addImage">
			<span class="input-group-addon">{{Form::label('croquis', 'Croquis')}}</span>
			{{Form::file('croquis',['class='=>'input-group']) }}
			@if ( $croquis != '' )
				<span class="input-group-btn"><a class="btn btn-success" type="button" target='_blank' href="{{$croquis}}">Ver Croquis</a></span>
			@endif
		</div>
		<br />
		<p>Tamaño máximo de 2 MB. Formato de imagenes: png y jpg</p>
		<hr>
	</div>
	
	<div class="col-md-6">
		<hr>
		<div class="input-group addImage">
			<span class="input-group-addon" id="basic-addon1">{{Form::label('fachada', 'Fachada')}}</span>
			{{Form::file('fachada',['class='=>'input-group']) }}	
			@if ( $fachada != '' )
			<span class="input-group-btn"><a class="btn btn-success" type="button" target='_blank' href="{{$fachada}}">Ver Fachada</a></span>
			@endif
		</div>
		<br />
		<p>Tamaño máximo de 2 MB. Formato de imagenes: png y jpg</p>
		<hr>
	</div>

	<div class="col-md-12"><h3>Medidas y Colindancias</h3></div>
	<div class="col-md-10 col-sm-10 col-xs-10"><h4>Detalles de Medidas y Colindancias</h4></div>

	<div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title">
		<a class="btn btn-primary nuevo" id="btnNew" title="Nuevo Avaluo">
			<span class="glyphicon glyphicon-plus-sign"></span> Nuevo
		</a>
	</div>
	<div class="clearfix"></div>
	<br/>
	<div class="col-md-12" style="margin-top: 10px;">
		{{Form::label('segun', 'Según')}}
		{{Form::text('segun', $row->segun, ['class'=>'form-control', 'required' => 'required', 'maxlength' => '150'])}}
		{{$errors->first('segun', '<span class=text-danger>:message</span>')}}
		<hr>
	</div>
	
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped corevatDataTable" id="aiMedidasColindanciasDataTable">
			<thead>
				<tr>
					<th style="width:5%;">#</th>
					<th style="width:20%;">ORIENTACIÓN</th>
					<th style="width:10%;">U.M.</th>
					<th style="width:20%;">MEDIDAS</th>
					<th style="width:40%;">COLINDANCIAS</th>
					<th style="width:3%;">OPCIONES</th>
				</tr>
			</thead>
		</table>
	</div>

	<div class="col-md-12">&nbsp;</div>
	<hr>

	<div class="col-md-12"><h4>Características de la Construcción</h4></div>

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
		{{Form::textarea('servidumbre_restricciones', $row->servidumbre_restricciones, ['class'=>'form-control', 'rows' => '3', 'maxlength'=>'250'] )}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-5">
		{{Form::label('numero_niveles_unidad', 'Número de niveles de la Unidad')}}
		{{Form::number('numero_niveles_unidad', $row->numero_niveles_unidad, ['class'=>'form-control', 'step'=>'1', 'min' => '0', 'max' => '99'] )}}
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-5">
		{{Form::label('unidades_rentables_escritura', 'Unidades Rentables en la misma Estructura')}}
		{{Form::number('unidades_rentables_escritura', $row->unidades_rentables_escritura, ['class'=>'form-control', 'step'=>'1', 'min' => '0', 'max' => '9999'] )}}
		{{$errors->first('unidades_rentables_escritura', '<span class=text-danger>:message</span>')}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">
		{{Form::label('descripcion_inmueble', 'Descripción general del inmueble')}}
		{{Form::textarea('descripcion_inmueble', $row->descripcion_inmueble, ['class'=>'form-control', 'maxlength'=>'150'] )}}
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-10 col-sm-10 col-xs-10"><h4>Acabados</h4></div>

	<div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title">
		<a class="btn btn-primary nuevo" id="btnNewAcabado" title="Nuevo Acabado">
			<span class="glyphicon glyphicon-plus-sign"></span> Nuevo
		</a>
	</div>
	<div class="clearfix"></div>
	<br/>

	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped corevatDataTable" id="aiAcabadosDataTable">
			<thead>
				<tr>
					<th style="width:5%;">#</th>
					<th style="width:25%;">Acabado</th>
					<th style="width:25%;">Pisos</th>
					<th style="width:25%;">Muros</th>
					<th style="width:25%;">Plafones</th>
					<th style="width:5%;">Opciones</th>
				</tr>
			</thead>
		</table>
	</div>

	<div class="col-md-12"><hr></div>

	<div class="col-md-12"><h4>Otros datos</h4></div>

	<div class="col-md-12">
		{{Form::label('hidraulico_sanitarias', 'Hidráulico Sanitarias')}}
		{{Form::text('hidraulico_sanitarias', $row->hidraulico_sanitarias, ['class'=>'form-control', 'maxlength'=>'150'] )}}
	</div>

	<div class="col-md-12">
		{{Form::label('electricas', 'Eléctricas')}}
		{{Form::text('electricas', $row->electricas, ['class'=>'form-control', 'maxlength'=>'150'] )}}
	</div>

	<div class="col-md-12">
		{{Form::label('carpinteria', 'Carpintería')}}
		{{Form::text('carpinteria', $row->carpinteria, ['class'=>'form-control', 'maxlength'=>'150'] )}}
	</div>

	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table">
			<tbody>
				<tr>
					<th class="bg-primary" rowspan="2">Herrería</th>
					<th class="bg-primary">Ventanas</th>
					<td><input type="text" class="form-control typeahead" name="herreria_ventana" id="herreria_ventana" data-provide="typeahead" value="{{$row->herreria_ventana}}" style="z-index: 1051;" maxlength="150" /></td>
					<th class="bg-primary" rowspan="2">Aluminio</th>
					<th class="bg-primary">Ventanas</th>
					<td><input type="text" class="form-control typeahead" name="aluminio_ventana" id="aluminio_ventana" data-provide="typeahead" value="{{$row->aluminio_ventana}}" style="z-index: 1051;" maxlength="150" /></td>
				</tr>
				<tr>
					<th class="bg-primary">Puertas</th>
					<td><input type="text" class="form-control typeahead" name="herreria_puerta" id="herreria_puerta" data-provide="typeahead" value="{{$row->herreria_puerta}}" style="z-index: 1051;"  maxlength="150"/></td>
					<th class="bg-primary">Vidreria</th>
					<td><input type="text" class="form-control typeahead" name="aluminio_puerta" id="aluminio_puerta" data-provide="typeahead" value="{{$row->aluminio_puerta}}" style="z-index: 1051;"  maxlength="150"/></td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="col-md-12">
		<h4>Superficies </h4>
	</div>

	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table">
			<tbody>
				<tr>
					<th class="bg-primary"><label for="superficie_total_terreno">Superficie Total del Terreno M&sup2;</label></th>
					<td>
						{{Form::number('superficie_total_terreno', $row->superficie_total_terreno, ['class'=>'form-control clsNumeric', 'step'=>'0.0001', 'min'=>'0.0001', 'max'=>'999999999.9999'])}}
						{{$errors->first('superficie_total_terreno', '<span class=text-danger>:message</span>')}}
					</td>
					<th class="bg-primary">{{Form::label('indiviso_terreno', 'Indiviso del Terreno (%)')}}</th>
					<td>
						{{Form::number('indiviso_terreno', $row->indiviso_terreno, ['class'=>'form-control clsNumeric', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999.9999'])}}
						{{$errors->first('indiviso_terreno', '<span class=text-danger>:message</span>')}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">{{Form::label('superficie_terreno', 'Superficie del Terreno M&sup2;')}}</th>
					<td>
						{{Form::number('superficie_terreno', $row->superficie_terreno, ['id'=>'superficie_terreno','class'=>'form-control clsNumeric', 'step'=>'0.0001', 'min'=>'0.0001', 'max'=>'999999999.9999'] )}}
						{{$errors->first('superficie_terreno', '<span class=text-danger>:message</span>')}}
					</td>

					<th class="bg-primary">{{Form::label('indiviso_areas_comunes', 'Indiviso de Áreas Comunes (%)')}}</th>
					<td>
						{{Form::number('indiviso_areas_comunes', $row->indiviso_areas_comunes, ['id'=>'indiviso_areas_comunes','class'=>'form-control clsNumeric', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999'] )}}
						{{$errors->first('indiviso_areas_comunes', '<span class=text-danger>:message</span>')}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">{{Form::label('superficie_construccion', 'Superficie de Construcción M&sup2;')}}</th>
					<td>
						{{Form::number('superficie_construccion', $row->superficie_construccion, ['id'=>'superficie_construccion','class'=>'form-control clsNumeric', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999'] )}}
						{{$errors->first('superficie_construccion', '<span class=text-danger>:message</span>')}}
					</td>

					<th class="bg-primary">{{Form::label('indiviso_accesoria', 'Edad de la Construcción (años)')}}</th>
					<td>
						{{Form::number('indiviso_accesoria', $row->indiviso_accesoria, ['id'=>'indiviso_accesoria','class'=>'form-control clsNumeric', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999'] )}}
						{{$errors->first('indiviso_accesoria', '<span class=text-danger>:message</span>')}}
					</td>
				</tr>
				<tr>
					<th class="bg-primary">{{Form::label('superficie_escritura', 'Superficie Asentada en Escritura M&sup2;')}}</th>
					<td>
						{{Form::number('superficie_escritura', $row->superficie_escritura, ['id'=>'superficie_escritura','class'=>'form-control clsNumeric', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999'])}}
						{{$errors->first('superficie_escritura', '<span class=text-danger>:message</span>')}}
					</td>

					<th class="bg-primary">{{Form::label('superficie_vendible', 'Superficie Vendible')}}</th>
					<td>
						{{Form::number('superficie_vendible', $row->superficie_vendible, ['id'=>'superficie_vendible','class'=>'form-control clsNumeric', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'999999999.9999'])}}
						{{$errors->first('superficie_vendible', '<span class=text-danger>:message</span>')}}
					</td>
				</tr>
			</tbody>
		</table>
		<div class="col-md-12"><hr></div>

		<div class="col-md-6 form-actions">
			<a href="{{URL::route('indexAvaluos')}}" class="btn btn-coveratSecondary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
		</div>
		<div class="col-md-6 form-actions">
			{{Form::submit('Guardar', ['class'=>'btn btn-coveratPrincipal'])}}
		</div>
	</div>
</div>
{{Form::close()}}

<div class="modal fade bs-example-modal-lg" id="modalFormAiMedidasColindancias" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalFormAiMedidasColindanciasTitle"></h4>
			</div>
			{{Form::model($row, ['route' => array('setAiMedidasColindancias'), 'id'=>'formAiMedidasColindancias', 'method'=>'post' ]) }}
			<input type="hidden" name="ctrl" id="ctrl" value="" />
			<input type="hidden" name="idavaluoinmueble2" id="idavaluoinmueble2" value="{{$row->idavaluoinmueble}}" />
			<input type="hidden" name="idaimedidacolindancia" id="idaimedidacolindancia" value="0" />
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						{{Form::label('idorientacion', 'Orientación')}}
						{{Form::select('idorientacion', $cat_orientaciones, 1, ['id' => 'idorientacion', 'class'=>'form-control'])}}
						<hr>
					</div>

					<div class="col-md-4">
						{{Form::label('medidas', 'Medidas')}}
						{{Form::number('medidas', $row->medidas, ['id'=>'medidas', 'class'=>'form-control clsNumeric', 'required' => 'required', 'step'=>'0.0001', 'min' => '0.0001', 'max' => '9999999999.9999'])}}
						<hr>
					</div>

					<div class="col-md-4">
						{{Form::label('medida', 'Medidas (Anterior)')}}
						{{Form::text('medida', $row->medida, ['id'=>'medida', 'class'=>'form-control', 'disabled'=>'disabled', 'maxlength' => '50'])}}
						<hr>
					</div>

					<div class="col-md-4">
						{{Form::label('unidad_medida', 'Unidad de Medida')}}
						{{Form::select('unidad_medida', $arrMedCol, $row->unidad_medida, ['id' => 'unidad_medida', 'class'=>'form-control'])}}
						<hr>
					</div>

					<div class="col-md-8">
						{{Form::label('colindancia', 'Colindancias')}}
						{{Form::text('colindancia', '', ['id'=>'colindancia', 'class'=>'form-control', 'required' => 'required', 'maxlength'=>'100'] )}}
						<hr>
					</div>
				</div>
				
				<div style="text-align: center;" id="messagesDialogForm"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Aceptar</button>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalFormAiAcabados" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalFormAiAcabadosTitle"></h4>
			</div>
			{{Form::model($row, ['route' => array('setAiAcabados'), 'id'=>'formAiAcabados', 'method'=>'post' ]) }}
			<input type="hidden" name="ctrl_acabado" id="ctrl_acabado" value="" />
			<input type="hidden" name="idavaluoinmueble3" id="idavaluoinmueble3" value="{{$row->idavaluoinmueble}}" />
			<input type="hidden" name="idaiacabado" id="idaiacabado" value="0" />
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						{{Form::label('fk_cat_acabados', 'Acabados')}}
						{{Form::select('fk_cat_acabados', $cat_acabados, 1, ['id' => 'fk_cat_acabados', 'class'=>'form-control'])}}
						<hr>
					</div>

					<div class="col-md-6">
						{{Form::label('fk_cat_pisos', 'Pisos')}}
						{{Form::select('fk_cat_pisos', $cat_pisos, 1, ['id' => 'fk_cat_pisos', 'class'=>'form-control'])}}
						<hr>
					</div>

					<div class="col-md-6">
						{{Form::label('fk_cat_aplanados', 'Muros')}}
						{{Form::select('fk_cat_aplanados', $cat_aplanados, 1, ['id' => 'fk_cat_aplanados', 'class'=>'form-control'])}}
						<hr>
					</div>

					<div class="col-md-6">
						{{Form::label('fk_cat_plafones', 'Plafones')}}
						{{Form::select('fk_cat_plafones', $cat_plafones, 1, ['id' => 'fk_cat_plafones', 'class'=>'form-control'])}}
						<hr>
					</div>

				</div>
				
				<div style="text-align: center;" id="messagesDialogFormAcabados"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Aceptar</button>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>

</div>
{{ HTML::style('/css/fileinput.min.css') }}

@section('javascript')
{{ HTML::script('/js/jquery/jquery.min.js') }}
{{ HTML::script('/js/jquery/jquery.mask.min.js') }}
{{ HTML::script('/js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/bootstrap.min.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
{{ HTML::script('/js/fileinput.min.js') }}
{{ HTML::script('/js/fileinput_locale_es.js') }}
{{ HTML::script('/js/jquery.corevat.js') }}
{{ HTML::script('/js/bootstrap3-typeahead.js') }}
{{ HTML::script('/js/jquery.corevat.inmueble.js') }}
@stop
