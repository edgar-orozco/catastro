@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')
    {{ HTML::style('css/forms.css') }}
    {{ HTML::style('css/select2.min.css') }}
    {{ HTML::style('css/tramites/timeline.css') }}

    <div class="row clearfix">
        @if($folio)
            <div class="col-md-2 col-md-offset-4">
                <h4>Folio: {{sprintf("%06d",$folio)}}</h4>
            </div>

            <div class="col-md-3 ">
                <h4>Consumidos: {{$tiempo_transcurrido}} de {{$tiempo_tramite}} días</h4>
            </div>

            <div class="col-md-3">
                <h4>Estado: <span class="alert alert-success">{{$tramite->estatus->pasado}}</span></h4>
            </div>
        @endif
    </div>

    <br/>

    <div class="row clearfix">
        <?php $nocontrol = false;?>
        @if(($tramite->estatus->pasado != 'Finalizado' && $tramite->estatus->pasado != 'Finalizado observado' ) && $esResponsable != null)

        <div class="col-md-4 column">

            {{ Form::open(array('url' => 'tramites/proceso/'.$tramite->id, 'method' => 'POST', 'name' => 'forma-tramite', 'files'=>true)) }}


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Acciones
                    </h3>
                </div>
                <div class="panel-body">


                    <div class="form-group">
                        {{Form::label('tipo_id','Actividad', ['class'=>''])}}
                        {{Form::select('tipo_id', [null => ''] + $lista_tipoactividades, null, ['id'=>'tipo_id', 'class' => 'form-control'] )}}
                    </div>

                    <div class="form-group" id="select-tipotramites" style="">
                        {{Form::label('tipotramite_id','Subtrámite', ['class'=>''])}}
                        <br>
                        {{Form::select('tipotramite_id', [null => ''] + $lista_tipotramites, null, ['id'=>'tipotramite_id', 'class' => 'form-control'] )}}
                    </div>

                    <div class="form-group">
                        {{Form::label('departamento_id','Turnar a departamento', ['class'=>''])}}
                        {{Form::select('departamento_id', [null => ''] + $lista_deptos, null, ['id'=>'departamento_id', 'class' => 'form-control', 'autofocus'=> 'autofocus'] )}}
                    </div>

                    <div class="form-group" id="observaciones" style="display: none;">
                        {{Form::label('observaciones','Observaciones', ['class'=>''])}}
                        {{Form::textarea('observaciones', null, ['class' => 'form-control'] )}}
                    </div>

                </div>

            </div>

            <div class="form-actions form-group">
                <button type="submit" class="btn btn-success">
                    <i class="glyphicon glyphicon-arrow-right"></i>
                    Continuar trámite
                </button>
                {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning', 'id'=>'btn-reset']) }}
            </div>

            {{Form::close()}}
        </div>
        @else
            <?php $nocontrol = true;?>
        @endif

        @if($nocontrol)
        <div class="col-md-12 column">
        @else
        <div class="col-md-8 column">
        @endif


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

                    <div class="tab-pane" id="panel-docs">
                        <br/>
                        @include('ventanilla._documentos',compact('tramite','tipotramite'))

                    </div>

                    <div class="tab-pane" id="panel-solicitante">
                        <br/>
                        <h4><small>Nombre:</small> {{$tramite->solicitante->nombres}} </h4>
                        @if($tramite->tipo_solicitante == 'FISICA')
                            <h4><small>Apellido Paterno:</small> {{$tramite->solicitante->apellido_paterno}} </h4>
                            <h4><small>Apellido Materno:</small> {{$tramite->solicitante->apellido_materno}} </h4>
                            <h4><small>CURP:</small> {{$tramite->solicitante->curp}} </h4>
                        @endif
                        <h4><small>RFC:</small> {{$tramite->solicitante->rfc}} </h4>
                    @if($tramite->notaria)
                            <h4><small>Notaría:</small> {{$tramite->notaria->nombre}} @if($tramite->notaria->mpio) de {{$tramite->notaria->mpio->nombre_municipio}} @endif</h4>
                        @endif
                    </div>

                    <div class="tab-pane" id="panel-historial">
                        </br>
                        @include('ventanilla._timeline',compact('tramite'))

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
            $("#departamento_id").select2({
                language: "es",
                placeholder: "Seleccione un departamento",
                allowClear: true
            });

            $("#tipo_id").select2({
                language: "es",
                placeholder: "Seleccione una actividad",
                allowClear: true
            });

            $("#tipotramite_id").select2({
                language: "es",
                placeholder: "Seleccione un trámite",
                allowClear: true
            });

            $("#select-tipotramites").hide();

            //Si se devuelve con observaciones o finaliza con observaciones (opcion == 2 o 9)
            //Entonces se muestra para captura el textarea de observaciones
            //TODO: refactoring de los números mágicos por constantes de otro tipo

            $("#tipo_id").change(function (ev) {
                console.log($(this).val());
                if($(this).val() == 2 || $(this).val() == 9) {
                    $('#observaciones').show();
                    return true;
                }
                //Si el tipo de actividad es iniciar un subtrámite entonces se muestra el selector de tiposdetramite
                if($(this).val() == 7){
                    $("#select-tipotramites").show();
                    return true;
                }
                $('#observaciones').hide();
                $('#select-tipotramites').hide();
            });


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

            $("#btn-reset").on("click", function () {
                    $("#departamento_id").val(null).trigger("change");
                    $("#actividad_id").val(null).trigger("change");
                }
            );


        });

    </script>

@append

