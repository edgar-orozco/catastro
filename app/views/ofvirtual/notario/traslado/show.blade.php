{{--ToDo: Corregir estilos--}}
@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    {{ HTML::style('css/forms.css') }}

    <h1>Traslado de dominios</h1>

    <div class="row">


        <table class="table table-striped">
            <tr>
                <th class="text-right"><b>Clave catastral:</b></th>
                <td>{{$predio->clave}}</td>
            </tr>
            <tr>
                <th class="text-right"><b>Cuenta catastral:</b></th>
                <td>{{$predio->cuenta}}</td>
            </tr>
            <tr>
                <th class="text-right"><b>Tipo predio:</b></th>
                <td>{{$predio->tipo_predio}}</td>
            </tr>
            <tr>
                <th class="text-right"><b>Ubicacion:</b></th>
                <td>{{$predio->ubicacionFiscal->ubicacion}}</td>
            </tr>
            <tr>
                <th class="text-right"><b>Superficie terreno:</b></th>
                <td>{{number_format($predio->superficie_terreno,2, '.', ',')}} m<sup>2</sup></td>
            </tr>
            <tr>
                <th class="text-right"><b>Superficie construcción:</b></th>
                <td>{{number_format($predio->superficie_construccion,2, '.', ',')}} m<sup>2</sup></td>
            </tr>


            <tr>
                <th class="text-right" colspan="2"><b>Vendedor:</b></th>
            </tr>

            <tr>
                <th class="text-right"><b>Tipo Persona:</b></th>
                <td>{{$traslado->vendedor->tipo['nombre']}}</td>
            </tr>

            <tr>
                <th class="text-right"><b>Nombre:</b></th>
                <td>{{$traslado->vendedor['nombres']}} {{$traslado->vendedor['apellido_paterno']}} {{$traslado->vendedor['apellido_materno']}}</td>
            </tr>
            <!-- Persona física -->
            <tr>
                <th class="text-right"><b>CURP:</b></th>
                <td>{{$traslado->vendedor['curp']}}</td>
            </tr>
            <!-- Persona física -->
            <tr>
                <th class="text-right"><b>RFC:</b></th>
                <td>{{$traslado->vendedor['rfc']}}</td>
            </tr>
            {{--/Vendedor --}}



            {{--Comprador --}}
            <tr>
                <th class="text-right" colspan="2"><b>Comprador:</b></th>
            </tr>

            <tr>
                <th class="text-right"><b>Tipo Persona:</b></th>
                <td>{{$traslado->comprador->tipo['nombre']}}</td>
            </tr>

            <tr>
                <th class="text-right"><b>Nombre:</b></th>
                <td>{{$traslado->comprador['nombres']}} {{$traslado->comprador['apellido_paterno']}} {{$traslado->comprador['apellido_materno']}}</td>
            </tr>

            <!-- Persona física -->
            <tr>
                <th class="text-right"><b>CURP:</b></th>
                <td>{{$traslado->comprador['curp']}}</td>
            </tr>
            <!-- Persona física -->

            <tr>
                <th class="text-right"><b>RFC:</b></th>
                <td>{{$traslado->comprador['rfc']}}</td>
            </tr>
            {{--/Comprador --}}


            <tr>
                <th class="text-right" colspan="2"><b>Datos del predio:</b></th>
            </tr>
            <tr>
                <th class="text-right"><b>Superficie vendida M2:</b></th>
                <td>{{$traslado->superficie_vendida}}</td>
            </tr>
            <tr>
                <th class="text-right"><b>Superficie construcción vendida M2:</b></th>
                <td>{{$traslado->superficie_construccion_vendida}}</td>
            </tr>

            <tr>
                <th class="text-right"><b>Medidas colindancias:</b></th>
                <td>{{$traslado->medidas_colindancias}}</td>
            </tr>


            <tr>
                <th class="text-right" colspan="2"><b>Datos de la escritura precedente:</b></th>
            </tr>
            <tr>
                <th class="text-right"><b>Escritura de fecha:</b></th>
                <td>{{$traslado->escritura_fecha ?date("d-m-Y", strtotime($traslado->escritura_fecha)) : ''}}</td>
            </tr>
            <tr>
                <th class="text-right"><b>N° registro:</b></th>
                <td>{{$traslado->escritura_registro}}</td>
            </tr>

            <tr>
                <th class="text-right"><b>Predio:</b></th>
                <td>{{$traslado->escritura_predio}}</td>
            </tr>
            <tr>
                <th class="text-right"><b>Folio:</b></th>
                <td>{{$traslado->escritura_folio}}</td>
            </tr>

            <tr>
                <th class="text-right"><b>Volumen:</b></th>
                <td>{{$traslado->escritura_volumen}}</td>
            </tr>
            <tr>
                <th class="text-right"><b>Impuesto pagado del:</b></th>
                <td>{{$traslado->escritura_impuesto_desde ?date("d-m-Y", strtotime($traslado->escritura_impuesto_desde)) : ''}}</td>
            </tr>
            <tr>
                <th class="text-right"><b>Al:</b></th>
                <td>{{$traslado->escritura_impuesto_hasta ?date("d-m-Y", strtotime($traslado->escritura_impuesto_hasta)) : ''}}</td>
            </tr>

        </table>
    </div>

    {{ Form::model($traslado, ['url' => array('ofvirtual/notario/traslado/asignarFolio', $traslado->id ), 'method'=>'GET' ]) }}
    <div class="form-actions form-group col-md-4" style="clear:both; float: right;">
        {{ Form::submit('Finalizar traslado de dominio', array('class' => 'btn btn-primary')) }}
    </div>
    {{Form::close()}}

    {{ Form::model($traslado, ['url' => array('ofvirtual/notario/traslado'), 'method'=>'GET' ]) }}
    <div class="form-actions form-group col-md-4" style="clear:both; float: right;">
        {{ Form::submit('Salir sin finalizar traslado de dominio', array('class' => 'btn btn-warning')) }}
    </div>
    {{Form::close()}}


@stop