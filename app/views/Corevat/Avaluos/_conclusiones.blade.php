<h3 class="header">{{$title}}</h3>
<hr>
{{ Form::model($row, ['route' => array('updateAvaluoConclusiones', $row->idavaluo), 'method'=>'put', 'id'=>'formAvaluoConclusiones' ]) }}
<div class="row">
	<div class="col-md-3">
		{{Form::label('valor_fisico', 'Valor Físico:')}}
		{{Form::text('valor_fisico', $row->valor_fisico, ['class'=>'form-control', 'readonly'=>'readonly'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('valor_mercado', 'Valor Mercado:')}}
		{{Form::text('valor_mercado', $row->valor_fisico, ['class'=>'form-control', 'readonly'=>'readonly'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('factor_seleccion_valor', 'Seleccione una valor de conclusión:')}}
		{{Form::select('factor_seleccion_valor', array('1'=>'Valor Físico', '2'=>'Valor Mercado'), $row->factor_seleccion_valor, ['id' => 'factor_seleccion_valor', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('valor_concluido', 'Valor Mercado:')}}
		{{Form::text('valor_concluido', $row->valor_concluido, ['class'=>'form-control', 'readonly'=>'readonly'])}}
	</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12"><hr></div>

	<div class="col-md-12">
		{{Form::label('leyenda', 'Declaraciones:')}}
		{{Form::textarea('leyenda', $row->leyenda, ['class'=>'form-control'] )}}
	</div>
	<div class="col-md-12">&nbsp;</div>
	
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
	});
</script>
@stop
