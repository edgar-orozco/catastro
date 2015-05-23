	<h3 class="header">{{$title}}</h3>
	<hr>
	{{ Form::model($row, ['route' => array('updateAvaluoGeneral', $row->idavaluo), 'method'=>'post' ]) }}
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				{{Form::label('fecha_reporte', 'Fecha del Reporte')}}
				{{Form::text('fecha_reporte', $row->fecha_reporte, ['class'=>'form-control', 'tabindex'=>'1', 'autofocus' => 'autofocus', 'required' => 'required', 'maxlength' => '10', 'size' => '11', 'style' => 'width:110px'])}}
				{{$errors->first('fecha_reporte', '<span class=text-danger>:message</span>')}}
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				{{Form::label('fecha_avaluo', 'Fecha del Avaluo')}}
				{{Form::text('fecha_avaluo', $row->fecha_avaluo, ['class'=>'form-control', 'tabindex'=>'2', 'required' => 'required', 'maxlength' => '10', 'size' => '11', 'style' => 'width:110px'])}}
				{{$errors->first('fecha_avaluo', '<span class=text-danger>:message</span>')}}
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				{{Form::label('serie', 'Serie')}}
				{{Form::select('serie', array('U'=>'Urbano', 'R'=>'Rural'), null, ['id' => 'serie', 'class'=>'form-control', 'tabindex'=>'3', 'style' => 'width:110px'])}}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				{{Form::label('proposito', 'Próposito')}}
				{{Form::text('proposito', $row->proposito, ['class'=>'form-control', 'tabindex'=>'4', 'required' => 'required', 'maxlength' => '250'])}}
				{{$errors->first('proposito', '<span class=text-danger>:message</span>')}}
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				{{Form::label('finalidad', 'Finalidad')}}
				{{Form::text('finalidad', $row->finalidad, ['class'=>'form-control', 'tabindex'=>'4', 'required' => 'required', 'maxlength' => '250'])}}
				{{$errors->first('finalidad', '<span class=text-danger>:message</span>')}}
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				{{Form::label('idtipoinmueble', 'Tipo Inmueble')}}
				{{Form::select('idtipoinmueble', $cat_tipo_inmueble, $row->idtipoinmueble, ['id' => 'idtipoinmueble', 'class'=>'form-control', 'tabindex'=>'5'])}}
			</div>
		</div>
		<div class="col-md-8">
			<div class="form-group">
				{{Form::label('ubicacion', 'Ubicación')}}
				{{Form::text('ubicacion', $row->ubicacion, ['class'=>'form-control', 'tabindex'=>'6', 'maxlength' => '300'])}}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				{{Form::label('conjunto', 'Conjunto')}}
				{{Form::text('conjunto', $row->conjunto, ['class'=>'form-control', 'tabindex'=>'7', 'maxlength' => '150'])}}
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				{{Form::label('colonia', 'Colonia')}}
				{{Form::text('colonia', $row->colonia, ['class'=>'form-control', 'tabindex'=>'8', 'maxlength' => '150'])}}
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				{{Form::label('cp', 'C. P.')}}
				{{Form::text('cp', $row->cp, ['class'=>'form-control', 'tabindex'=>'9', 'maxlength' => '6'])}}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				{{Form::label('idestado', 'Estados')}}
				{{Form::select('idestado', $estados, $row->idestado, ['id' => 'idestado', 'class'=>'form-control', 'tabindex'=>'10'])}}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				{{Form::label('idmunicipio', 'Municipios')}}
				{{Form::select('idmunicipio', $municipios, $row->idmunicipio, ['id' => 'idmunicipio', 'class'=>'form-control', 'tabindex'=>'11'])}}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-inline">
				{{Form::label('Longitud')}}
				{{Form::text('lat0', $row->lan0, ['class'=>'form-control', 'tabindex'=>'12', 'maxlength'=>'3', 'style'=>'width:75px'])}}&nbsp;&ring;&nbsp;
				{{Form::text('lat1', $row->lan1, ['class'=>'form-control', 'tabindex'=>'13', 'maxlength'=>'2', 'style'=>'width:75px'])}}&nbsp;'&nbsp;
				{{Form::text('lat2', $row->lan2, ['class'=>'form-control', 'tabindex'=>'14', 'maxlength'=>'6', 'style'=>'width:75px'])}}&nbsp;"
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-inline">
				{{Form::label('Latitud')}}
				{{Form::text('lon0', $row->lat0, ['class'=>'form-control', 'tabindex'=>'15', 'maxlength'=>'3', 'style'=>'width:75px'])}}&nbsp;&ring;&nbsp;
				{{Form::text('lon1', $row->lat1, ['class'=>'form-control', 'tabindex'=>'16', 'maxlength'=>'2', 'style'=>'width:75px'])}}&nbsp;'&nbsp;
				{{Form::text('lon2', $row->lat2, ['class'=>'form-control', 'tabindex'=>'17', 'maxlength'=>'6', 'style'=>'width:75px'])}}&nbsp;"
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-inline">
				{{Form::label('Altitud')}}
				{{Form::text('altitud', $row->altitud, ['class'=>'form-control', 'tabindex'=>'17', 'maxlength'=>'50', 'size'=>'40'])}}
			</div>
		</div>
	</div>

	<br />
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				{{Form::label('idregimenpropiedad', 'Regimen')}}
				{{Form::select('idregimenpropiedad', $cat_regimen_propiedad, $row->idregimenpropiedad, ['id' => 'idregimenpropiedad', 'class'=>'form-control', 'tabindex'=>'18'])}}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				{{Form::label('cuenta_predial', 'Predial')}}
				{{Form::text('cuenta_predial', $row->cuenta_predial, ['class'=>'form-control', 'tabindex'=>'19', 'maxlength'=>'50', 'size'=>'40'])}}
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				{{Form::label('cuenta_catastral', 'Catastral')}}
				{{Form::text('cuenta_catastral', $row->cuenta_catastral, ['class'=>'form-control', 'tabindex'=>'20', 'maxlength'=>'15', 'size'=>'16'])}}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				{{Form::label('foliocoretemp', 'Folio COREVAT')}}
				{{Form::text('foliocoretemp', $row->foliocoretemp, ['class'=>'form-control', 'tabindex'=>'21', 'required' => 'required', 'maxlength'=>'50', 'size'=>'40'])}}
				{{$errors->first('foliocoretemp', '<span class=text-danger>:message</span>')}}
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				{{Form::label('nombre_solicitante','Solicitante')}}
				{{Form::text('nombre_solicitante', $row->nombre_solicitante, ['class'=>'form-control', 'tabindex'=>'22', 'maxlength'=>'100'])}}
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				{{Form::label('nombre_propietario','Propietario')}}
				{{Form::text('nombre_propietario', $row->nombre_propietario, ['class'=>'form-control', 'tabindex'=>'23', 'maxlength'=>'100'])}}
			</div>
		</div>
	</div>

	<div class="col-md-12 form-actions form-group">
		{{Form::submit('Guardar', ['class'=>'btn btn-primary'])}}
		<a href="{{URL::route('indexAvaluos')}}" class="btn btn-primary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	</div>
	{{Form::close()}}
@section('javascript')
{{ HTML::script('/js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
{{ HTML::script('/js/jquery.corevat.js') }}
<script>
	$(document).ready(function() {
		$('#fecha_reporte, #fecha_avaluo').datepicker();
		$('#btn1General').removeClass("btn-info").addClass("btn-primary");
	});
</script>
@stop
