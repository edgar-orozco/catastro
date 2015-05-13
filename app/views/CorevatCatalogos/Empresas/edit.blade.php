@extends('layouts.default')
@section('title')
{{{ $title }}} :: @parent
@stop
@section('content')
<div class="row">
    <a href="{{URL::route('corevat.Empresas.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Regresar</a>
	<div class="col-md-4">
		{{ Form::model($row, ['route' => array('corevat.Empresas.update', $row->idemp ), 'method'=>'put' ]) }}
		@include('CorevatCatalogos.Empresas._form', compact('row'))
		<div class="form-actions form-group">
			{{ Form::submit('Modificar', array('class' => 'btn btn-primary')) }}
			<a href="{{URL::route('corevat.Empresas.index')}}" class="btn btn-warning" role="button">Cancelar</a>
		</div>
		{{Form::close()}}
    </div>

	<div class="col-sm-8 col-md-8 col-lg-8">
		@include('CorevatCatalogos.Empresas._list', compact('empresas'))
	</div>
</div>
@stop
