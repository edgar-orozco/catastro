@extends('layouts.default')

@section('title')
    {{{ $title }}} @parent
@stop

@section('angular')
    ng-app="app" ng-controller="ShapeCtrl" ng-init="initApp({{ ShapesHelper::serverUploadSize() }})"
@stop

@section('content')
    @if(Session::has('logHead'))
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 toppad"  >
    @else
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad"  >
    @endif

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Actualizar Manzana</h3>
            </div>
            @if(Session::has('logHead'))
                <div class="alert alert-notice">
                    <h4><span class="glyphicon glyphicon-info-sign"></span>  {{ Session::get('logHead') }}</h4>
                </div>
                @if(strlen(Session::get('logErr')) > 0)
                <div class="alert alert-danger">
                    <h4><span class="glyphicon glyphicon-remove"></span>  {{ Session::get('logErr') }}</h4>
                </div>
                @endif
                @if(strlen(Session::get('logWar')) > 0)
                <div class="alert alert-warning">
                    <h4><span class="glyphicon glyphicon-alert"></span>  {{ Session::get('logWar') }}</h4>
                </div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class=" text-right">
                                <a href="{{URL::to('admin/carga-shapes')}}" class="btn btn-mini btn-primary">Regresar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            {{ Form::open(array('url' => 'admin/carga-shapes/upload', 'name' => 'uploadForm', 'files' => true)) }}
                            <div class="input-group col-xs-6">
                                {{Form::label('municipio','Municipio')}}
                                <select id="municipio" name="municipio" size="1" style="width: 100%;">
                                    <option value="000"> Seleccione... </option>
                                    @foreach($municipios as $municipio => $nombre)
                                        <option value="{{$municipio}}"> {{$nombre}} </option>
                                    @endforeach
                                </select>                                  
                            </div>
                            <br>
                            <div class="input-group col-xs-6">
                                <span class="input-group-addon" id="basic-addon1">Número de Manzana</span>
                                <input name="manzana" type="text" class="form-control" placeholder="___-____" aria-describedby="basic-addon1" />
                            </div>
                            <br>
                            <div class="form-group">
                                {{Form::label('shape','Selecciona el archivo empacado')}}
                                {{Form::file('shape', ['required' => 'required', 'bxd-file-size' => 'bxd-file-size'] )}}
                                <p class="help-block">
                                    La extensión permitida es .zip
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
            @endif
        </div>
    </div>
@stop

@section('javascript')
    {{ HTML::script('js/cartographicLoad/cartographicLoad.js') }}
@stop


