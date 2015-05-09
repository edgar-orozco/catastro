@extends('layouts.default')
@section('title')
{{{ $title}}} :: @parent
@stop
@section('content')
<div class="row">
    <a href="{{URL::route('corevat.CatMuros.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	<div class="col-md-4">
		{{ Form::model($row, ['route' => array('corevat.CatMuros.update', $row->idmuro ), 'method'=>'put' ]) }}
		@include('CorevatCatalogos.CatMuros._form', compact('CatMuros'))
		<div class="form-actions form-group">
			{{ Form::submit('Modificar registro', array('class' => 'btn btn-primary')) }}
			<a href="{{URL::route('corevat.CatMuros.index')}}" class="btn btn-warning" role="button">Cancelar</a>
		</div>
		{{Form::close()}}
    </div>

	<div class="col-sm-8 col-md-8 col-lg-8">
		@include('CorevatCatalogos.CatMuros._list', compact('CatMuros'))
	</div>
</div>
@stop