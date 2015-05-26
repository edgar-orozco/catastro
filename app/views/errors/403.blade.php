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
    ERROR 403 :: @parent
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
                    <div align="center">
                        <h1>Error 403</h1>
                        <h2>No está autorizado para acceder a éste contenido.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop