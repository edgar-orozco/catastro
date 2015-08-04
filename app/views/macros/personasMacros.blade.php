@extends('layouts.default')

@section('title')
  {{{ $title }}} :: @parent
@stop

@section('javascript')
<script>
  function limpiar()
            {

            var curp = "persona[curp]";
                $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val('');
                var nombre = "persona[nombres]";
                $( "#" + nombre.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val('');
                var apaterno = "persona[apellido_paterno]";
                $( "#" + apaterno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val('');
                var materno = "persona[apellido_materno]";
                $( "#" + materno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val('');
                var rfc = "persona[rfc]";
                $( "#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val('');
            }
</script>
    <script>

$('#formpersonas').bind('submit',function ()
    {
        $.ajax(
        {
            type: 'POST',
            data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
            processData: false,
            contentType: false,
            url: '/macro-guardar',

            success: function (data)
            {
                $('.mensaje').html('<div class="alert alert-success">El registro se actualizo correctamente.</div>');
                var curp = "persona[curp]";
                $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val('');
                var nombre = "persona[nombres]";
                $( "#" + nombre.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val('');
                var apaterno = "persona[apellido_paterno]";
                $( "#" + apaterno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val('');
                var materno = "persona[apellido_materno]";
                $( "#" + materno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val('');
                var rfc = "persona[rfc]";
                $( "#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).val('');
            }
        });
        return false;
    });
</script>

@append

@section('content')
  <div class="mensaje">
  </div>
  {{ Form::open(array('id' => 'formpersonas','url' => '/macro-guardar', 'method' => 'post')) }}
   <fieldset>
  <div class="row">

  <legend>Tipo de persona</legend>
    {{Form::label('fisica','Persona Fisica')}}
    {{Form::radio('opcion', 'fisica','cheked')}}
    {{Form::label('moral','Persona Moral')}}
    {{Form::radio('opcion', 'moral')}}

  </div>
   </fieldset>

  <!-- datos solicitante -->
  <fieldset>
  <legend>Datos personales</legend>
  <div class="row">
        {{--Form::personas('persona')--}}
  </div>

  <div class="row">
        {{Form::domicilio('persona')}}
  </div>

  <!-- /.row --></fieldset>
</br></br>

  {{ Form::submit('Guardar datos', array('class' => 'btn btn-primary', 'name' => 'boton','id' => 'boton')) }}
  {{ Form::reset('Limpiar formato',  ['class' => 'btn btn-warning', 'onclick'=>'limpiar()']) }}
  {{ Form::close() }}


@stop