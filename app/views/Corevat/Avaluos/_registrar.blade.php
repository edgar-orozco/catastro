<h3 class="header">{{$title}}</h3>
<hr>
{{ Form::model(null, ['route' => array('registrarAvaluoExe', $idavaluo), 'method'=>'get', 'id'=>'formAvaluoRegistrar' ]) }}
<div class="row" id="rowA">
	@if( count($errors) > 0)
	<div class="col-md-12 alert-danger">
		<p style="font-size: 22px; font-weight: bold;">El avalúo no puede ser registrado debido a:</p>
		@foreach($errors as $error )
		<p style="font-size: 18px; font-weight: bold;"><span class="glyphicon glyphicon-remove"></span>  {{ $error }}</hp>
		@endforeach
	</div>
	@else
	<div class="col-md-10 col-md-offset-2">
		<p style="font-size:18px; text-align:left; font-weight: bold;">El presente avalúo pasa a formar parte del Padrón Catastral. Por lo tanto me sujeto a las condiciones de confidencialidad de la información catastral.</p>
	</div>
	@endif

	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-6 form-actions">
		<a href="{{URL::route('indexAvaluos')}}" class="btn btn-coveratSecondary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	</div>
	@if( count($errors) <= 0)
	<div class="col-md-6 form-actions">
		{{Form::submit('Aceptar', ['class'=>'btn btn-coveratPrincipal', 'id'=>'aceptar'])}}
	</div>
	@endif
</div>
{{Form::close()}}
<div class="row" id="rowB" style="display: none;">
	<div class="alert alert-success" role="alert">
		<p style="font-size:22px; text-align:left; font-weight: bold;">¡El avalúo quedo registrado satisfactoriamente! <a class="btn btn-default" href="/corevat/AvaluoRegistrarPrint/{{$idavaluo}}" role="button" target="_blank" id="prn">Acuse</a></p>
	</div>
	<div class="col-md-6 form-actions">
		<a href="{{URL::route('indexAvaluos')}}" class="btn btn-coveratSecondary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	</div>
</div>
@section('javascript')
{{ HTML::script('/js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
{{ HTML::script('/js/jquery.corevat.js') }}
<script>

	$(document).ready(function () {
		$("#formAvaluoRegistrar").submit(function(){
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
						$("#rowA, #aceptar").hide();
						$("#rowB").show();
						$("#prn").on();
					}
				}
			});
			return false;
		});

	});

</script>
@stop
