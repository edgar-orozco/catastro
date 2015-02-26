@extends('layouts.default')

@section('title')
    {{{ $title }}} @parent
@stop

@section('angular')
    ng-app="app" ng-controller="ShapeCtrl" ng-init="initApp({{ ShapesHelper::serverUploadSize() }})"
@stop

@section('content')
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad"  >

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Actualizar Manzana</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        {{ Form::open(array('url' => 'admin/carga-shapes/upload', 'name' => 'uploadForm', 'files' => true)) }}
                        <div class="input-group col-xs-6">
                            <span class="input-group-addon" id="basic-addon1">Número de Manzana</span>
                            <input type="text" class="form-control" placeholder="___-____" aria-describedby="basic-addon1" />
                        </div>
                        <br>
                        <div class="form-group">
                            {{Form::label('shape','Selecciona el archivo empacado')}}
                            {{Form::file('shape', ['required' => 'required', 'bxd-file-size' => 'bxd-file-size'] )}}
                            <p class="help-block">
                                Las extensiones permitidas son .zip, .rar, .tar, .tgz y .gz.
                            </p>
                            <p class="help-block" ng-show="showErrorSize">
                                <span class="text-danger">El tamaño del archivo excede el tamaño máximo admitido por el servidor, intenta nuevamente.</span><br>
                                <span class="text-danger">Tamaño maximo admitido {{ ShapesHelper::formatBytes(ShapesHelper::serverUploadSize())  }}</span>
                            </p>
                        </div>
                        <div class="form-actions form-group text-right">
                            <button type="submit" class="btn btn-primary" ng-disabled="checkFile()">
                                Subir
                            </button>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    {{ HTML::script('js/cartographicLoad/cartographicLoad.js') }}
@stop


