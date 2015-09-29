<h3 class="header">{{$title}}</h3>
{{Form::model($row, ['route' => array('updateAvaluoZona', $idavaluo), 'method'=>'post', 'id'=>'formAvaluoZona' ]) }}
{{Form::hidden('idavaluozona', $row->idavaluozona)}}
{{Form::hidden('hidden_nivel_equipamiento', $row->nivel_equipamiento, ['id' => 'hidden_nivel_equipamiento'])}}
<div id="zonaCoveratSecc">
    <div class="row">
        <div class="col-md-6">
            <h4>Servicios Municipales</h4>
            <div class="checkboxContainer">
                <div class="checkbox">
                    {{Form::label('is_agua_potable', 'Agua Potable')}}
                    {{Form::checkbox('is_agua_potable', 1,  $row->is_agua_potable, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_guarniciones', 'Guarniciones')}}
                    {{Form::checkbox('is_guarniciones', 1,  $row->is_guarniciones, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_drenaje', 'Drenaje')}}
                    {{Form::checkbox('is_drenaje', 1,  $row->is_drenaje, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_banqueta', 'Banqueta')}}
                    {{Form::checkbox('is_banqueta', 1,  $row->is_banqueta, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_electricidad', 'Electricidad')}}
                    {{Form::checkbox('is_electricidad', 1,  $row->is_electricidad, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_telefono', 'Teléfono')}}
                    {{Form::checkbox('is_telefono', 1,  $row->is_telefono, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_pavimentacion', 'Pavimentación')}}
                    {{Form::checkbox('is_pavimentacion', 1,  $row->is_pavimentacion, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_transporte_publico', 'Transporte Público')}}
                    {{Form::checkbox('is_transporte_publico', 1,  $row->is_transporte_publico, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_alumbrado_publico', 'Alumbrado Público')}}
                    {{Form::checkbox('is_alumbrado_publico', 1,  $row->is_alumbrado_publico, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_otro_servicio', 'Otros')}}
                    {{Form::checkbox('is_otro_servicio', 1, $row->is_otro_servicio, ['class'=>'nivel_equipamiento', 'id'=>'is_otro_servicio'])}}
                </div>
                <div class="checkbox"></div>
                <div class="checkbox">
                    {{Form::text('otro_servicio_municipal', $row->otro_servicio_municipal, ['class'=>'form-control', 'id'=>'otro_servicio_municipal', 'maxlength'=>'300'])}}
                    {{$errors->first('otro_servicio_municipal', '<span class=text-danger>:message</span>')}}
                </div>

                <div class="checkbox">
                    {{Form::label('is_recoleccion_basura', 'Recolección de Basura')}}
                    {{Form::checkbox('is_recoleccion_basura', 1,  $row->is_recoleccion_basura, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_vigilancia_privada', 'Vigilancia Privada')}}
                    {{Form::checkbox('is_vigilancia_privada', 1,  $row->is_vigilancia_privada, ['class' => 'nivel_equipamiento'])}}
                </div>

                <div class="checkbox">
                    {{Form::label('is_internet', 'Internet')}}
                    {{Form::checkbox('is_internet', 1,  $row->is_internet, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox"></div>
            </div>
        </div>

        <div class="col-md-6">
            <h4>Equipamiento Urbano</h4>
            <div class="checkboxContainer">
                <div class="checkbox">
                    {{Form::label('is_escuela', 'Escuela')}}
                    {{Form::checkbox('is_escuela', 1,  $row->is_escuela, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_iglesia', 'Iglesia')}}
                    {{Form::checkbox('is_iglesia', 1,  $row->is_iglesia, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_banco', 'Banco')}}
                    {{Form::checkbox('is_banco', 1,  $row->is_banco, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_comercio', 'Comercio')}}
                    {{Form::checkbox('is_comercio', 1,  $row->is_comercio, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_hospital', 'Hospital')}}
                    {{Form::checkbox('is_hospital', 1,  $row->is_hospital, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_parque', 'Parque')}}
                    {{Form::checkbox('is_parque', 1,  $row->is_parque, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_transporte', 'Transporte')}}
                    {{Form::checkbox('is_transporte', 1,  $row->is_transporte, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_gasolinera', 'Gasolinera')}}
                    {{Form::checkbox('is_gasolinera', 1,  $row->is_gasolinera, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_mercado', 'Mercado')}}
                    {{Form::checkbox('is_mercado', 1,  $row->is_mercado, ['class' => 'nivel_equipamiento'])}}
                </div>
                <div class="checkbox">
                    {{Form::label('is_otro_equipamiento', 'Otros')}}
                    {{Form::checkbox('is_otro_equipamiento', 1, $row->is_otro_equipamiento, ['class' => 'nivel_equipamiento', 'id' => 'is_otro_equipamiento'])}}
                </div>
                <div class="checkbox"></div>
                <div class="checkbox">
                    {{Form::text('otro_equipamiento', $row->otro_equipamiento, ['class'=>'form-control', 'id'=>'otro_equipamiento', 'maxlength'=>'300'])}}
                    {{$errors->first('otro_equipamiento', '<span class=text-danger>:message</span>')}}
                </div>
            </div>
        </div>
    </div>

	<div class="col-md-12"><hr></div>
	<div class="col-md-6">
		<label for="cobertura" class="col-sm-3">En un radio de: </label>
		<div class="col-sm-6">
			{{Form::text('cobertura', '1000.00', ['class'=>'form-control', 'maxlength'=>'250', 'disabled' => 'disabled'])}}
			{{$errors->first('cobertura', '<span class=text-danger>:message</span>')}}
		</div>
		<label class="col-sm-3">metros</label>
		<hr>
	</div>
	<div class="col-md-6">
		<label for="nivel_equipamiento" class="col-sm-5">Nivel de Equipamiento %: </label>
		<div class="col-sm-7">
			{{Form::number('nivel_equipamiento', $row->nivel_equipamiento, ['id' => 'nivel_equipamiento', 'class'=>'form-control', 'maxlength'=>'3', 'size'=>'4', 'step'=>'1', 'min'=>'0', 'max'=>'100', 'disabled' => 'disabled'])}}
			{{$errors->first('nivel_equipamiento', '<span class=text-danger>:message</span>')}}
		</div>
		<hr>
	</div>

	<div class="col-md-12"><h4>Otros datos</h4></div>
	<div class="col-md-6">
		{{Form::label('idclasificacionzona', 'Clasificación de la Zona')}}
		{{Form::select('idclasificacionzona', $cat_clasificacion_zona, $row->idclasificacionzona, ['id' => 'idclasificacionzona', 'class'=>'form-control'])}}
		<hr>
	</div>
	<div class="col-md-6">
		{{Form::label('idproximidadurbana', 'Proximidad Urbana')}}
		{{Form::select('idproximidadurbana', $cat_proximidad_urbana, $row->idproximidadurbana, ['id' => 'idproximidadurbana', 'class'=>'form-control'])}}
		<hr>
	</div>

	<div class="col-md-12"><hr></div>
	<div class="col-md-6">
		{{Form::label('construc_predominante', 'Construcciones Predominante')}}
		{{Form::textarea('construc_predominante', $row->construc_predominante, ['class'=>'form-control', 'maxlength'=>'500', 'rows' => '3'] )}}
		<hr>
	</div>
	<div class="col-md-6">
		{{Form::label('vias_acceso_importante', 'Vias de acceso e importancia')}}
		{{Form::textarea('vias_acceso_importante', $row->vias_acceso_importante, ['class'=>'form-control', 'maxlength'=>'500', 'rows' => '3'] )}}
		<hr>
	</div>

	<div class="col-md-12"><hr></div>
	<div class="col-md-12">
		{{Form::label('calles_transversales', 'TRAMO DE CALLE, CALLES TRANSVERSALES LIMÍTROFES Y ORIENTACIÓN')}}
		{{Form::textarea('calles_transversales', $row->calles_transversales, ['class'=>'form-control', 'maxlength'=>'500', 'rows' => '3'] )}}
		<hr>
	</div>
	
	<div class="col-md-12"><hr></div>
    <div class="col-md-6 form-actions">
        <a href="{{URL::route('indexAvaluos')}}" class="btn btn-primary btn-coveratSecondary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
    </div>
    <div class="col-md-6 form-actions">
		{{Form::submit('Guardar', ['class'=>'btn btn-primary btn-coveratPrincipal'])}}
    </div>
</div>

{{Form::close()}}
@section('javascript')
{{ HTML::script('/js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
{{ HTML::script('/js/jquery/jquery.mask.min.js') }}
{{ HTML::script('/js/jquery.corevat.js') }}
<script>
	$(document).ready(function () {
		$('#btn2Zona').removeClass("btn-info").addClass("btn-primary");

		$("#otro_servicio_municipal").attr('disabled', ( $("#is_otro_servicio").is(':checked' ) ? false : true) )
		$("#otro_equipamiento").attr('disabled', ( $("#is_otro_equipamiento").is(':checked' ) ? false : true) )
		
		$(".nivel_equipamiento").click(function() {
			var x = 0;
			var y = 18;

			if ( $(this).attr('id') === 'is_otro_servicio' ) {
				if ( $(this).is(':checked' ) ) {
					$("#otro_servicio_municipal").attr('disabled', false).attr('required', true);
					y = ( $("#is_otro_equipamiento").is(':checked') ? 20 : 19);
				} else {
					$("#otro_servicio_municipal").attr('disabled', true).attr('required', false).val('');
				}
			}
			
			if ( $(this).attr('id') === 'is_otro_equipamiento' ) {
				if ( $(this).is(':checked' ) ) {
					$("#otro_equipamiento").attr('disabled', false).attr('required', true);
					y = ( $("#is_otro_servicio").is(':checked') ? 20 : 19);
				} else {
					$("#otro_equipamiento").attr('disabled', true).attr('required', false).val('');
				}
			}

			$('.nivel_equipamiento').each(function(key, element){
				if ( element.checked ) {
					x++;
				}
			});

			$("#nivel_equipamiento, #hidden_nivel_equipamiento").val( ((x / y) * 100).toFixed(2) );
		});

	});
</script>
@stop
