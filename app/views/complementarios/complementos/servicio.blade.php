@extends('layouts.default')
@section('title')
@stop
@section('content')
<style>
    #map-canvas {
        height: 30%;
        margin: 0px;
        padding: 0px
    }
</style>
{{ Form::open
        (
                array('url'=> '/cargar-servicios',)
        )
}}
<ul class="list-unstyled">
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Agua Potable
                <input type=checkbox name='opcion[]' value="1">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Luz 
                <input type=checkbox name='opcion[]' value="2">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Drenaje
                <input type=checkbox name='opcion[]' value="3">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Telefono
                <input type=checkbox name='opcion[]' value="4">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Pavimentacion
                <input type=checkbox name='opcion[]' value="5">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">TV por Cable
                <input type=checkbox name='opcion[]' value="6">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Satelital
                <input type=checkbox name='opcion[]' value="7">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Banquetas
                <input type=checkbox name='opcion[]' value="8">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Guarnicion
                <input type=checkbox name='opcion[]' value="9">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Transporte Publico
                <input type=checkbox name='opcion[]' value="10">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Alumbrado Publico
                <input type=checkbox name='opcion[]' value="11">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Recoleccion de Basura
                <input type=checkbox name='opcion[]' value="12">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Pavimento de Asfalto
                <input type=checkbox name='opcion[]' value="13">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Pavimento de Concreto
                <input type=checkbox name='opcion[]' value="14">  
            </label>
        </div>
    </li>
    <li>
        <div class="btn-group btn-toggle botones-requisitos" data-toggle="buttons">
            <label class="btn btn-sm btn-default">Pavimento Hidraulico
                {{ Form::checkbox('opcion[]', 15) }}
            </label>
        </div>
    </li>
</ul>
{{ Form::submit('Enviar', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
@stop