<h3 class="header">{{$title}}</h3>
    @if( $errors->all() )
        <div class="alert alert-danger">
			@foreach($errors->all() as $error )
			<h4><span class="glyphicon glyphicon-remove"></span>  {{ $error }}</h4>
			@endforeach
        </div>
    @endif
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
			{{Form::label('fecha_avaluo', 'Fecha del Avalúo')}}
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
	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('proposito', 'Propósito')}}
			{{Form::text('proposito', $row->proposito, ['class'=>'form-control', 'tabindex'=>'4', 'required' => 'required', 'maxlength' => '250'])}}
			{{$errors->first('proposito', '<span class=text-danger>:message</span>')}}
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('finalidad', 'Finalidad')}}
			{{Form::text('finalidad', $row->finalidad, ['class'=>'form-control', 'tabindex'=>'5', 'required' => 'required', 'maxlength' => '250'])}}
			{{$errors->first('finalidad', '<span class=text-danger>:message</span>')}}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{Form::label('idtipoinmueble', 'Tipo Inmueble')}}
			{{Form::select('idtipoinmueble', $cat_tipo_inmueble, $row->idtipoinmueble, ['id' => 'idtipoinmueble', 'class'=>'form-control', 'tabindex'=>'6'])}}
		</div>
	</div>
	<div class="col-md-8">
		<div class="form-group">
			{{Form::label('ubicacion', 'Ubicación')}}
			{{Form::text('ubicacion', $row->ubicacion, ['class'=>'form-control', 'tabindex'=>'7', 'maxlength' => '300'])}}
		</div>
	</div>
	
	<!-- RENGLON 5 -->
	<div class="col-md-4">
		<div class="form-group">
			{{Form::label('conjunto', 'Conjunto')}}
			{{Form::text('conjunto', $row->conjunto, ['class'=>'form-control', 'tabindex'=>'8', 'maxlength' => '150'])}}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{Form::label('colonia', 'Colonia')}}
			{{Form::text('colonia', $row->colonia, ['class'=>'form-control', 'tabindex'=>'9', 'maxlength' => '150'])}}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{Form::label('idestado', 'Estados')}}
			{{Form::select('idestado', $estados, $row->idestado, ['id' => 'idestado', 'class'=>'form-control', 'tabindex'=>'10'])}}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{Form::label('idmunicipio', 'Municipios')}}
			{{Form::select('idmunicipio', $municipios, $row->idmunicipio, ['id' => 'idmunicipio', 'class'=>'form-control', 'tabindex'=>'11'])}}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{Form::label('cp', 'C. P.')}}
			{{Form::select('cp', $lstCP, $row->cp, ['id' => 'cp', 'class'=>'form-control', 'tabindex'=>'12', 'required' => 'required'])}}
		</div>
	</div>

	<br />
	<div class="col-md-4">
		<div class="form-inline">
			{{Form::label('Longitud')}}
			{{Form::number('lon0', $row->lat0, ['class'=>'form-control', 'tabindex'=>'13', 'style'=>'width:75px', 'step'=>'1', 'min' => '0', 'max' => '360', 'required' => 'required'])}}&nbsp;&ring;&nbsp;
			{{Form::number('lon1', $row->lon1, ['class'=>'form-control', 'tabindex'=>'14', 'style'=>'width:75px', 'step'=>'1', 'min' => '0', 'max' => '60', 'required' => 'required'])}}&nbsp;'&nbsp;
			{{Form::number('lon2', $row->lon2, ['class'=>'form-control', 'tabindex'=>'15', 'style'=>'width:75px', 'step'=>'0.01', 'min' => '0.00', 'max' => '60.00', 'pattern' => '[0-9]{3}[.]{1}[0-9]{2}', 'required' => 'required'])}}"
			{{$errors->first('lon2', '<span class=text-danger>:message</span>')}}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-inline">
			{{Form::label('Latitud')}}
			{{Form::number('lat0', $row->lat0, ['class'=>'form-control', 'tabindex'=>'16', 'style'=>'width:75px', 'step'=>'1', 'min' => '0', 'max' => '360', 'required' => 'required'])}}&nbsp;&ring;&nbsp;
			{{Form::number('lat1', $row->lat1, ['class'=>'form-control', 'tabindex'=>'17', 'style'=>'width:75px', 'step'=>'1', 'min' => '0', 'max' => '60', 'required' => 'required'])}}&nbsp;'&nbsp;
			{{Form::number('lat2', $row->lat2, ['class'=>'form-control', 'tabindex'=>'18', 'style'=>'width:75px', 'step'=>'0.01', 'min' => '0.00', 'max' => '60', 'required' => 'required'])}}&nbsp;"
			{{$errors->first('lat2', '<span class=text-danger>:message</span>')}}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-inline">
			{{Form::label('Altitud')}}
			{{Form::text('altitud', $row->altitud, ['id'=>'altitud','class'=>'form-control clsNumeric', 'tabindex'=>'19', 'style'=>'width:300px', 'maxlength'=>'50', 'size'=>'30', 'pattern' => '[-+]?[0-9]*[.,]?[0-9]+' ] )}}
		</div>
	</div>
	<br />
	<div class="col-md-6">
		<div class="form-group">
			{{Form::label('idregimenpropiedad', 'Regimen')}}
			{{Form::select('idregimenpropiedad', $cat_regimen_propiedad, $row->idregimenpropiedad, ['id' => 'idregimenpropiedad', 'class'=>'form-control', 'tabindex'=>'20'])}}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{Form::label('cuenta_predial', 'Cuenta Predial')}}
			{{Form::text('cuenta_predial', $row->cuenta_predial, ['class'=>'form-control', 'tabindex'=>'21', 'maxlength'=>'15', 'size'=>'16'])}}
			{{$errors->first('cuenta_predial', '<span class=text-danger>:message</span>')}}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{Form::label('cuenta_catastral', 'Clave Catastral')}}
			{{Form::text('cuenta_catastral', $row->cuenta_catastral, ['class'=>'form-control', 'tabindex'=>'22', 'maxlength'=>'11', 'size'=>'12'])}}
			{{$errors->first('cuenta_catastral', '<span class=text-danger>:message</span>')}}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{Form::label('foliocoretemp', 'Folio COREVAT')}}
			{{Form::text('foliocoretemp', $row->foliocoretemp, ['class'=>'form-control', 'tabindex'=>'23', 'required' => 'required', 'maxlength'=>'20', 'size'=>'21'])}}
			{{$errors->first('foliocoretemp', '<span class=text-danger>:message</span>')}}
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('nombre_solicitante','Solicitante')}}
			{{Form::text('nombre_solicitante', $row->nombre_solicitante, ['class'=>'form-control', 'tabindex'=>'24', 'maxlength'=>'100'])}}
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{{Form::label('nombre_propietario','Propietario')}}
			{{Form::text('nombre_propietario', $row->nombre_propietario, ['class'=>'form-control', 'tabindex'=>'25', 'maxlength'=>'100'])}}
		</div>
	</div>
	<div class="col-md-12 form-actions form-group">
		{{Form::submit('Guardar', ['class'=>'btn btn-primary'])}}
		<a href="{{URL::route('indexAvaluos')}}" class="btn btn-primary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	</div>
