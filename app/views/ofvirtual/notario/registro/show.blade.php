<?php setlocale(LC_MONETARY, 'es_MX');
setlocale(LC_ALL,"es_ES") ?>
{{--ToDo: Corregir estilos--}}
@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    {{ HTML::style('css/forms.css') }}

    <h1>Registro de escrituras</h1>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Folio</h3>
            </div>
                <div class="panel-body">
                No. de folio: {{$registro->folio}}
            </div>
            </div>


    </div>


    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Datos del notario</h3>
                </div>
                <div class="panel-body">
                <div class=" col-md-6">
                    Tipo de escritura: {{$registro->tipo_escritura}}
                </div>
                <div class="col-md-6">
            Naturaleza del Contrato: {{$registro->naturaleza_contrato}}
            </div>
                <div class=" col-md-6">
                        Nombre del Notario:{{$registro->notarioEscritura}}
                    </div>
                <div class=" col-md-6">
                   No. de Notaria:{{$notaria->nombre}}
                </div>

                    <div class=" col-md-12">
                        Domicilio:{{$notaria->domicilio}}
                    </div>
                                        <div class=" col-md-4">
                        No. Telefónico:{{$notaria->telefono}}
                    </div>
                                        <div class=" col-md-4">
                        E-mail:{{$notaria->correo}}
                    </div>
                     <div class=" col-md-4">
                        Volumen:{{$registro->volumen}}
                    </div>
                    <div class=" col-md-4">
                        No. De cuenta:{{$registro->cuenta}}
                    </div>
                    <div class=" col-md-4">
                        Clave Catastral:{{$registro->clave}}
                    </div>
                    <div class=" col-md-4">
                        <?php 
                        if($registro->tipo_predio=='U'){
                            $tipo_p='Urbano';
                        }
                        if($registro->tipo_predio=='R'){
                            $tipo_p='Rustico';
                        }
                        ?>
                        Tipo de predio:{{$tipo_p}}
                    </div>

            </div>
            </div>

    </div>

    <div class="row">
      {{--Datos del predio --}}

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Datos del inmueble</h3>
            </div>
            <div class="panel-body">

                <div class="col-md-12">
                    Ubicacion: {{$predio->ubicacionFiscal->ubicacion}}
                </div>
                <div class="col-md-6">


                    Superficie terreno: {{$predio->superficie_terreno}} m2
                </div>
                <div class="col-md-6">
                    Superficie construcción: {{$predio->superficie_construccion}} m2
                </div>
                <div class=" col-md-6">
                    Volumen: {{$registro->volumen }}
                </div>
                <div class=" col-md-6">
                   Niveles: {{$registro->niveles}}
                </div>
                <div class=" col-md-6">
                    Estado de conservación: {{$registro->estado_conserv}}
                </div>


            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Contratantes</h3>
            </div>
            <div class="panel-body">

                {{--adquiriente --}}
                <div class=" col-md-6">
                    <h3> Adquiriente </h3>

                    <div>
                        Tipo de persona: {{$registro->adquiriente->tipo->nombre}}
                    </div>
                    Nombre: {{$registro->adquiriente->nombres}} {{$registro->adquiriente->apellido_paterno}}  {{$registro->adquiriente->apellido_materno}}

                    <div>
                        CURP/RFC: {{$registro->adquiriente->curp}} / {{$registro->adquiriente->rfc}}
                    </div>

                    <div>
                       Dirección: {{$domicilioA}} 
                    </div>

                </div>
                {{--/adquiriente --}}

                {{--enajenante --}}
                <div class=" col-md-6">

                    <h3> Enajenante </h3>

                    <div>
                        Tipo de persona: {{$registro->enajenante->tipo->nombre}}
                    </div>

                    Nombre: {{$registro->enajenante->nombres}} {{$registro->enajenante->apellido_paterno }} {{$registro->enajenante->apellido_materno }}

                    <div>
                        CURP/RFC: {{$registro->enajenante->curp}} / {{$registro->enajenante->rfc}}
                    </div>

                    <div>
                       Dirección: {{$domicilioE}} 
                    </div>
                    {{--/enajenante --}}
                </div>
                <div class="col-md-6"><h3>Fecha del Instrumento</h3> <?php $fecha_instrumento= strtotime ( $registro->fecha_instrumento ) ; $dia=utf8_encode(strftime("%A %d de %B del %Y",$fecha_instrumento)); echo $dia; ?></div>
                <div class="col-md-6"><h3>Fecha de Firma</h3> <?php $fecha_firma= strtotime ( $registro->fecha_firma ) ; $dias=utf8_encode(strftime("%A %d de %B del %Y",$fecha_firma)); echo $dias; ?> </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Colindancias</h3>
            </div>
            <div class="panel-body">
                <table  class="table">
                    <thead>
                    <tr>
                    <th><P align="center">Orientación:</p></th>
                    <th><P align="center">Superficie</p></th>
                    <th><P align="center">Colindancia</p></th>
                </tr>
            </thead>
                <?php 
                    $colindanciasArray=json_decode($JsonColindancias);
                    ?>

                      @foreach($colindanciasArray as $key => $value)
                      <tr>
                        <th>{{$value->orientacion}}</th>
                        <th>{{$value->superficie}}</th>
                        <th>{{$value->colindancia}}</th>
                    </tr>

                     @endforeach
            </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Antecedentes de la propiedad</h3>
            </div>
            <div class="panel-body">
                <div class=" col-md-8">
                Pasada ante la fe del notario: {{$registro->notarioEscritura}}
                </div>

                <div class=" col-md-4">
                    N° de Notaria: {{$notaria->nombre}}
                </div>
                <div class=" col-md-6">
                    Bajo el Número:{{$registro->antecedente_num}}
                </div>
                <div class=" col-md-6">

                   Folio: {{$registro->folio}}
                </div>

                <div class=" col-md-3">
                    No. De Cuenta Predial: {{$registro->cuenta}}
                </div>
                <div class=" col-md-5">
                    No. Clave catastral: {{$registro->clave }}

                </div>
                <div class=" col-md-4">
                    Tipo de Predio: {{$registro->tipo_predio}}
                </div>


                <div style="clear:both">
                <div class=" col-md-4">
                    Valor comercial de inmueble: {{$registro->valor_comercial }}
                </div>
                <div class=" col-md-4">
                    Valuador con registro estatal: {{$registro->valor_registro}}
                </div>
                <div class=" col-md-4">
                    No de folio de avaluo: {{$registro->folio_avaluo  }}
                </div></div>
            </div>
        </div>


</div>

        @if(!$registro->folio)
        {{ Form::model($registro, ['url' => array('ofvirtual/notario/registro/asignarFolio', $registro->id ), 'method'=>'GET' ]) }}
        <div class="form-actions terminar  col-md-4" style="clear:both; float: right;">
            {{ Form::submit('Finalizar registro de escritura', array('class' => 'btn btn-primary')) }}
        </div>
        {{Form::close()}}
        

        {{ Form::model($registro, ['url' => array('/ofvirtual/notario/registro-escrituras'), 'method'=>'GET' ]) }}
        <div class="form-actions  col-md-4" style="clear:both; float: right;">
            {{ Form::submit('Salir sin finalizar registro de escritura', array('class' => 'btn btn-warning')) }}
        </div>
        {{Form::close()}}
        @endif
        
        @if($registro->folio)
        {{ Form::model($registro, ['url' => array('/ofvirtual/notario/registro-escrituras'), 'method'=>'GET' ]) }}
        <div class="form-actions  col-md-4" style="clear:both; float: right;">
            {{ Form::submit('Regresar al listado', array('class' => 'btn btn-warning')) }}
        </div>
        {{Form::close()}}
        @endif

    </div>
@stop