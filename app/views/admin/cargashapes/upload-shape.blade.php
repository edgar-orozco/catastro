@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Subir archivo</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        {{ Form::open(array('url' => 'admin/carga-shapes/upload', 'name' => 'uploadForm', 'files' => true)) }}
                        <div class="form-group">
                            {{Form::label('shape','Selecciona un archivo')}}
                            {{Form::file('shape', null, ['class'=>'form-control', 'required' => 'required'] )}}
                            <p class="help-block">
                                Las extensiones permitidas son .zip, .rar, .tgz y .gz.
                            </p>
                        </div>
                        <div class="form-actions form-group text-right">
                            {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

