@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
<div class="row">
    <a href="{{URL::route('corevat.CatConstrucciones.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	<div class="col-md-4">
		{{ Form::model($row, ['route' => array('corevat.CatConstrucciones.update', $row->idconstruccion ), 'method'=>'put' ]) }}
		@include('CorevatCatalogos.CatConstrucciones._form', compact('CatConstrucciones'))
		<div class="form-actions form-group">
			{{ Form::submit('Modificar registro', array('class' => 'btn btn-primary')) }}
			<a href="{{URL::route('corevat.CatConstrucciones.index')}}" class="btn btn-warning" role="button">Cancelar</a>
		</div>
		{{Form::close()}}
    </div>

	<div class="col-sm-8 col-md-8 col-lg-8">
		@include('CorevatCatalogos.CatConstrucciones._list', compact('CatConstrucciones'))
	</div>
</div>
@stop
