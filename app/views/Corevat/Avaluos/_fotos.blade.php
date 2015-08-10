<h3 class="header">{{$title}}</h3>
<hr>
{{ Form::model($row, ['route' => array('updateAvaluoFotos', $row->idavaluo), 'method'=>'post', 'id'=>'formAvaluoFotos', 'enctype'=>'multipart/form-data' ]) }}
{{Form::hidden('idavaluofotosplano', $row->idavaluofotosplano)}}
<div class="row">
	<div class="col-md-12">
        <h4>Fotos</h4>
    </div>
	<div class="col-md-5">
		<hr>
		<div class="input-group">
			<span class="input-group-addon">{{Form::label('foto0', 'Fotos')}}</span>
		{{Form::file('foto0', ['id'=>'foto0', 'class'=>'filesCorevat']) }}	
		@if ( $foto0 != '' )
			<span class="input-group-btn"><a class="btn btn-success" type="button" target='_blank' href="{{$foto0}}">Ver Foto 1</a></span>
		@endif
		</div>
		<hr>
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		<hr>
		<div class="input-group">
			<span class="input-group-addon">{{Form::label('foto1', 'Fotos')}}</span>
		{{Form::file('foto1', ['id'=>'foto1', 'class'=>'filesCorevat']) }}	
		@if ( $foto1 != '' )
			<span class="input-group-btn"><a class="btn btn-success" type="button" target='_blank' href="{{$foto1}}">Ver Foto 2</a></span>
		@endif
		</div>
		<hr>
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
		<hr>
		<div class="input-group">
			<span class="input-group-addon">{{Form::label('foto2', 'Fotos')}}</span>
		{{Form::file('foto2', ['id'=>'foto2', 'class'=>'filesCorevat']) }}	
		@if ( $foto2 != '' )
			<span class="input-group-btn"><a class="btn btn-success" type="button" target='_blank' href="{{$foto2}}">Ver Foto 3</a></span>
		@endif
		</div>
		<hr>
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		<hr>
		<div class="input-group">
			<span class="input-group-addon">{{Form::label('foto3', 'Fotos')}}</span>
		{{Form::file('foto3', ['id'=>'foto3', 'class'=>'filesCorevat']) }}	
		@if ( $foto3 != '' )
			<span class="input-group-btn"><a class="btn btn-success" type="button" target='_blank' href="{{$foto3}}">Ver Foto 4</a></span>
		@endif
		</div>
		<hr>
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
		<hr>
		<div class="input-group">
			<span class="input-group-addon">{{Form::label('foto4', 'Fotos')}}</span>
		{{Form::file('foto4', ['id'=>'foto4', 'class'=>'filesCorevat']) }}	
		@if ( $foto4 != '' )
			<span class="input-group-btn"><a class="btn btn-success" type="button" target='_blank' href="{{$foto4}}">Ver Foto 5</a></span>
		@endif
		</div>
		<hr>
	</div>
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-5">
		<hr>
		<div class="input-group">
			<span class="input-group-addon">{{Form::label('foto5', 'Fotos')}}</span>
		{{Form::file('foto5', ['id'=>'foto5', 'class'=>'filesCorevat']) }}	
		@if ( $foto5 != '' )
			<span class="input-group-btn"><a class="btn btn-success" type="button" target='_blank' href="{{$foto5}}">Ver Foto 6</a></span>
		@endif
		</div>
		<hr>
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
	<div class="col-md-12"><h4>Plano</h4></div>
	<div class="col-md-5">
		<hr>
		<div class="input-group">
			<span class="input-group-addon">{{Form::label('plano0', 'Fotos')}}</span>
		{{Form::file('plano0', ['id'=>'plano0', 'class'=>'filesCorevat']) }}	
		@if ( $plano0 != '' )
			<span class="input-group-btn"><a class="btn btn-success" type="button" target='_blank' href="{{$plano0}}">Ver Plano</a></span>
		@endif
		</div>
		<hr>
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
			allowedFileExtensions: ["gif","jpg","JPG","png"]
		});
	});
</script>
@stop
