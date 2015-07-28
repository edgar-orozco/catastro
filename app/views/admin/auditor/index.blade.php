
@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('angular')
    ng-app="app" ng-controller="AuditorCtrl" ng-init="initApp()"
@stop

@section('content')
    {{ HTML::style('css/forms.css') }}
    {{ HTML::style('css/select2.min.css') }}
    {{ HTML::style('css/dataTables/dataTables.css') }}
    {{ HTML::style('css/dataTables/datatables.responsive.css') }}
    <style>
        .mt20{
            margin-top:20px;
        }
        .mt10{
            margin-top:10px;
        }
        .select2-container--default{
            width: 100% !important;
        }
        .input-group button{
            width: 40px;
        }
        .fechas .col-xs-6, .fechas .col-xs-12{
            padding: 0;
        }
        .fecha-inicio{
            padding-right: 5px !important;
        }
        .fecha-fin{
            padding-left: 5px !important;
        }
        .calendar .dropdown-menu li.ng-scope span.btn-group{
            padding-top: 0 !important;
        }
        .calendar .dropdown-menu .btn-danger, .calendar .dropdown-menu .btn-success{
            width: 60px;
        }
    </style>
    <div class="row" id="auditor" style="display: none;">
        @include('admin.auditor._filtros')
    </div>

    <div class="mt20"></div>

    <div class="row">
        @include('admin.auditor._listado', compact('actividades'))
    </div>
@stop


@section('javascript')
    {{ HTML::script('js/angular/angular-locale_es-mx.js') }}
    {{ HTML::script('js/dataTables/jquery.dataTables.js') }}
    {{ HTML::script('js/dataTables/dataTables.responsive.js') }}
    {{ HTML::script('js/dataTables/dataTables.bootstrap.js') }}
    {{ HTML::script('js/select2/select2.min.js') }}
    {{ HTML::script('js/auditor/auditor.js') }}
    {{ HTML::script('js/laroute.js') }}
@stop

