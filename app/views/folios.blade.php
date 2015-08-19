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
            <a href="{{URL::to('/nfolios')}}" class="panel panel-info" style="display:block;">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-th-list gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Nuevo Folio</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <span class="pull-left">Nuevo Folio</span>
                    <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <a href="{{URL::to('/foliosemitidos')}}" class="panel panel-info" style="display:block;">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-lock gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Folios Emitidos</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <span class="pull-left">Folios Emitidos</span>
                    <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="{{URL::to('/entregafoliosmunicipal')}}" class="panel panel-info" style="display:block;">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-user gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                           
                            <div>Folios Autorizados</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <span class="pull-left">Folios Autorizados</span>
                    <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="{{URL::to('/entregafoliosestatal')}}" class="panel panel-info" style="display:block;">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-open gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Entrega Folios Estatal</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <span class="pull-left">Entrega Folios Estatal</span>
                    <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="{{URL::to('catalogos/peritos/tablaperitos')}}" class="panel panel-info" style="display:block;">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-tags gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            
                            <div>Peritos</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <span class="pull-left">Peritos</span>
                    <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
@stop
