@extends('layouts.default')

@section('title')
    Bienvenido :: @parent
@stop

@section('content')

    <div class="page-header">
        <h2>Bienvenid@
            <small>{{Auth::user()->nombreCompleto()}}</small>
        </h2>
    </div>

    <div class="row">

        
        
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-th-list gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Carta Invitación</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('ejecuciones')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Carta Invitación</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-th-list gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Seguimiento Ejecución</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('seguimiento')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Seguimiento Ejecución</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-cloud-upload gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                           
                            <div>Carga Gasto Ejecución</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('ejecucion/cargaEjecucion')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Carga Gasto Ejecución</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>


        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-user gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Personal Ejecución</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('catalogos/ejecutores')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Personal Ejecución</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-list-alt gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Personal Ejecución</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('catalogos/salario')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Personal Ejecución</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-list-alt gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Índice de Precios</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('catalogos/inpc')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Índice de Precios</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-list-alt gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Catalogo Status</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('catalogos/status')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Catalogo Status</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-list-alt gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Configuracion Municipal</div>
                        </div>
                    </div>
                </div>
                 <a href="{{URL::to('catalogos/configuracion')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Configuracion Municipal</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        

    </div>
@stop