</div>
{{Form::close()}}
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

	$('#btn1General').removeClass("btn-info").addClass("btn-primary");

    $('#cuenta_predial').mask('YYY-YYYY-YYYYYY', {
                                    placeholder: "___-____-______", 
                                    translation: {
                                        Y: {pattern: /[0-9]/}
                                    }
                                });

    $('#cuenta_catastral').mask('YY-S-YYYYYY', {
                                    placeholder: "__-_-______", 
                                    translation: {
                                        S: {pattern: /[RUru]/},
                                        Y: {pattern: /[0-9]/}
                                    }
                                });

    $('#idestado').on("change",function(){
        $.get("{{ url('getMunicipiosFromEstados')}}", { option: $(this).val() }, 
            function(json) {
                var model = $('#idmunicipio').empty();
                $.each(json, function(i, item) {
                    model.append("<option value='"+ item.idmunicipio +"'>" + item.municipio + "</option>");
                });
            }
        );
    });

    $('#idmunicipio').on("change",function(){
        $.get("{{ url('getCPFromMunicipios')}}", { option: $(this).val() }, 
            function(json) {
                var model = $('#cp').empty();
                $.each(json, function(i, item) {
                    model.append("<option value='"+ item.codigo_postal +"'>" + item.codigo_postal + "</option>");
                });
            }
        );
    });

});
</script>
@stop
