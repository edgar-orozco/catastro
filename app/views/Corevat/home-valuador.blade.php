@extends('layouts.default')

@section('title')
    Bienvenido :: @parent
@stop

@section('content')
    <h2 class="title-module">Módulo de Peritos Valuadores</h2>
    <div class="page-header">
        <h2>Bienvenid@
            <small>{{Auth::user()->nombreCompleto()}}</small>
        </h2>
    </div>

    <div class="row">

        <div class="col-lg-3 col-md-6">
            <a href="{{URL::to('corevat/Avaluos/create')}}" class="panel panel-info" style="border:none; display: inline-block;">
                <div class="panel-heading" style="background:orange; color:white;">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-th-list gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div style="text-align: right; font-size: 24px; padding-left: 3px;">Registro de Avalúos</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer" style="background: #C58002; color:white;">
                    <span class="pull-left">Registrar avalúo</span>
                    <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="{{URL::to('corevat/Avaluos')}}" class="panel panel-info" style="border: none; display: inline-block;">
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
                <div class="panel-footer">
                    <span class="pull-left" style="text-align: right; font-size: 24px; padding-left: 3px;">Listar Avalúos</span>
                    <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>


    </div>
@stop
