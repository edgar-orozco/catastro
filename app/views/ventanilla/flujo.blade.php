@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop
@section('content')
    <style>
        html{
            height: 100% !important;
        }
        body{
            min-height: 100% !important;
        }
    </style>

    {{ HTML::style('css/forms.css') }}
    {{ HTML::style('css/select2.min.css') }}
    {{ HTML::style('css/tramites/timeline.css') }}

    <br/>

    <div class="row clearfix">

        <?php $nocontrol = false;?>
        @if(($tramite->estatus->pasado != 'Finalizado' && $tramite->estatus->pasado != 'Finalizado observado' ) && $esResponsable != null)

        <div class="col-md-4 column">

            {{ Form::open(array('url' => 'tramites/proceso/'.$tramite->id, 'method' => 'POST', 'name' => 'forma-tramite', 'enctype' => 'multipart/form-data')) }}


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

                    <div class="form-group">
                        {{Form::checkbox('comentarios_chb',1,null, ['class'=>'comentarios_chb'])}}
                        {{Form::label('comentarios_chb','Agregar comentario')}}
                    </div>

                    <div class="form-group" id="observaciones" style="display: none;">
                        {{Form::label('observaciones','Observaciones', ['class'=>''])}}
                        {{Form::textarea('observaciones', null, ['class' => 'form-control'] )}}
                    </div>

                    <div class="form-group" id="comentarios-div" style="display: none;">
                        {{Form::label('comentarios','Comentarios', ['class'=>''])}}
                        {{Form::textarea('comentarios', null, ['class' => 'form-control'] )}}
                    </div>
                    {{Form::hidden('tramite_id', $tramite_id, ['id'=>'tramite_id'])}}
                </div>

            </div>

            <div class="form-actions form-group">
                <button type="submit" class="btn btn-success">
                    <i class="glyphicon glyphicon-arrow-right"></i>
                    Continuar trámite
                </button>
                <br/>
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
            <div class="clearfix">
                @if($folio)
                    <div class="col-md-4" style="border: 1px solid darkgray">
                        <h4>Folio: {{$anio}}/{{$municipio}}/{{sprintf("%06d",$folio)}}</h4>
                    </div>

                    <div class="col-md-4 "  style="border: 1px solid darkgray">
                        <h4>Consumidos: {{$tiempo_transcurrido}} de {{$tiempo_tramite}} días</h4>
                    </div>

                    <div class="col-md-4 alert-success"  style="border: 1px solid darkgray">
                        <h4>Estado: <span style=" padding: 6px 10px; display: inline-block; margin: -5px 0 0 0; float: right;">{{$tramite->estatus->pasado}}</span></h4>
                    </div>
                @endif
            </div>
            <br/>
            <br/>
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
                        <h4><span style="color: #333; width: 160px; display: inline-block; text-align: right;">Nombre:</span> <span style="color: #808080;">{{$tramite->solicitante->nombres}}</span></h4>
                        @if($tramite->tipo_solicitante == 'FISICA')
                            <h4><span style="color: #333; width: 160px; display: inline-block; text-align: right;">Apellido Paterno:</span>  <span style="color: #808080;">{{$tramite->solicitante->apellido_paterno}} </span></h4>
                            <h4><span style="color: #333; width: 160px; display: inline-block; text-align: right;">Apellido Materno:</span>  <span style="color: #808080;">{{$tramite->solicitante->apellido_materno}} </span></h4>
                            <h4><span style="color: #333; width: 160px; display: inline-block; text-align: right;">CURP:</span> <span style="color: #808080;">{{$tramite->solicitante->curp}}</span>  </h4>
                        @endif
                        <h4><span style="color: #333; width: 160px; display: inline-block; text-align: right;">RFC:</span> <span style="color: #808080;">{{$tramite->solicitante->rfc}} </span></h4>
                    @if($tramite->notaria)
                            <h4><span style="color: #333; width: 160px; display: inline-block; text-align: right;">Notaría:</span> <span style="color: #808080;">{{$tramite->notaria->nombre}} @if($tramite->notaria->mpio) de {{$tramite->notaria->mpio->nombre_municipio}} @endif </span></h4>
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
    </div>




                <!-- Modal -->
                <div class="modal fade modal-tramites" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog wrapper" role="document" style="width: 90%; min-height:90%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">{{$title_section}} Folio: {{$anio}}/{{$municipio}}/{{sprintf("%06d",$folio)}}</h4>
                            </div>
                            <div class="modal-body">
                <iframe id="ifrcallback" style="width: 100%; " frameBorder="0" class="wrapper"></iframe>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>

@stop

@section('javascript')
    {{ HTML::script('js/select2/select2.min.js') }}
    {{ HTML::script('js/select2/i18n/es.js') }}

    <script>

        var callbacks = {{json_encode($callbacks)}}

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
                if($(this).val() == 2 || $(this).val() == 9) {
                    $('#observaciones').show();
                    return true;
                }
                //Si el tipo de actividad es iniciar un subtrámite entonces se muestra el selector de tiposdetramite
                if($(this).val() == 7){
                    $("#select-tipotramites").show();
                    return true;
                }

                //Vemos si hay alguna forma que mostrar o hacer algun redirect
                if(callbacks[$(this).val()]){
                    var urlCallback = callbacks[$(this).val()];
                    var tramite_id = $('#tramite_id').val();
                    var tipoactividad_id = $(this).val();
                    var depto_id = $("#departamento_id").val();
                    $('#ifrcallback').attr('src','/'+urlCallback+'?tramite_id='+tramite_id+'&tipoactividad_id='+tipoactividad_id+'&depto_id='+depto_id);
                    $('.modal-tramites').modal();
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

            $(".comentarios_chb").change(function () {
                if($(this).is(':checked')){
                    $("#comentarios-div").show();
                    setTimeout(function()
                        {
                            $("#comentarios").focus();
                        },
                    150);
                }
                else{
                    $("#comentarios-div").hide();
                }
            });

            //Default
            if($(".comentarios_chb").is(':checked')) {
                $("#comentarios-div").show();
            }

            //Buscamos todos los getters de los callbacks en los tipos de actividad que lo tengan y cargamos asincronamente esas pantallas
            $('iframe').load(function () {
                acomodaIframes($(this));
            });


            acomodaIframes = function(iframe) {
                var $iframe = $(iframe);
                var height = $iframe.contents().find('.container').height();
                $iframe.height(height);
            }

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href") // activated tab
                if(target =='#panel-historial'){
                    $('iframe').each(function(){
                        acomodaIframes($(this));
                    });

                }
            });

        });

        //Escucha los mensajes de los iframes de actividades modulares.
        $(window).on('message', receiveMessage);
        function receiveMessage(evt)
        {
            window.location.reload();
        }

    </script>

@append

