<h3 class="header">{{$title}}</h3>
<hr>
{{Form::model($row, ['route' => array('updateAvaluoZona', $idavaluo), 'method'=>'post', 'id'=>'formAvaluoZona' ]) }}
{{Form::hidden('idavaluozona', $row->idavaluozona)}}
<div class="row">
	<div class="col-md-5 bg-primary"><h4>Servicios Municipales</h4></div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5 bg-primary"><h4>Equipamiento Urbano</h4></div>

	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-5">
		{{Form::label('is_agua_potable', 'Agua Potable')}}
		{{ Form::checkbox('is_agua_potable', 1,  $row->is_agua_potable) }}	
		<hr>
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		{{Form::label('is_escuela', 'Escuela')}}
		{{ Form::checkbox('is_escuela', 1,  $row->is_escuela) }}	
		<hr>
	</div>

	<div class="col-md-5">
		{{Form::label('is_guarniciones', 'Guarniciones')}}
		{{ Form::checkbox('is_guarniciones', 1,  $row->is_guarniciones) }}	
		<hr>
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-5">
		{{Form::label('is_iglesia', 'Iglesia')}}
		{{ Form::checkbox('is_iglesia', 1,  $row->is_iglesia) }}	
		<hr>
	</div>

	<div class="col-md-5">
		{{Form::label('is_drenaje', 'Drenaje')}}
		{{ Form::checkbox('is_drenaje', 1,  $row->is_drenaje) }}	
		<hr>
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-5">
		{{Form::label('is_banco', 'Banco')}}
		{{ Form::checkbox('is_banco', 1,  $row->is_banco) }}	
		<hr>
	</div>

	<div class="col-md-5">
		{{Form::label('is_banqueta', 'Banqueta')}}
		{{ Form::checkbox('is_banqueta', 1,  $row->is_banqueta) }}	
		<hr>
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-5">
		{{Form::label('is_comercio', 'Comercio')}}
		{{ Form::checkbox('is_comercio', 1,  $row->is_comercio) }}	
		<hr>
	</div>

	<div class="col-md-5">
		{{Form::label('is_electricidad', 'Electricidad')}}
		{{ Form::checkbox('is_electricidad', 1,  $row->is_electricidad) }}	
		<hr>
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-5">
		{{Form::label('is_hospital', 'Hospital')}}
		{{ Form::checkbox('is_hospital', 1,  $row->is_hospital) }}	
		<hr>
	</div>

	<div class="col-md-5">
		{{Form::label('is_telefono', 'Teléfono')}}
		{{ Form::checkbox('is_telefono', 1,  $row->is_telefono) }}	
		<hr>
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-5">
		{{Form::label('is_parque', 'Parque')}}
		{{ Form::checkbox('is_parque', 1,  $row->is_parque) }}	
		<hr>
	</div>

	<div class="col-md-5">
		{{Form::label('is_pavimentacion', 'Pavimentación')}}
		{{ Form::checkbox('is_pavimentacion', 1,  $row->is_pavimentacion) }}	
		<hr>
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-5">
		{{Form::label('is_transporte', 'Transporte')}}
		{{ Form::checkbox('is_transporte', 1,  $row->is_transporte) }}	
		<hr>
	</div>

	<div class="col-md-5">
		{{Form::label('is_transporte_publico', 'Transporte Público')}}
		{{ Form::checkbox('is_transporte_publico', 1,  $row->is_transporte_publico) }}	
		<hr>
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-5">
		{{Form::label('is_gasolinera', 'Gasolinera')}}
		{{ Form::checkbox('is_gasolinera', 1,  $row->is_gasolinera) }}	
		<hr>
	</div>

	<div class="col-md-5">
		{{Form::label('is_alumbrado_publico', 'Alumbrado Público')}}
		{{ Form::checkbox('is_alumbrado_publico', 1,  $row->is_alumbrado_publico) }}	
		<hr>
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-5">
		{{Form::label('is_mercado', 'Mercado')}}
		{{ Form::checkbox('is_mercado', 1,  $row->is_mercado) }}	
		<hr>
	</div>

	<div class="col-md-5">
		{{Form::label('is_otro_servicio', 'Otros')}}
		{{ Form::checkbox('is_otro_servicio', $row->is_otro_servicio, ['class'=>'form-control', 'id'=>'is_otro_servicio'] )}}	
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		{{Form::label('is_otro_equipamiento', 'Otros')}}
		{{ Form::checkbox('is_otro_equipamiento', $row->is_otro_equipamiento) }}	
	</div>

	<div class="col-md-5">
		{{Form::text('otro_servicio_municipal', $row->otro_servicio_municipal, ['class'=>'form-control', 'id'=>'otro_servicio_municipal', 'maxlength'=>'300'] )}}
		{{$errors->first('otro_servicio_municipal', '<span class=text-danger>:message</span>')}}
		<hr>
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		{{Form::text('otro_equipamiento', $row->otro_equipamiento, ['class'=>'form-control', 'id'=>'otro_equipamiento', 'maxlength'=>'300'] )}}
		{{$errors->first('otro_equipamiento', '<span class=text-danger>:message</span>')}}
		<hr>
	</div>

	<div class="col-md-12 bg-primary">
		<h4>Otros datos</h4>
	</div>
	<div class="col-md-12">
		{{Form::label('cobertura', 'Cobertura')}}
		{{Form::text('cobertura', $row->cobertura, ['class'=>'form-control', 'maxlength'=>'250'] )}}
		{{$errors->first('cobertura', '<span class=text-danger>:message</span>')}}
		<hr>
	</div>

	<div class="col-md-4">
		{{Form::label('nivel_equipamiento', 'Nivel de Equipamiento %')}}
		{{Form::number('nivel_equipamiento', $row->nivel_equipamiento, ['class'=>'form-control', 'maxlength'=>'250'] )}}
		{{$errors->first('nivel_equipamiento', '<span class=text-danger>:message</span>')}}
		<hr>
	</div>

	<div class="col-md-4">
		{{Form::label('idclasificacionzona', 'Clasificación de la Zona')}}
		{{Form::select('idclasificacionzona', $cat_clasificacion_zona, $row->idclasificacionzona, ['id' => 'idclasificacionzona', 'class'=>'form-control'])}}
		<hr>
	</div>
	<div class="col-md-4">
		{{Form::label('idproximidadurbana', 'Proximidad Urbana')}}
		{{Form::select('idproximidadurbana', $cat_proximidad_urbana, $row->idproximidadurbana, ['id' => 'idproximidadurbana', 'class'=>'form-control'])}}
		<hr>
	</div>

	<div class="col-md-12">
		{{Form::label('construc_predominante', 'Construcciones Predominante')}}
		{{Form::textarea('construc_predominante', $row->construc_predominante, ['class'=>'form-control'] )}}
		{{$errors->first('construc_predominante', '<span class=text-danger>:message</span>')}}
		<hr>
	</div>

	<div class="col-md-12">
		{{Form::label('vias_acceso_importante', 'Vias de acceso e importancia')}}
		{{Form::textarea('vias_acceso_importante', $row->vias_acceso_importante, ['class'=>'form-control'] )}}
		{{$errors->first('vias_acceso_importante', '<span class=text-danger>:message</span>')}}
		<hr>
	</div>

	<div class="col-md-12 form-actions">
		{{Form::submit('Guardar', ['class'=>'btn btn-primary'])}}
		<a href="{{URL::route('indexAvaluos')}}" class="btn btn-primary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	</div>
</div>

{{Form::close()}}
@section('javascript')
{{ HTML::script('/js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
{{ HTML::script('/js/jquery.corevat.js') }}
<script>
	$(document).ready(function () {
		$('#btn2Zona').removeClass("btn-info").addClass("btn-primary");
		
		if ($('#is_otro_servicio').val() === '1') {
			$('#otro_servicio_municipal').prop('disabled', false);
		} else {
			$('#otro_servicio_municipal').prop('disabled', true);
		}
		
		$('#is_otro_servicio').click(function () {
			if (this.checked) {
				$(this).val('1');
				$('#otro_servicio_municipal').prop('disabled', false);
			} else {
				$(this).val('0');
				$('#otro_servicio_municipal').prop('disabled', true);
			}
		});
		
		if ($('#is_otro_equipamiento').val() === '1') {
			$('#otro_equipamiento').prop('disabled', false);
		} else {
			$('#otro_equipamiento').prop('disabled', true);
		}
		
		$('#is_otro_equipamiento').click(function () {
			if (this.checked) {
				$(this).val('1');
				$('#otro_equipamiento').prop('disabled', false);
			} else {
				$(this).val('0');
				$('#otro_equipamiento').prop('disabled', true);
			}
		});
		
	});
</script>
@stop
