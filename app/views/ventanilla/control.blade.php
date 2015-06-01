@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')
    {{ HTML::style('css/forms.css') }}
    {{ HTML::style('css/select2.min.css') }}

    <div class="row clearfix">
        @if($folio)
            <div class="col-md-2 col-md-offset-7">
                <h4>Folio: {{$folio}}</h4>
            </div>

            <div class="col-md-3">
                <h4>Estado: <span class="alert alert-success">{{$tramite->estatus->pasado}}</span></h4>
            </div>
        @endif
    </div>

    <br/>

    <div class="row clearfix">
        <div class="col-md-4 column">

            {{ Form::open(array('url' => 'ventanilla/iniciar-tramite', 'method' => 'POST', 'name' => 'forma-tramite', 'files'=>true)) }}


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Solicitante
                    </h3>
                </div>
                <div class="panel-body">

                    <div class="">
                        {{Form::label('tipo_persona','Tipo de persona', ['class'=>''])}}
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-default active" style="width: 49%;">
                                <input type="radio" name="tipo_persona" class="radio-persona"
                                       value="F" checked> Física
                            </label>
                            <label class="btn btn-sm btn-default"  style="width: 49%;">
                                <input type="radio" name="tipo_persona" class="radio-persona"
                                       value="M"> Moral
                            </label>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group clearfix">
                        {{Form::label('nombres','Nombre', ['class'=>''])}}
                        {{Form::text('nombres', null, ['class' => 'form-control', 'required'=>true] )}}
                    </div>
                    <div class="campos-fisica">
                        <div class="form-group">
                            {{Form::label('apellido_paterno','Apellido Paterno', ['class'=>''])}}
                            {{Form::text('apellido_paterno', null, ['class' => 'form-control'] )}}
                        </div>
                        <div class="form-group">
                            {{Form::label('apellido_materno','Apellido Materno', ['class'=>''])}}
                            {{Form::text('apellido_materno', null, ['class' => 'form-control'] )}}
                        </div>
                        <div class="form-group">
                            {{Form::label('curp','CURP', ['class'=>'' ])}}
                            {{Form::text('curp', null, ['class' => 'form-control', 'minlength'=>'18', 'maxlength'=>'18', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})', 'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado' ] )}}
                        </div>

                    </div>

                    <div class="form-group">
                        {{Form::label('rfc','RFC', ['class'=>'', 'p' ])}}
                        {{Form::text('rfc', null, ['class' => 'form-control', 'id' => 'rfc', 'minlength'=>'12', 'maxlength'=>'13', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})', 'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado'] )}}
                    </div>

                    {{Form::hidden('tipotramite_id', $tipotramite_id)}}
                    {{Form::hidden('clave', $clave)}}
                    {{Form::hidden('cuenta', $cuenta)}}
                    {{Form::hidden('tipo_persona', 'F', ['id'=>'tipo_persona'])}}
                    {{Form::hidden('uuid', $uuid, ['class'=>'uuid'])}}
                    <hr>

                    <div class="form-group">
                        {{Form::label('notaria_id','Notaría', ['class'=>''])}}
                        {{Form::select('notaria_id', $lista_notarias, null, ['class' => 'form-control'] )}}
                    </div>
                </div>

            </div>

            <div class="form-actions form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-arrow-right"></i>
                    Continuar trámite
                </button>
                <br/>
                {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
            </div>

            {{Form::close()}}
        </div>


        <div class="col-md-8 column">



            <div class="tabbable" id="tabs">

                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#panel-generales" data-toggle="tab">Generales</a>
                    </li>
                    <li>
                        <a href="#panel-cartografia" data-toggle="tab">Cartografía</a>
                    </li>
                    <li>
                        <a href="#panel-historial" data-toggle="tab">Historial del trámite</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="panel-generales">
                        <table class="table table-striped">
                            <tr>
                                <th class="text-right"><b>Clave catastral:</b></th>
                                <td>{{$clave}}</td>
                            </tr>
                            <tr>
                                <th class="text-right"><b>Cuenta catastral:</b></th>
                                <td>{{$cuenta}}</td>
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
                                <th class="text-right"><b>Uso de suelo:</b></th>
                                <td>
                                    @if($predio->usoSuelo)
                                        {{$predio->usoSuelo->descripcion}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right"><b>Uso de construcción:</b></th>
                                <td>
                                    @if($predio->usoConstruccion)
                                        {{$predio->usoConstruccion->descripcion}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right"><b>Propietarios:</b></th>
                                <td>
                                    <ul>
                                        @foreach($predio->propietarios as $propietario)

                                            <li>{{$propietario->propietario->nombrec}}</li>

                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="tab-pane" id="panel-cartografia">
                        </br>
                        <h4>Cartografía</h4>

                    </div>
                    <div class="tab-pane" id="panel-historial">
                        </br>
                        <h4>Historial del trámite</h4>

                    </div>

                </div>
            </div>

        </div>

    </div>
@stop


@section('javascript')
    {{ HTML::script('js/select2/select2.min.js') }}
    {{ HTML::script('js/select2/i18n/es.js') }}

    <script>

        $(function () {

            $("#notaria_id").select2({
                language: "es",
                placeholder: "Seleccione una notaría",
                allowClear: true
            });

            //Cuando hay cambios en los radio buttons de los requisitos
            $('.radio-persona').change(function (ev) {
                var radio = $(this);
                if(radio.val() == 'F'){
                    $('.campos-fisica').show();
                    $('#rfc').attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');
                    $('.tipo_persona').val('F');
                }
                else if(radio.val() == 'M')
                {
                    $('.campos-fisica').hide();
                    $('#rfc').attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');
                    $('.tipo_persona').val('M');
                }
            });

        });
    </script>

@stop