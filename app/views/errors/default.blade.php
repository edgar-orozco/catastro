@extends('layouts.nosession')
@section('styles')
    <style>
        .panel-heading{
            width: 100%;
            max-width: 246px;
            margin: 0 auto;
        }
        .panel-heading img{
            width: 100%
        }
    </style>
@stop

@section('title')
    ERROR {{$code}} :: @parent
@stop

@section('content')

    <div class="row">
        <div class="">
            <div class="panel">
                <div class="panel-heading">
                    <img src="/css/images/main/logo-header.png">
                </div>
                <div class="panel-body">
                    <a href="javascript:window.history.back();" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
                    <br>
                    <div align="center" style="border:dashed thin silver;">
                        <h1>Error {{$code}}</h1>
                        <h2>Se ha presentado un error no definido.</h2>
                        <h4>{{date("Y-m-d H:i:s")}}</h4>
                        <h4>{{Request::getClientIp()}}</h4>
                    </div>
                    <div align="center">
                        <h4>Favor de reportar esta pantalla de error. Si no le es posible realizar una captura de pantalla copie el código de error y la fecha y hora que aparecen en el mensaje anterior</h4>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
