@extends('layouts.default')



{{ HTML::style('js/jquery/jquery-ui.css') }}

@section('title')
{{{ $title}}} :: @parent
@stop

@section('angular')
ng-app="statuss" ng-controller="StatusCtrl"
@stop

@section('content')
<div class="row">
    <button type="button" class="btn btn-info" ng-click="openForm()" ng-hide="showForm">
        <i class="glyphicon glyphicon-plus"></i> Crear Status
    </button>
    <button type="button" class="btn btn-primary pull-right" ng-click="closeForm()" ng-show="showForm">
        <i class="glyphicon glyphicon-arrow-left"></i> Regresar
    </button>
</div>


<div class="row">
    <div ng-class="showForm ? 'col-sm-4 col-md-4 col-lg-4 resize' : ''" ng-show="showForm">

        {{ Form::open(array('url' => 'catalogos/status', 'method' => 'POST', 'name' => 'formStatus')) }}

        @include('catalogos.status._form')

        <div class="form-actions form-group">
            <button disabled="disabled" class="btn btn-primary" ng-disabled="formStatus.$invalid || isInvalid()" type="button" ng-click="store()">
                {[{ status.id_status!== undefinied ? 'Editar status' : 'Crear nuevo status' }]}
            </button>
            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
        </div>
        {{Form::close()}}

    </div>
    <div ng-class="showForm ? 'col-sm-8 col-md-8 col-lg-8' : 'col - sm - 12 col - md - 12 col - lg - 12 resize'">
        @include('catalogos.status._list', compact('statuss'))
    </div>
</div>
@stop

@section('javascript')
{{ HTML::script('js/catalogos/status.js') }}
{{ HTML::script('js/laroute.js') }}
{{ HTML::script('js/jquery/jquery-ui.js') }}
<script>
//Calendario
$(function() {
    $( ".date-picker" ).datepicker();
  });
//Cambiar a español el calendario
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha").datepicker();
});
</script>
@append

