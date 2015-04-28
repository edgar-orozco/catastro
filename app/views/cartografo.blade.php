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
                            <i class="glyphicon glyphicon-cloud-upload gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ ShapesHelper::countShapes() }}</div>
                            <div>Archivos cargados</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('admin/carga-shapes')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Actualización Cartográfica</span>
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
                            <i class="glyphicon glyphicon-globe gi-5x"></i>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('cartografia/consultas')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Consulta Cartográfica</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>


    </div>
@stop