@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    <div class="row clearfix">
        @if($folio)
            <div class="col-md-2 col-md-offset-7">
                <h4>Folio: {{sprintf("%06d",$folio)}}</h4>
            </div>

            <div class="col-md-3">
                <h4>Estado: <span class="alert alert-success">{{$estado}}</span></h4>
            </div>
        @endif
    </div>

    <br/>

    <div class="row clearfix">
        <div class="col-md-4 column">

            {{ Form::open(array('url' => 'tramite/flujo', 'method' => 'POST', 'name' => 'forma-tramite', 'files'=>true)) }}


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Acciones
                    </h3>
                </div>
                <div class="panel-body">

                </div>

            <div class="form-actions form-group">
                <button type="submit" class="btn btn-success">
                    <i class="glyphicon glyphicon-arrow-right"></i>
                    Continuar trámite
                </button>
                {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
            </div>
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
                        <a href="#panel-solicitante" data-toggle="tab">Solicitante</a>
                    </li>
                    <li>
                        <a href="#panel-docs" data-toggle="tab">Documentos Digitalizados</a>
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

                        <br/>
                        <h4><small>Clave catastral:</small> {{$clave}} </h4>
                        <h4><small>Cuenta catastral:</small> {{$cuenta}} </h4>
                        <h4><small>Tipo predio: </small>{{$predio->tipo_predio}} </h4>
                        <h4><small>Ubicacion: </small>{{$predio->ubicacionFiscal->ubicacion}} </h4>
                        <h4><small>Superficie terreno: </small>{{number_format($predio->superficie_terreno,2, '.', ',')}} m<sup>2</sup> </h4>
                        <h4><small>Superficie construcción: </small>{{number_format($predio->superficie_construccion,2, '.', ',')}} m<sup>2</sup> </h4>
                        <h4><small>Uso de suelo: </small>{{$predio->usoSuelo->descripcion}} </h4>
                        <h4><small>Uso de construcción: </small>{{$predio->usoConstruccion->descripcion}} </h4>
                        <h4><smal>Propietarios:</smal></h4>
                        <ul>
                        @foreach($predio->propietarios as $propietario)

                            <li>{{$propietario->propietario->nombrec}}</li>

                        @endforeach
                        </ul>
                    </div>

                    <div class="tab-pane" id="panel-docs">
                        <br/>
                    </div>

                    <div class="tab-pane" id="panel-solicitante">
                        <br/>
                        <h4><small>Nombre:</small> {{$tramite->solicitante->nombres}} </h4>
                        @if($tramite->tipo_persona == 'FISICA')
                            <h4><small>Apellido Paterno:</small> {{$tramite->solicitante->apellido_paterno}} </h4>
                            <h4><small>Apellido Materno:</small> {{$tramite->solicitante->apellido_materno}} </h4>
                        @endif
                        @if($tramite->notaria)
                            <h4><small>Notaría:</small> {{$tramite->notaria->nombre}} </h4>
                        @endif
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
    <script>

        $(function () {

            //Cuando hay cambios en los radio buttons de los requisitos
            $('.radio-persona').change(function (ev) {
                var radio = $(this);
                if(radio.val() == 'F'){
                    $('.campos-fisica').show();
                    $('.tipo_persona').val('F');
                }
                else if(radio.val() == 'M')
                {
                    $('.campos-fisica').hide();
                    $('.tipo_persona').val('M');
                }
            });

        });
    </script>

@stop