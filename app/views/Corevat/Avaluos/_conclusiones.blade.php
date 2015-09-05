<h3 class="header">{{$title}}</h3>
<hr>
{{ Form::model($row, ['route' => array('updateAvaluoConclusiones', $row->idavaluo), 'method'=>'post', 'id'=>'formAvaluoConclusiones' ]) }}
<div class="row">
	<div class="col-md-3">
		{{Form::label('valor_fisico', 'Valor Físico:')}}
		{{Form::text('valor_fisico', number_format($row->valor_fisico, 2, '.', ','), ['class'=>'form-control', 'disabled'=>'disabled'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('valor_mercado', 'Valor de Mercado:')}}
		{{Form::text('valor_mercado', number_format($row->valor_mercado, 2, '.', ','), ['class'=>'form-control', 'disabled'=>'disabled'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('factor_seleccion_valor', 'Seleccione una valor de conclusión:')}}
		{{Form::select('factor_seleccion_valor', array('1'=>'Valor Físico', '2'=>'Valor Mercado'), $row->factor_seleccion_valor, ['id' => 'factor_seleccion_valor', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('valor_concluido', 'Valor Concluido:')}}
		{{Form::text('valor_concluido', number_format($row->valor_concluido, 2, '.', ','), ['class'=>'form-control', 'disabled'=>'disabled'])}}
	</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12"><hr></div>

	<div class="col-md-12">
		{{Form::label('leyenda', 'Declaraciones:')}}
		{{Form::textarea('leyenda', nl2br(e($row->leyenda)), ['value' => '$row->leyenda', 'class'=>'form-control'] )}}
	</div>
	<div class="col-md-12">&nbsp;</div>
    <div class="col-md-6 form-actions">
        <a href="{{URL::route('indexAvaluos')}}" class="btn btn-coveratSecondary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
    </div>
    <div class="col-md-6 form-actions">
		{{Form::submit('Guardar', ['class'=>'btn btn-coveratPrincipal'])}}
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

		$('#btn3Conclusion').removeClass("btn-info").addClass("btn-primary");
		
		"use strict"

		var leyenda = "DECLARACIONES, ADVERTENCIAS Y CONSIDERACIONES PREVIAS.- El presente avalúo se fundamenta en la Ley de Valuación para el Estado de Tabasco, Artículos 110, 111, de la Ley de Hacienda Municipal. Éste avalúo no tendrá validez para ningún propósito distinto al especificado en el mismo, así como si carece de los sellos y firmas del valuador autorizado El presente avalúo tendrá una validez de seis meses a partir de la fecha de firma del mismo, siempre que no cambien las características físicas del inmueble o las condiciones generales del mercado inmobiliario. No se verificó la propiedad legal ni la existencia de gravamen o créditos fiscales que pudiera tener el inmueble. 1. Son análisis, opiniones y conclusiones de tipo profesional y están solamente limitadas por los supuestos y condiciones limitantes. 2. Los análisis, opiniones y conclusiones reportados corresponden a un estudio profesional totalmente imparcial. 3. No existe por nuestra parte ningún interés presente o futuro inmediato en la propiedad valuada. 4. Los honorarios no están relacionados con el hecho de concluir un valor predeterminado o en la dirección  que favorezca la causa del cliente, el monto del valor estimado, la obtención de un resultado estipulado o la ocurrencia de un evento subsecuente. 5. Personalmente hice la  inspección de los bienes objeto de este avaluó y manifiesto que los resultados serán guardados con absoluta confidencialidad. 6.Se concluye que el valor comercial del inmueble  está definido por el resultado obtenido por el Método de ??????.";

		if ( $("#leyenda").val()=="" ){
			$("#leyenda").val(leyenda);
		}

		$("#factor_seleccion_valor").on("change",function(event){
			event.preventDefault();
			if ( $(this).val() == '1' ){
				$("#valor_concluido").val( $("#valor_fisico").val() );
			}else{
				$("#valor_concluido").val( $("#valor_mercado").val() );
			}
		});

	});

</script>
@stop
