@extends('layouts.kiosko')
@section('styles')
    <style>
        .consulta{
            min-height: 30vh;
        }
    </style>
@append

@section('content')

{{Form::open(['action'=>'ConsultaBoletaPredialController@consulta'])}}

    <div class="consulta">

        <h2>Boleta Predial: <small>consultar e imprimir</small></h2>

        <hr>
        <h3>Ingrese los datos del predio</h3>
        <br>

        <div class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-2">
                    {{Form::label('municipio','MUNICIPIO')}}
                </div>
                <div class="col-sm-3">
                    {{Form::select('municipio', [null => '']+$listaMunicipios, null, ['class'=>'form-control select2 select-municipio'] )}}
                    {{$errors->first('municipio', '<span class=text-danger>:message</span>')}}
                </div>
            </div>
        </div>

        <div class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-2">
                    {{Form::label('manifestacion[clave_zona]','CLAVE CATASTRAL')}}
                </div>
                <div class="col-sm-2">
                    {{Form::text('clave_zona', null, ['class'=>'form-control clave-zona', 'placeholder' => 'ZONA', 'maxlength'=>3, 'size'=>3, 'required'=>true, ] )}}
                    {{$errors->first('clave_zona', '<span class=text-danger>:message</span>')}}
                </div>
                <div class="col-sm-2">
                    {{Form::text('clave_manzana', null, ['class'=>'form-control clave-manzana', 'placeholder' => 'MANZANA', 'maxlength'=>4, 'size'=>4, 'required'=>true, 'pattern'=>'\d{4}', 'title'=>'Son obligatorios los cuatro dígitos'] )}}
                    {{$errors->first('clave_manzana', '<span class=text-danger>:message</span>')}}
                </div>
                <div class="col-sm-3">
                    {{Form::text('clave_predio', null, ['class'=>'form-control clave-predio', 'placeholder' => 'PREDIO', 'maxlength'=>6, 'size'=>7, 'required'=>true, 'pattern'=>'\d{6}', 'title'=>'Son obligatorios los seis dígitos'] )}}
                    {{$errors->first('clave_predio', '<span class=text-danger>:message</span>')}}
                </div>

            </div>
        </div>

        <div class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-2">
                    {{Form::label('cuenta','CUENTA PREDIAL')}}
                </div>
                <div class="col-sm-3">
                    {{Form::text('cuenta', null, ['class'=>'form-control cuenta', 'placeholder' => '000000', 'maxlength'=>6, 'size'=>6, 'required'=>true, 'pattern'=>'\d{6}', 'title'=>'Debe ingresarse en el formato esperado. Ej: 123456' ] )}}
                    {{$errors->first('cuenta', '<span class=text-danger>:message</span>')}}
                </div>
            </div>
        </div>
        <div class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-2">
                    {{Form::label('tipo','TIPO DE PREDIO')}}
                </div>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        {{Form::radio('tipo','R',null,['required'=>true])}}
                        RÚSTICO

                    </label>
                    <label class="radio-inline">
                        {{Form::radio('tipo','U',null,['required'=>true])}}
                        URBANO
                    </label>
                    {{$errors->first('tipo', '<span class=text-danger>:message</span>')}}
                </div>
            </div>
        </div>
        <hr>
        {{Form::submit('Consultar Boleta Predial',['class'=>'btn btn-primary'])}}
        {{Form::reset('Cancelar',['class'=>'btn btn-warning'])}}
    </div>

{{Form::close()}}
@stop

@section('javascript')
    {{ HTML::script('js/select2/select2.full.min.js') }}
    {{ HTML::script('js/select2/i18n/es.js') }}
    {{ HTML::style('css/select2.min.css') }}
    <script>
        $(function () {

            $(".select2").select2({
                language: "es",
                placeholder: "-- Seleccione",
                allowClear: true,
                dropdownAutoWidth: true,
                width: 'resolve'
            });

        });
    </script>

@append
