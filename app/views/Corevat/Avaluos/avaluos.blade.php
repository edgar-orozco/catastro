@extends('layouts.default')
@section('content')
{{ HTML::style('/css/bootstrap.min.css') }}
{{ HTML::style('/css/dataTables/dataTables.css') }}
{{ HTML::style('/js/jquery/jquery-ui.css') }}
{{ HTML::style('/css/coverat.css') }}

<div class="modal fade" id="corevatConfirm" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">[COREVAT] Mensaje de confirmación</h4>
			</div>
			<div class="modal-body" style="min-height: 200px; text-align: center;">
				<h3 id="corevatConfirmContainer"></h3>
				<div class="alert" role="alert" id="corevatConfirmMessage"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="corevatConfirmButton" ctrl="" idTable="">Aceptar</button>
			</div>
		</div>
	</div>
</div>
	<h1>Avalúos</h1>
	<hr>
	<div id="menuAvaluosSections">
		<a class="btn btn-info btn0" id="btn1General" href="{{ action('editAvaluoGeneral',['id'=>$idavaluo])}}" role="button">General</a>
		<a class="btn btn-info btn0" id="btn2Zona" href="{{ action('editAvaluoZona',['id'=>$idavaluo])}}" role="button">Zona</a>
		<a class="btn btn-info btn0" id="btn3Inmueble" href="{{ action('editAvaluoInmueble',['id'=>$idavaluo])}}" role="button">Inmueble</a>
		<a class="btn btn-info btn0" id="btn3EnfoqueMercado" href="{{ action('editAvaluoEnfoqueMercado',['id'=>$idavaluo])}}" role="button">Enfoque Mercado</a>
		<a class="btn btn-info btn0" id="btn3EnfoqueFisico" href="{{ action('editAvaluoEnfoqueFisico',['id'=>$idavaluo])}}" role="button">Enfoque Físico</a>
		<a class="btn btn-info btn0" id="btn3Conclusion" href="{{ action('editAvaluoConclusiones',['id'=>$idavaluo])}}" role="button">Conclusiones</a>
		<a class="btn btn-info btn0" id="btn3FotoPlano" href="{{ action('editAvaluoFotos',['id'=>$idavaluo])}}" role="button">Fotos y Planos</a>
		<a class="btn btn-info btn0" id="btn3PrintAvaluo" href="/corevat/AvaluoPrint/{{$row->idavaluo}}" target="_blank" role="button">Imprimir</a>
	</div>
	<div id="conatinerAvaluo" style="margin: 0 !important; padding: 0px !important;">
		@if ( $opt === 'general' )
		@include('Corevat.Avaluos._general')
		@elseif ( $opt === 'zona' )
		@include('Corevat.Avaluos._zona')
		@elseif ( $opt === 'inmueble' )
		@include('Corevat.Avaluos._inmueble')
		@elseif ( $opt === 'mercado' )
		@include('Corevat.Avaluos._mercado')
		@elseif ( $opt === 'fisico' )
		@include('Corevat.Avaluos._fisico')
		@elseif ( $opt === 'conclusiones' )
		@include('Corevat.Avaluos._conclusiones')
		@elseif ( $opt === 'fotos' )
		@include('Corevat.Avaluos._fotos')
		@endif
	</div>

@stop
