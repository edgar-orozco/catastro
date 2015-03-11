@extends('catalogos.peritos.editPerito')


@section('titulo2')
Actualización de Peritos
@stop


@section('corevat')
{{ Form::open(array('url' => 'catalogos/peritos/actPerito')) }}
{{ Form::textarea('corevat', $variableperito->corevat, array('cols'=>'30', 'rows'=>'1'), ['class'=>'form-control'])}}
{{$errors->first("corevat")}}
@stop


@section('nombre')
{{ Form::textarea('nombre', $variableperito->nombre, array('cols'=>'60', 'rows'=>'1'), ['class'=>'form-control'])}}
{{ Form::hidden('id', $variableperito->id) }}
{{ Form::hidden('status', $variableperito->Estado) }}
{{$errors->first("nombre")}}
@stop



@section('direccion')
{{ Form::textarea('direccion', $variableperito->direccion, array('cols'=>'60', 'rows'=>'3'), ['class'=>'form-control'])}}
<br>{{$errors->first("direccion")}}
<br>
@stop


@section('telefono')
{{ Form::textarea('telefono', $variableperito->telefono, array('cols'=>'60', 'rows'=>'3'), ['class'=>'form-control'])}}
{{$errors->first("telefono")}}
@stop


@section('correo')
{{ Form::textarea('correo', $variableperito->correo, array('cols'=>'60', 'rows'=>'2'), ['class'=>'form-control'])}}
{{$errors->first("correo")}}
@stop


@section('boton')
<input class="btn btn-primary" type="submit" value="Actualizar">
{{ Form::close()}}
@stop