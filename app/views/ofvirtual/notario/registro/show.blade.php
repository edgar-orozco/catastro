{{--ToDo: Corregir estilos--}}
@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    {{ HTML::style('css/forms.css') }}

    <h1>Registro de escrituras</h1>

    <div class="row">

        <p>Con fundamento en los articulos 78, 108, 109, 110, 111, 112,113, 114 Y Art 5to Transitorio de la Ley de
            Hacienda
            Municipal del Estado de Tabasco en Vigor; me permito enterar el pago de Impuesto sobre el Traslado de
            Dominio de
            Bienes Inmuebles, mediante la siguiente Declaracion presentada en duplicado.</p>
    </div>


    <div class="row">



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
                        CURP/RFC: {{$registro->adquiriente->curp}} {{$registro->adquiriente->rfc}}
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
                        CURP/RFC: {{$registro->enajenante->curp}} {{$registro->enajenante->rfc}}
                    </div>
                    {{--/enajenante --}}
                </div>
            </div>
        </div>


        {{--Datos del predio --}}

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Datos del bien inmueble</h3>
            </div>
            <div class="panel-body">
                <div>
                    Tipo de escritura: {{$registro->tipo_escritura}}
                </div>
                <div class=" col-md-4">
                    N°. De escritura: {{$registro->escritura_registro}}
                </div>
                <div class=" col-md-4">
                    Volumen: {{$registro->escritura_volumen }}
                </div>
                <div class=" col-md-4">
                    De fecha: {{$registro->escritura_fecha}}
                </div>

                <div style="clear:both"></div>
                <div>

                    Pasada ante la fe del notario: {{$registro->notarioEscritura}}

                    <br>
                    Notaría pública: {{$registro->notariaEscritura}}

                </div>

                <div style="clear:both"></div>
                Naturaleza del Acto: {{$registro->naturaleza_acto}}

                <br>

                <div style="clear:both"></div>
                <div>
                    Ubicacion: {{$predio->ubicacionFiscal->ubicacion}}
                    <br>registroregistro

                    Superficie terreno: {{$predio->superficie_terreno}} m2
                    <br>

                    Superficie construcción: {{$predio->superficie_construccion}} m2
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Antecedentes de la propiedad</h3>
            </div>
            <div class="panel-body">

                Pasada ante la fe del notario: {{$registro->notario_antecedente_id}}
                <br>

                <div class=" col-md-4">
                    N° de escritura: {{$registro->num_antecedente}}
                </div>
                <div class=" col-md-4">
                    Volumen:{{$registro->volumen_antecedente}}
                </div>
                <div class=" col-md-4">

                    De fecha: {{$registro->fecha_antecedente}}
                </div>

                <div class=" col-md-4">
                    Partida: {{$registro->partida_antecedente  }}
                </div>
                <div class=" col-md-4">
                    Predio: {{$registro->predio_antecedente }}

                </div>
                <div class=" col-md-4">
                    Folio: {{$registro->folio_real_antecedente  }}
                </div>

                <div class=" col-md-4">
                    Volumen: {{$registro->volumen_freal_antecedente}}
                </div>

                <div style="clear:both"></div>
                <div>
                    <div class="row">
                        No. de cuenta predial: {{$predio->cuenta}}
                    </div>
                    <div class="row">
                        Regimen: {{$predio->tipo_predio}}
                    </div>
                    <div class="row">
                        Clave catastral: {{$predio->clave}}
                    </div>
                </div>
                <div style="clear:both"></div>
                <div class=" col-md-4">
                    Valor comercial de inmueble: {{$registro->valor_comercial_antecedentre }}
                </div>
                <div class=" col-md-4">
                    Valuador con registro estatal: {{$registro->valuador_num_ant}}
                </div>
                <div class=" col-md-4">
                    No de folio de avaluo: {{$registro->folio_avaluo_ant  }}
                </div>
            </div>
        </div>





        {{ Form::model($registro, ['url' => array('ofvirtual/notario/registro/asignarFolio', $registro->id ), 'method'=>'GET' ]) }}
        <div class="form-actions  col-md-4" style="clear:both; float: right;">
            {{ Form::submit('Finalizar registro de escritura', array('class' => 'btn btn-primary')) }}
        </div>
        {{Form::close()}}

        {{ Form::model($registro, ['url' => array('/ofvirtual/notario/registro-escrituras'), 'method'=>'GET' ]) }}
        <div class="form-actions  col-md-4" style="clear:both; float: right;">
            {{ Form::submit('Salir sin finalizar registro de escritura', array('class' => 'btn btn-warning')) }}
        </div>
        {{Form::close()}}
    </div>
@stop