@extends('layouts.default')
@section('title')
{{{ $title }}} :: @parent
@stop
@section('content')
<div class="row">
    <a href="{{URL::route('corevat.CatEstadoConservacion.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i>Regresar</a>
	<div class="col-md-4">
		{{ Form::model($row, ['route' => array('corevat.CatEstadoConservacion.update', $row->idestadoconservacion ), 'method'=>'put' ]) }}
		@include('CorevatCatalogos.CatEstadoConservacion._form', compact('CatEstadoConservacion'))
		<div class="form-actions form-group">
			{{ Form::submit('Modificar registro', array('class' => 'btn btn-primary')) }}
			<a href="{{URL::route('corevat.CatEstadoConservacion.index')}}" class="btn btn-warning" role="button">Cancelar</a>
		</div>
		{{Form::close()}}
    </div>

	<div class="col-sm-8 col-md-8 col-lg-8">
		@include('CorevatCatalogos.CatEstadoConservacion._list', compact('CatEstadoConservacion'))
	</div>
</div>
@stop
