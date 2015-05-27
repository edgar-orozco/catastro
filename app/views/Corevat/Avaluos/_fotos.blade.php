<h3 class="header">{{$title}}</h3>
<hr>
{{ Form::model($row, ['route' => array('updateAvaluoFotos', $row->idavaluo), 'method'=>'post', 'id'=>'formAvaluoFotos', 'enctype'=>'multipart/form-data' ]) }}
{{Form::hidden('idavaluofotosplano', $row->idavaluofotosplano)}}
<div class="row">
	<div class="col-md-12"><h3>Fotos</h3></div>
	<div class="col-md-5">
		{{Form::file('foto0', ['id'=>'foto0', 'class'=>'filesCorevat']) }}
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		{{Form::file('foto1', ['id'=>'foto1', 'class'=>'filesCorevat']) }}
	</div>
</div>
<div class="row" style="margin-top: 10px;">
	<div class="col-md-5">
		{{Form::label('ftitulo0', 'Comentario:')}}
		{{Form::text('ftitulo0', $row->ftitulo0, ['class'=>'form-control', 'maxlength'=>'200'] )}}
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		{{Form::label('ftitulo1', 'Comentario:')}}
		{{Form::text('ftitulo1', $row->ftitulo1, ['class'=>'form-control', 'maxlength'=>'200'] )}}
	</div>
</div>
<hr>

<div class="row">
	<div class="col-md-5">
		{{Form::file('foto2', ['id'=>'foto2', 'class'=>'filesCorevat']) }}
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		{{Form::file('foto3', ['id'=>'foto3', 'class'=>'filesCorevat']) }}
	</div>
</div>
<div class="row" style="margin-top: 10px;">
	<div class="col-md-5">
		{{Form::label('ftitulo2', 'Comentario:')}}
		{{Form::text('ftitulo2', $row->ftitulo2, ['class'=>'form-control', 'maxlength'=>'200'] )}}
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		{{Form::label('ftitulo3', 'Comentario:')}}
		{{Form::text('ftitulo3', $row->ftitulo3, ['class'=>'form-control', 'maxlength'=>'200'] )}}
	</div>
</div>
<hr>

<div class="row">
	<div class="col-md-5">
		{{Form::file('foto4', ['id'=>'foto4', 'class'=>'filesCorevat']) }}
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		{{Form::file('foto5', ['id'=>'foto5', 'class'=>'filesCorevat']) }}
	</div>
</div>
<div class="row" style="margin-top: 10px;">
	<div class="col-md-5">
		{{Form::label('ftitulo4', 'Comentario:')}}
		{{Form::text('ftitulo4', $row->ftitulo4, ['class'=>'form-control', 'maxlength'=>'200'] )}}
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		{{Form::label('ftitulo5', 'Comentario:')}}
		{{Form::text('ftitulo5', $row->ftitulo5, ['class'=>'form-control', 'maxlength'=>'200'] )}}
	</div>
</div>
<hr>

<div class="row">
	<div class="col-md-12"><h3>Plano</h3></div>
	<div class="col-md-5">
		{{Form::file('plano0', ['id'=>'plano0', 'class'=>'filesCorevat']) }}
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">&nbsp;</div>
</div>
<div class="row" style="margin-top: 10px;">
	<div class="col-md-5">
		{{Form::label('ptitulo0', 'Comentario:')}}
		{{Form::text('ptitulo0', $row->ptitulo0, ['class'=>'form-control', 'maxlength'=>'200'] )}}
	</div>
</div>
<div class="row">
	<hr>
	<div class="col-md-12 form-actions">
		{{Form::submit('Guardar', ['class'=>'btn btn-primary'])}}
		<a href="{{URL::route('indexAvaluos')}}" class="btn btn-primary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	</div>
</div>

{{Form::close()}}
{{ HTML::style('/css/fileinput.min.css') }}
@section('javascript')
{{ HTML::script('/js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
{{ HTML::script('/js/jquery.corevat.js') }}
{{ HTML::script('/js/fileinput.min.js') }}
{{ HTML::script('/js/fileinput_locale_es.js') }}
<script>
	$(document).ready(function () {
		$('#btn3FotoPlano').removeClass("btn-info").addClass("btn-primary");

		/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 * 
		 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
		$('.filesCorevat').fileinput({
			maxFileSize: 2000,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg"]
		});
	});
</script>
@stop
