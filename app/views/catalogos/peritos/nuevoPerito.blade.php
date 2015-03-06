@extends('catalogos.peritos.editPerito')



@section('titulo2')
Nuevo Perito
@stop

 
@section('corevat')
{{ Form::open(array('url' => 'catalogos/peritos/nuevoPerito')) }}
{{ Form::textarea('corevat', 'COREVAT-'.$nuevoCorevat,  array('cols'=>'30', 'rows'=>'1'), ['class'=>'form-control'])}} 
{{$errors->first("corevat")}}
@stop


@section('nombre')
{{ Form::textarea('nombre', '', array('cols'=>'60', 'rows'=>'1'), ['class'=>'form-control'])}} 
{{ Form::hidden('status', 'Habilitado') }}
{{$errors->first("nombre")}}
@stop


@section('direccion')
{{ Form::textarea('direccion', '', array('cols'=>'60', 'rows'=>'3'), ['class'=>'form-control'])}} 
{{$errors->first("direccion")}}
@stop


@section('telefono')
{{ Form::textarea('telefono', '', array('cols'=>'60', 'rows'=>'3'), ['class'=>'form-control'])}} 
{{$errors->first("telefono")}}
@stop


@section('correo')
{{ Form::textarea('correo', '', array('cols'=>'60', 'rows'=>'2'), ['class'=>'form-control'])}} 
{{$errors->first("correo")}}
@stop


@section('boton')
<input class="btn btn-primary" type="submit" value="Guardar">
{{Form::close()}}
@stop

					