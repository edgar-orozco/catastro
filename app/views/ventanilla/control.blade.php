@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    <div class="row clearfix">
        @if($folio)
            <div class="col-md-2 col-md-offset-7">
                <h4>Folio: {{$folio}}</h4>
            </div>

            <div class="col-md-3">
                <h4>Estado: <span class="alert alert-success">{{$estado}}</span></h4>
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

                    <div class="pull-right">
                        {{Form::label('tipo_persona','Tipo de persona', ['class'=>''])}}
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-default active">
                                <input type="radio" name="tipo_persona" class="radio-persona"
                                       value="F" checked> Física
                            </label>
                            <label class="btn btn-sm btn-default">
                                <input type="radio" name="tipo_persona" class="radio-persona"
                                       value="M"> Moral
                            </label>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group clearfix">
                        {{Form::label('nombres','Nombre', ['class'=>''])}}
                        {{Form::text('nombres', null, ['class' => 'form-control'] )}}
                    </div>
                    <span class="campos-fisica">
                        <div class="form-group">
                            {{Form::label('apellido_paterno','Apellido Paterno', ['class'=>''])}}
                            {{Form::text('apellido_paterno', null, ['class' => 'form-control'] )}}
                        </div>
                        <div class="form-group">
                            {{Form::label('apellido_materno','Apellido Materno', ['class'=>''])}}
                            {{Form::text('apellido_materno', null, ['class' => 'form-control'] )}}
                        </div>
                        <div class="form-group">
                            {{Form::label('curp','CURP', ['class'=>''])}}
                            {{Form::text('curp', null, ['class' => 'form-control', 'minlength'=>'18', 'maxlength'=>'18'] )}}
                        </div>

                    </span>

                    <div class="form-group">
                        {{Form::label('rfc','RFC', ['class'=>''])}}
                        {{Form::text('rfc', null, ['class' => 'form-control', 'minlength'=>'12', 'maxlength'=>'13'] )}}
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
                <button type="submit" class="btn btn-success">
                    <i class="glyphicon glyphicon-arrow-right"></i>
                    Continuar trámite
                </button>
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
                        @foreach($requisitos as $requisito)
                            <div class="form-group">
                                {{ Form::label('documento['.$requisito->id.']', $requisito->nombre) }}

                                {{ Form::file('documento['.$requisito->id.']', ['class'=>'form-control']) }}
                                {{$errors->first('documento['.$requisito->id.']', '<span class=text-danger>:message</span>')}}
                                {{Form::hidden('requisito_ids[]',$requisito->id) }}
                            </div>
                        @endforeach


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