@extends('layouts.hooktramite')

@section('content')

 <div class="row">
    {{ Form::open(array('url' => 'tramites/valor/store', 'method' => 'POST', 'id' => 'formValor')) }}

      @include('tramites.inspeccion._inspeccion', [])

     {{Form::submit('Crear Solicitud',['class'=>'btn btn-primary'])}}
    {{Form::close()}}
  </div>

@stop
