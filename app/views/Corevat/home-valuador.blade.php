@extends('layouts.default')

@section('title')
    Bienvenido :: @parent
@stop

@section('content')
    <h2 class="title-module">Módulo de Peritos</h2>
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
                            <div class="huge"></div>
                            <div>Registro de Avalúos</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('corevat/Avaluos/create')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Registrar avalúo</span>
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
                            <i class="glyphicon glyphicon-eye-open gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Listado de avalúos</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('corevat/Avaluos')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Listar Avalúos</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>


    </div>
@stop
