@extends('layouts.default')

@section('title')
Bienvenido :: @parent
@stop

@section('content')
<div class="list-group">
    <h1>Instalaciones Especiales del Predio {{$datos->gid }} </h1>

    Gid: {{ Form::text('text', null ,array( 'placeholder' => $datos->gid , 'readonly' => 'readonly')) }}
    Clave: {{ Form::text('text', null ,array( 'placeholder' => $datos->clave , 'readonly' => 'readonly')) }}
    Superficie Terreno: {{ Form::text('text', null ,array( 'placeholder' => $datos->superficie_terreno , 'readonly' => 'readonly')) }}
    Superficie Construcion: {{ Form::text('text', null ,array( 'placeholder' => $datos->superficie_construccion , 'readonly' => 'readonly')) }}
    Tipo de Predio: {{ Form::text('text', null ,array( 'placeholder' => $datos->tipo_predio , 'readonly' => 'readonly')) }}
    ID-DR: {{ Form::text('text', null ,array( 'placeholder' => $datos->id_dr , 'readonly' => 'readonly')) }}
    ID-DU: {{ Form::text('text', null ,array( 'placeholder' => $datos->id_du , 'readonly' => 'readonly')) }}
    Distancia Cabecera: {{ Form::text('text', null ,array( 'placeholder' => $datos->distancia_cabecera , 'readonly' => 'readonly')) }}
    Uso Suelo: {{ Form::text('text', null ,array('placeholder' => $datos->uso_suelo , 'readonly' => 'readonly')) }}
    Uso Construccion: {{ Form::text('text', null ,array( 'placeholder' => $datos->uso_construccion , 'readonly' => 'readonly')) }}
    Propietario: {{ Form::text('text', null ,array( 'placeholder' => $datos->id_propietario , 'readonly' => 'readonly')) }}
    Tipo Propiedad: {{ Form::text('text', null ,array( 'placeholder' => $datos->tipo_propiedad , 'readonly' => 'readonly')) }}
    Curt: {{ Form::text('text', null ,array( 'placeholder' => $datos->curt , 'readonly' => 'readonly')) }}
    Fecha Ingreso: {{ Form::text('text', null ,array( 'placeholder' => $datos->fecha_ingr , 'readonly' => 'readonly')) }}
    Fecha Modificacion: {{ Form::text('text', null ,array( 'placeholder' => $datos->fecha_umod , 'readonly' => 'readonly'))}}
    Clave Original: {{ Form::text('text', null ,array( 'placeholder' => $datos->clave_ori , 'readonly' => 'readonly')) }}
    Entidad: {{ Form::text('text', null ,array( 'placeholder' => $datos->entidad , 'readonly' => 'readonly')) }}
    Municipio: {{ Form::text('text', null ,array('placeholder' => $datos->municipio , 'readonly' => 'readonly')) }}

</div>
<div class="row">
    <!--Instalaciones Especiales-->
    <br>
    <a class="btn btn-warning nuevo"  href="{{ action('BuscarController@getInstalacion', ['gid' => $datos->gid]) }}">Instalacion Especiales</a>

</div>
@stop
