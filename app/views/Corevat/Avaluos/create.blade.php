@extends('layouts.default')
@section('content')
{{ HTML::style('/css/bootstrap.min.css') }}
{{ HTML::style('/css/coverat.css') }}
{{ HTML::style('/js/jquery/jquery-ui.css') }}
<h3 style="display: block; text-align: center;">Crear Nuevo Avalúo</h3>
@if( $errors->all() )
<div class="alert alert-danger">
	@foreach($errors->all() as $error )
	<h4><span class="glyphicon glyphicon-remove"></span>  {{ $error }}</h4>
	@endforeach
</div>
@endif
{{ Form::open(array('id'=>'formGeneral','url' => 'corevat/AvaluosStore/', 'method' => 'POST')) }}
<input type="hidden" name="cuenta_predial" id="cuenta_predial" value="{{$row->cuenta_predial}}" />
<input type="hidden" name="cuenta_catastral" id="cuenta_catastral" value="{{$row->cuenta_catastral}}" />
<div class="row coveratCont">
	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('fecha_reporte', 'Fecha del Reporte : ',['class'=>'col-sm-2'])}}
			<div class="col-md-10">
				{{Form::text('fecha_reporte', $row->fecha_reporte, ['class'=>'form-control', 'tabindex'=>'1', 'required' => 'required', 'maxlength' => '10', 'size' => '11', 'style' => 'width:110px;', 'readonly'=>'readonly'])}}
				{{$errors->first('fecha_reporte', '<span class=text-danger>:message</span>')}}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('fecha_avaluo', 'Fecha del Avalúo : ',['class'=>'col-sm-2'])}}
			<div class="col-md-10">
				{{Form::text('fecha_avaluo', $row->fecha_avaluo, ['class'=>'form-control', 'tabindex'=>'2', 'required' => 'required', 'maxlength' => '10', 'size' => '11', 'style' => 'width:110px', 'readonly'=>'readonly'])}}
				{{$errors->first('fecha_avaluo', '<span class=text-danger>:message</span>')}}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('serie', 'Tipo de predio : ',['class'=>'col-sm-2'])}}
			<div class="col-md-10">
				{{Form::select('serie', array('U'=>'Urbano', 'R'=>'Rústico'), null, ['id' => 'serie', 'class'=>'form-control', 'tabindex'=>'3', 'style' => 'width:110px'])}}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('proposito', 'Propósito : ',['class'=>'col-sm-2'])}}
			<div class="col-md-10">
				{{Form::text('proposito', $row->proposito, ['class'=>'form-control', 'tabindex'=>'4', 'required' => 'required', 'maxlength' => '250'])}}
				{{$errors->first('proposito', '<span class=text-danger>:message</span>')}}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('fk_finalidad', 'Finalidad : ',['class'=>'col-sm-2'])}}
			<div class="col-md-10">
				{{Form::select('fk_finalidad', $cat_finalidad, $row->fk_finalidad, ['id' => 'fk_finalidad', 'class'=>'form-control', 'tabindex'=>'5', 'required' => 'required'])}}
				{{$errors->first('fk_finalidad', '<span class=text-danger>:message</span>')}}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('idtipoinmueble', 'Tipo Inmueble : ',['class'=>'col-sm-2'])}}
			<div class="col-md-10">
				{{Form::select('idtipoinmueble', $cat_tipo_inmueble, $row->idtipoinmueble, ['id' => 'idtipoinmueble', 'class'=>'form-control', 'tabindex'=>'6'])}}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{Form::label('ubicacion', 'Ubicación : ',['class'=>'col-sm-4'])}}
			<div class="col-md-8">
				{{Form::text('ubicacion', $row->ubicacion, ['class'=>'form-control', 'tabindex'=>'7', 'maxlength' => '300'])}}
			</div>
		</div>
	</div>


	<div class="col-md-6">
		<div class="form-group">
			{{Form::label('conjunto', 'Conjunto : ',['class'=>'col-sm-4'])}}
			<div class="col-md-8">
				{{Form::text('conjunto', $row->conjunto, ['class'=>'form-control', 'tabindex'=>'8', 'maxlength' => '150'])}}
			</div>
		</div>
	</div>
    <!-- RENGLON 5 -->
	<div class="col-md-6">
		<div class="form-group">
			{{Form::label('colonia', 'Colonia : ',['class'=>'col-sm-4'])}}
			<div class="col-md-8">
				{{Form::text('colonia', $row->colonia, ['class'=>'form-control', 'tabindex'=>'9', 'maxlength' => '150'])}}
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			{{Form::label('idestado', 'Estados : ',['class'=>'col-sm-4'])}}
			<div class="col-md-8">
				<select class="form-control" name="idestado" id="idestado">
					@foreach ($estados as $estado)
						@if ( $estado->idestado == $row->idestado )
						<option value="{{$estado->idestado}}" selected="selected" clave="{{$estado->clave}}">{{ $estado->estado }}</option>
						@else
						<option value="{{$estado->idestado}}" clave="{{$estado->clave}}">{{ $estado->estado }}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			{{Form::label('idmunicipio', 'Municipios : ',['class'=>'col-sm-4'])}}
			<div class="col-md-8">
				<select class="form-control" name="idmunicipio" id="idmunicipio">
					@foreach ($municipios as $municipio)
						@if ( $municipio->idmunicipio == $row->idmunicipio )
						<option value="{{$municipio->clave}}" selected="selected" clave="{{$municipio->clave}}">{{ $municipio->municipio }}</option>
						@else
						<option value="{{$municipio->clave}}" clave="{{$municipio->clave}}">{{ $municipio->municipio }}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			{{Form::label('cp', 'C. P. : ',['class'=>'col-sm-4'])}}
			<div class="col-md-8">
				{{Form::select('cp', $lstCP, $row->cp, ['id' => 'cp', 'class'=>'form-control', 'tabindex'=>'12', 'required' => 'required'])}}
			</div>
		</div>
	</div>

	<div class="col-md-12"><hr></div>

	<div class="col-md-6">
		<div class="form-group">
			<label for="tp_coordenada_a" class="col-sm-6">Coordenadas Geográficas</label>
			<div class="col-md-4 col-md-offset-2" style="text-align: center;">
				<input type="radio" name="tp_coordenada" value="false" class="form-control tp_coordenada" id="tp_coordenada_a" <?php if($row->tp_coordenada!= "1") { echo 'checked="checked"'; } ?> >
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="tp_coordenada_b" class="col-sm-6">Coordenadas Geométricas</label>
			<div class="col-md-4 col-md-offset-2" style="text-align: center;">
				<input type="radio" name="tp_coordenada" value="true" class="form-control tp_coordenada" id="tp_coordenada_b" <?php if($row->tp_coordenada== "1") { echo 'checked="checked"'; } ?> >
			</div>
		</div>
	</div>

	<div class="col-md-12"><hr></div>

	<div class="col-md-6">
		<div class="form-group">
			<label for="sistema_coordenadas" class="col-sm-6">Sistema de coordenadas</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="sistema_coordenadas" id="sistema_coordenadas" maxlength="50" value="{{$row->sistema_coordenadas}}" <?php if($row->tp_coordenada!= "1") { echo 'disabled="disabled"'; } ?> />
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="datum" class="col-sm-6">DATUM</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="datum" id="datum" maxlength="50" value="{{$row->datum}}" <?php if($row->tp_coordenada!= "1") { echo 'disabled="disabled"'; } ?> />
			</div>
		</div>
	</div>

	<div class="col-md-12"><hr></div>

	<div class="col-md-12">
		{{Form::label('longitud', 'Longitud : ',['class'=>'col-sm-2'])}}
		<div class="col-md-10">
			{{Form::text('longitud', $row->longitud, ['class'=>'form-control', 'id' => 'longitud', 'tabindex'=>'13', 'required' => 'required'])}}
		</div>
	</div>
	<div class="col-md-12">
		{{Form::label('latitud', 'Latitud : ',['class'=>'col-sm-2'])}}
		<div class="col-md-10">
			{{Form::text('latitud', $row->latitud, ['class'=>'form-control', 'id' => 'latitud', 'tabindex'=>'14', 'required' => 'required'])}}
		</div>
	</div>

	<div class="col-md-12"><hr></div>

	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('idregimenpropiedad', 'Régimen de propiedad: ',['class'=>'col-sm-2'])}}
			<div class="col-md-10">
				{{Form::select('idregimenpropiedad', $cat_regimen_propiedad, $row->idregimenpropiedad, ['id' => 'idregimenpropiedad', 'class'=>'form-control', 'tabindex'=>'20'])}}
			</div>
		</div>
	</div>

	<div class="col-md-12"><hr></div>

	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('numero_cuenta', 'Cuenta Predial : ',['class'=>'col-sm-2'])}}
			<div class="col-md-2">
				{{Form::text('cta_predial', null, ['class'=>'form-control', 'id' => 'cta_predial', 'disabled' => 'disabled'])}}
			</div>
			<div class="col-md-2">
				{{Form::number('numero_cuenta', $row->numero_cuenta, ['id'=>'numero_cuenta','class'=>'form-control clsNumeric', 'step'=>'1', 'min'=>'0', 'max'=>'999999', 'maxlength' => '6'])}}
				{{$errors->first('numero_cuenta', '<span class=text-danger>:message</span>')}}
			</div>
		</div>
	</div>

	<div class="col-md-12"><hr></div>

	<div class="col-md-12">
			{{Form::label('', 'Clave Catastral : ',['class'=>'col-sm-2'])}}
			<div class="col-md-1">
				{{Form::text('clv_catastral', null, ['class'=>'form-control', 'id' => 'clv_catastral', 'disabled' => 'disabled'])}}
			</div>
			
			{{Form::label('clave_zona', 'Clave Zona : ',['class'=>'col-sm-2'])}}
			<div class="col-md-1">
				{{Form::number('clave_zona', $row->clave_zona, ['id'=>'clave_zona', 'class'=>'form-control clsNumeric', 'step'=>'1', 'min'=>'0', 'max'=>'999', 'maxlength' => '3'])}}
				{{$errors->first('clave_zona', '<span class=text-danger>:message</span>')}}
			</div>
			
			{{Form::label('clave_manzana', 'Clave Manzana : ',['class'=>'col-sm-2'])}}
			<div class="col-md-1">
				{{Form::number('clave_manzana', $row->clave_manzana, ['id'=>'clave_manzana', 'class'=>'form-control clsNumeric', 'step'=>'1', 'min'=>'0', 'max'=>'9999', 'maxlength' => '4'])}}
				{{$errors->first('clave_manzana', '<span class=text-danger>:message</span>')}}
			</div>

			{{Form::label('clave_predio', 'Clave Predio : ',['class'=>'col-sm-2'])}}
			<div class="col-md-1">
				{{Form::number('clave_predio', $row->clave_predio, ['id'=>'clave_predio', 'class'=>'form-control clsNumeric', 'step'=>'1', 'min'=>'0', 'max'=>'999999', 'maxlength' => '6'])}}
				{{$errors->first('clave_predio', '<span class=text-danger>:message</span>')}}
			</div>

	</div>

	<div class="col-md-12"><hr></div>

	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('foliocoretemp', 'Folio COREVAT : ',['class'=>'col-sm-2'])}}
			<div class="col-md-10">
				{{Form::text('foliocoretemp', $row->foliocoretemp, ['class'=>'form-control', 'tabindex'=>'23', 'required' => 'required', 'maxlength'=>'20', 'size'=>'21'])}}
				{{$errors->first('foliocoretemp', '<span class=text-danger>:message</span>')}}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('nombre_solicitante','Solicitante : ',['class'=>'col-sm-2'])}}
			<div class="col-md-2">
				{{Form::select('fk_titulo_solicitante', $cat_titulo_persona, $row->fk_titulo_solicitante, ['id' => 'fk_titulo_solicitante', 'class'=>'form-control', 'tabindex'=>'5', 'required' => 'required'])}}
			</div>
			<div class="col-md-8">
				{{Form::text('nombre_solicitante','', ['class'=>'form-control', 'tabindex'=>'24', 'maxlength'=>'100', 'required'=>'required'])}}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('nombre_propietario','Propietario : ',['class'=>'col-sm-2'])}}
			<div class="col-md-2">
				{{Form::select('fk_titulo_propietario', $cat_titulo_persona, $row->fk_titulo_propietario, ['id' => 'fk_titulo_propietario', 'class'=>'form-control', 'tabindex'=>'5', 'required' => 'required'])}}
			</div>
			<div class="col-md-8">
				{{Form::text('nombre_propietario','', ['class'=>'form-control', 'tabindex'=>'25', 'maxlength'=>'100', 'required'=>'required'])}}
			</div>
		</div>
	</div>
	<div class="col-md-4 form-actions form-group">
		<a href="{{URL::route('corevat.Avaluos.index')}}" class="btn btn-coveratSecondary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	</div>
	<div class="col-md-4 form-actions form-group">
		{{Form::reset('Limpiar formulario', ['class' => 'btn btn-coveratSecondary']) }}
	</div>
	<div class="col-md-4 form-actions form-group">
		{{Form::submit('Guardar', ['class'=>'btn btn-coveratPrincipal'])}}
	</div>
