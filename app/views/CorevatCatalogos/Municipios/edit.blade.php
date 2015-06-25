@extends('layouts.default')
@section('title')
{{{ $title }}} :: @parent
@stop
@section('content')
<div class="row">
    <a href="{{URL::route('corevat.Municipios.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;Regresar</a>
	<div class="col-md-4">
		{{ Form::model($row, ['route' => array('corevat.Municipios.update', $row->idmunicipio ), 'method'=>'put' ]) }}
		@include('CorevatCatalogos.Municipios._form', compact('row'))
		<div class="form-actions form-group">
			{{ Form::submit('Modificar', array('class' => 'btn btn-primary')) }}
			<a href="{{URL::route('corevat.Municipios.index')}}" class="btn btn-warning" role="button">Cancelar</a>
		</div>
		{{Form::close()}}
    </div>

	<div class="col-sm-8 col-md-8 col-lg-8">
		@include('CorevatCatalogos.Municipios._list', compact('Municipios'))
	</div>
</div>
@stop
