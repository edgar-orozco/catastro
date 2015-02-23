@extends('layouts.default')

@section('styles')
    .alert {
        padding: 6px;
        margin-bottom: 0px;
    }
@append

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')
<form id="lista-tipotramites">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
        @foreach($tipotramites as $tipotramite)
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="heading-{{$tipotramite->id}}">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                           href="#collapse-{{$tipotramite->id}}" aria-expanded="false"
                           aria-controls="collapse-{{$tipotramite->id}}">
                            {{$tipotramite->nombre}}
                        </a>
                    </h4>
                </div>
                <div id="collapse-{{$tipotramite->id}}" class="panel-collapse collapse" role="tabpanel"
                     aria-labelledby="heading-{{$tipotramite->id}}">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <!-- Select clave o cuenta -->
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle select-busqueda"
                                                data-toggle="dropdown" aria-expanded="false">
                                            <span class="dropdown-label">Clave</span>
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu tipo-busqueda" role="menu">
                                            <li><a href="#" class="opcion-busqueda" data-tipo="clave">Clave</a></li>
                                            <li><a href="#" class="opcion-buqueda" data-tipo="cuenta">Cuenta</a></li>
                                        </ul>
                                    </div>
                                    <!-- //Select clave o cuenta -->
                                    <!-- Select municipios -->
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle select-municipio"
                                                data-toggle="dropdown" aria-expanded="false">
                                            <span class="dropdown-label">Municipio</span>
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu municipio" role="menu">
                                            <li><a href="#" class="opcion-municipio" data-tipo="008">Huimanguillo</a></li>
                                            <li><a href="#" class="opcion-municipio" data-tipo="009">Cárdenas</a></li>
                                        </ul>
                                    </div>
                                    <!-- //Select municipios -->
                                    <!-- /btn-group -->
                                    {{Form::text('clave', null, ['class'=>'form-control clave-catastral', 'style'=>'text-transform: uppercase;', 'data-tipotramite'=>$tipotramite->id] )}}
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <span class="glyphicon glyphicon-search boton-buscador" aria-hidden="true"></span>
                                        </button>
                                    </span>
                                </div>

                                <!-- /input-group -->
                            </div>
                            <!-- /col-md-4 -->
                            <div class="col-md-8">
                                <div class="alert alert-danger" style="display: none;">
                                    No se encontró el predio solicitado en el padrón.
                                </div>
                            </div>

                        </div>
                        <!-- /row input clave -->

                        <br/>
                        <!-- paneles info -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel panel-info">
                                    <a href="#">
                                        <div class="panel-footer">
                                            <span class="pull-left">Duración en días hábiles</span>

                                            <div class="clearfix"></div>
                                        </div>
                                    </a>

                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="glyphicon glyphicon-time gi-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">{{$tipotramite->tiempo}}</div>
                                                <div>Días</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="panel panel-info">
                                    <a href="#">
                                        <div class="panel-footer">
                                            <span class="pull-left">Costo</span>

                                            <div class="clearfix"></div>
                                        </div>
                                    </a>

                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="glyphicon glyphicon-usd gi-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">{{number_format($tipotramite->costodsmv * 66.45, 2)}}</div>
                                                <div>Pesos M.N.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /paneles-info -->

                            <!-- botones requisitos -->
                            <div class="col-md-6 requisitos-lista" id="requisitos-lista-{{$tipotramite->id}}"
                                 data-tipotramite_id="{{$tipotramite->id}}">
                                <ul>
                                    @foreach($tipotramite->requisitos as $requisito)
                                        <li>
                                            @include('ventanilla._form_requisitos',compact('tipotramite','requisito'))
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="form-actions form-group iniciar-tramite" data-tipotramite="{{$tipotramite->id}}" style="display: none;">
                                    <button class="btn btn-success" type="button">
                                        <i class="glyphicon glyphicon-ok"></i> Iniciar trámite
                                    </button>
                                </div>
                                <div class="form-actions form-group cancelar-tramite" data-tipotramite="{{$tipotramite->id}}" style="display: none;">
                                    <button class="btn btn-warning" type="reset">
                                        <i class="glyphicon glyphicon-remove"></i> Cancelar trámite
                                    </button>

                                </div>
                            </div>
                            <!-- /botones requisitos -->
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</form>

{{ Form::open(array('url' => 'ventanilla/iniciar-tramite', 'method' => 'GET', 'id'=>'iniciar')) }}
    {{ Form::hidden('clave',null, ['class'=>'clave', 'id'=>'clave']) }}
    {{ Form::hidden('cuenta',null, ['class'=>'cuenta', 'id'=>'cuenta']) }}
    {{ Form::hidden('tipotramite_id',null, ['class'=>'tipotramite_id']) }}
{{ Form::close() }}

    <!-- modal cargando -->
    <div class="modal" id="loading-modal" tabindex="-1" role="dialog" aria-labelledby="loading-modal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="confirm-logout-title">Cargando...</h4>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <!-- /modal cargando -->

@stop

@section('javascript')
    {{ HTML::script('js/laroute.js') }}
    {{ HTML::script('js/jquery/jquery.mask.min.js') }}
    {{ HTML::script('js/ventanilla/primera-atencion.js') }}
@append