</div>
{{Form::close()}}
@stop
@section('javascript')
{{ HTML::script('/js/jquery/jquery.min.js') }}
{{ HTML::script('/js/jquery/jquery.mask.min.js') }}
{{ HTML::script('/js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
{{ HTML::script('/js/jquery/jquery.mask.min.js') }}
{{ HTML::script('/js/jquery.corevat.js') }}

<script>
	$(document).ready(function () {

		$('#numero_cuenta, #clave_predio').mask('000000');
		$('#clave_zona').mask('000');
		$('#clave_manzana').mask('0000');
		
		$("#cta_predial").val( $("#idmunicipio").find('option:selected').attr('clave') + '-' + $("#serie").find('option:selected').val() + '-' );
		//$("#numero_cuenta").val( '0' );
		_numero_cuenta = $("#numero_cuenta").val();
		$("#cuenta_predial").val( $("#cta_predial").val() + ("000000").substring(0, ("000000").length - _numero_cuenta.length ) + parseInt($("#numero_cuenta").val()) );
		

		$("#clv_catastral").val( $("#idestado").find('option:selected').attr('clave') + '-' + $("#idmunicipio").find('option:selected').attr('clave') + '-' );
		//$("#clave_zona").val( '0' );
		//$("#clave_manzana").val( '0' );
		//$("#clave_predio").val( '0' );
		
		_clave_zona = $("#clave_zona").val();
		_clave_manzana = $("#clave_manzana").val();
		_clave_predio = $("#clave_predio").val();
		$("#cuenta_catastral").val( $("#clv_catastral").val() 
				+ ("000").substring(0, ("000").length - _clave_zona.length ) + $("#clave_zona").val() + '-' +
				+ ("0000").substring(0, ("0000").length - _clave_manzana.length ) + $("#clave_manzana").val() + '-' +
				+ ("000000").substring(0, ("000000").length - _clave_predio.length ) + $("#clave_predio").val() );
		
		
		$("#serie").change(function() {
			_numero_cuenta = $("#numero_cuenta").val();
			$("#cta_predial").val( $("#idmunicipio").find('option:selected').attr('clave') + '-' + $("#serie").find('option:selected').val() + '-' );
			$("#cuenta_predial").val( $("#cta_predial").val() + ("000000").substring(0, ("000000").length - _numero_cuenta.length ) + parseInt($("#numero_cuenta").val()) );
		});

		$('#idestado').on("change", function () {
			_clave_zona = $("#clave_zona").val();
			_clave_manzana = $("#clave_manzana").val();
			_clave_predio = $("#clave_predio").val();
			$("#clv_catastral").val( $("#idestado").find('option:selected').attr('clave') + '-' + $("#idmunicipio").find('option:selected').attr('clave') + '-' );
			$("#cuenta_catastral").val( $("#clv_catastral").val() 
					+ ("000").substring(0, ("000").length - _clave_zona.length ) + $("#clave_zona").val() + '-' +
					+ ("0000").substring(0, ("0000").length - _clave_manzana.length ) + $("#clave_manzana").val() + '-' +
					+ ("000000").substring(0, ("000000").length - _clave_predio.length ) + $("#clave_predio").val() );

			$.get("{{ url('getMunicipiosFromEstados')}}", {option: $(this).val()},
				function (json) {
					var model = $('#idmunicipio').empty();
					$.each(json, function (i, item) {
						model.append("<option value='" + item.idmunicipio + "'>" + item.municipio + "</option>");
					});
				}
			);
		});

		$('#idmunicipio').on("change", function () {
			$("#cta_predial").val( $("#idmunicipio").find('option:selected').attr('clave') + '-' + $("#serie").find('option:selected').val() + '-' );
			$("#cuenta_predial").val( $("#cta_predial").val() + ("000000").substring(0, ("000000").length - ($("#numero_cuenta").val()) ) + parseInt($("#numero_cuenta").val()) );

			_clave_zona = $("#clave_zona").val();
			_clave_manzana = $("#clave_manzana").val();
			_clave_predio = $("#clave_predio").val();
			$("#clv_catastral").val( $("#idestado").find('option:selected').attr('clave') + '-' + $("#idmunicipio").find('option:selected').attr('clave') + '-' );
			$("#cuenta_catastral").val( $("#clv_catastral").val() 
					+ ("000").substring(0, ("000").length - _clave_zona.length ) + $("#clave_zona").val() + '-' +
					+ ("0000").substring(0, ("0000").length - _clave_manzana.length ) + $("#clave_manzana").val() + '-' +
					+ ("000000").substring(0, ("000000").length - _clave_predio.length ) + $("#clave_predio").val() );
			$.get("{{ url('getCPFromMunicipios')}}", {option: $(this).val()},
				function (json) {
					var model = $('#cp').empty();
					$.each(json, function (i, item) {
						model.append("<option value='" + item.codigo_postal + "'>" + item.codigo_postal + "</option>");
					});
				}
			);
		});

		$(".tp_coordenada").click(function () {
			$("#sistema_coordenadas, #datum").attr('disabled', ($(this).val() === 'false' ? true : false) );
		});
		
	});
</script>

@stop
