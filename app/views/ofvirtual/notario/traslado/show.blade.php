{{--ToDo: Corregir estilos--}}
@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    {{ HTML::style('css/forms.css') }}

    <h1>Traslado de dominios</h1>

    <div class="row">

        <p>Con fundamento en los articulos 78, 108, 109, 110, 111, 112,113, 114 Y Art 5to Transitorio de la Ley de
            Hacienda
            Municipal del Estado de Tabasco en Vigor; me permito enterar el pago de Impuesto sobre el Traslado de
            Dominio de
            Bienes Inmuebles, mediante la siguiente Declaracion presentada en duplicado.</p>
    </div>


    <div class="row">

        {{-- <div class=" col-md-6">--}}
        <div class="panel panel-default">
            <div class="panel-body">
                <div class=" col-md-4">
                    Lugar:   {{ $traslado->lugar}}
                </div>
                <div class=" col-md-4">
                    Fecha:{{ $traslado->fecha}}
                </div>
                <div class=" col-md-4">
                    Declaración: {{$traslado->declaracion}}
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
                        Tipo de persona: {{$traslado->adquiriente->tipo->nombre}}
                    </div>
                    Nombre: {{$traslado->adquiriente->nombres}} {{$traslado->adquiriente->apellido_paterno}}  {{$traslado->adquiriente->apellido_materno}}

                    <div>
                        CURP/RFC: {{$traslado->adquiriente->curp}} {{$traslado->adquiriente->rfc}}
                    </div>

                </div>
                {{--/adquiriente --}}

                {{--enajenante --}}
                <div class=" col-md-6">

                    <h3> Enajenante </h3>

                    <div>
                        Tipo de persona: {{$traslado->enajenante->tipo->nombre}}
                    </div>

                    Nombre: {{$traslado->enajenante->nombres}} {{$traslado->enajenante->apellido_paterno }} {{$traslado->enajenante->apellido_materno }}

                    <div>
                        CURP/RFC: {{$traslado->enajenante->curp}} {{$traslado->enajenante->rfc}}
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
                    Tipo de escritura: {{$traslado->tipo_escritura}}
                </div>
                <div class=" col-md-4">
                    N°. De escritura: {{$traslado->escritura_registro}}
                </div>
                <div class=" col-md-4">
                    Volumen: {{$traslado->escritura_volumen }}
                </div>
                <div class=" col-md-4">
                    De fecha: {{$traslado->escritura_fecha}}
                </div>

                <div style="clear:both"></div>
                <div>

                    Pasada ante la fe del notario: {{$traslado->notarioEscritura}}

                    <br>
                    Notaría pública: {{$traslado->notariaEscritura}}

                </div>

                <div style="clear:both"></div>
                Naturaleza del Contrato: {{$traslado->naturaleza_contrato}}

                <br>

                <div style="clear:both"></div>
                <div>
                    Ubicacion: {{$traslado->ubicacion}}
                    <br>

                    Superficie terreno: {{$traslado->superficie_terreno}} m2
                    <br>

                    Superficie construcción: {{$traslado->superficie_construccion}} m2
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Antecedentes de la propiedad</h3>
            </div>
            <div class="panel-body">

                Pasada ante la fe del notario: {{$traslado->notario_antecedente_id}}
                <br>

                <div class=" col-md-4">
                    N° de escritura: {{$traslado->num_antecedente}}
                </div>
                <div class=" col-md-4">
                    Volumen:{{$traslado->volumen_antecedente}}
                </div>
                <div class=" col-md-4">

                    De fecha: {{$traslado->fecha_antecedente}}
                </div>

                <div class=" col-md-4">
                    Partida: {{$traslado->partida_antecedente  }}
                </div>
                <div class=" col-md-4">
                    Predio: {{$traslado->predio_antecedente }}

                </div>
                <div class=" col-md-4">
                    Folio: {{$traslado->folio_real_antecedente  }}
                </div>

                <div class=" col-md-4">
                    Volumen: {{$traslado->volumen_freal_antecedente}}
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
                    Valor comercial de inmueble: {{$traslado->valor_comercial_antecedentre }}
                </div>
                <div class=" col-md-4">
                    Valuador con registro estatal: {{$traslado->valuador_num_ant}}
                </div>
                <div class=" col-md-4">
                    No de folio de avaluo: {{$traslado->folio_avaluo_ant  }}
                </div>
            </div>
        </div>


        <div class=" col-md-6">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Liquidación vivienda</h3>
                </div>
                <div class="panel-body">
                    Tipo Vivienda: {{$traslado->tipo_vivienda}}
                    <br>
                    Precio base: {{$traslado->precio_base}}
                    <br>
                    Deducción: {{$traslado->deduccion}}
                    <br>
                    Base gravable por la que pagaron: {{$traslado->base_gravable}}
                    <br>
                    Diferencia omitida: {{$traslado->diferencia_omitida}}
                    <br>
                    Porcentaje aplicarse: {{$traslado->porcentaje_aplicarse}}
<br>
                    Impuesto enterar: {{$traslado->impuesto_enterar}}
<br>
                    Actualización: {{$traslado->actualizacion}}
                    <br>
                    Recargos: {{$traslado->recargos}}
                    <br>
                    Importe total: {{$traslado->importe_total}}
                </div>
            </div>
        </div>
        {{--/Datos del predio --}}
        <div class=" col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Valores para base de pago</h3>
                </div>
                <div class="panel-body">
                    Valor catastral: {{ $traslado->valor_catastral}}
                    <br>
                    Valor de operación: {{ $traslado->valor_operacion}}
                    <br>
                    Valor comercial del inmueble: {{ $traslado->valor_comercial }}
                    <br>
                    Valuador num: {{ $traslado->valuador_num}}
                    <br>
                    N° de folio de avaluo: {{ $traslado->folio_avaluo}}
                </div>
            </div>
        </div>

        {{ Form::model($traslado, ['url' => array('ofvirtual/notario/traslado/asignarFolio', $traslado->id ), 'method'=>'GET' ]) }}
        <div class="form-actions  col-md-4" style="clear:both; float: right;">
            {{ Form::submit('Finalizar traslado de dominio', array('class' => 'btn btn-primary')) }}
        </div>
        {{Form::close()}}

        {{ Form::model($traslado, ['url' => array('ofvirtual/notario/traslado'), 'method'=>'GET' ]) }}
        <div class="form-actions  col-md-4" style="clear:both; float: right;">
            {{ Form::submit('Salir sin finalizar traslado de dominio', array('class' => 'btn btn-warning')) }}
        </div>
        {{Form::close()}}
    </div>
@stop