@extends('layouts.default')

@section('title')
{{{ $title}}} :: @parent
@stop

@section('javascript')
 <script>
    $(document).ready(function(){ 
   $('#alternar-respuesta-ej1').on('click',function(){
      $('#respuesta-ej1').toggle();
   });
});

    </script>

@stop


@section('content')
<div class="row">
    <a class="btn btn-info" href="/ofvirtual/notario/registro" role="button">
        <span class="glyphicon glyphicon-plus"></span> Capturar Registro
    </a>
</div>
<br>

<!-- listado traslados -->
    <div class="row">
        @include('ofvirtual.notario.registro._list', compact('registros'))
    </div><!-- /.row -->
@stop