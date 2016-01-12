@extends('layouts.default')

@section('title')
Bienvenido :: @parent
@stop

@section('content')
{{ HTML::style('css/forms.css') }}
<div class="page-header">
    <h2>Generar <small>Plano Acotado </small></h2>
</div>
@if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

@endif
<div class="panel-body">
   {{ Form::open(array('url'=> '/cartografia/planoacotado/', 'method'=>'get')) }}
    <div class="row">
        <div>
        <br/>
        <br/>
        <div class="input-group">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-search"></span>
            </span>
            {{ Form::text('cve_cat', null, array('class' => 'form-control focus  ', 'placeholder'=>'Clave Ó Cuenta Catastral', 'autofocus'=> 'autofocus', 'pattern' => '^[0-9]{2}[-]{1}[0-9]{3}[-]{1}[0-9]{3}[-]{1}[0-9]{4}[-]{1}[0-9]{6}$',  'required')) }}
        </div>
        <br/>
        <br/>
    </div>
    {{ Form::submit('Generar Plano Acotado', array('formtarget'=>'_blank','class' => 'btn btn-primary')) }}
    {{ Form::close() }}
        <div class="mensaje">

        </div>

    <div class="list-group" id="div-table">


    </div>
</div>


@stop

@section('javascript')
@stop