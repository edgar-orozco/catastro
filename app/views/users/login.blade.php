@extends('layouts.nosession')

@section('styles')
<style>
    .login {
        position: absolute;
        left: 50%;
        top: 50%;
        width: 350px;
        height: 200px;
        margin-left: -150px;
        margin-top: -150px;
    }
    .panel-title {
        font-size: 24px;
    }
</style>
@stop
{{Session::get('main.menu')}}
@section('content')

<div class="row">
    <div class="login">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Sistema de Gestión Catastral</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url' => 'users/login', 'method' => 'POST')) }}

                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </span>
                        {{ Form::text('username', null, array('class' => 'form-control focus', 'placeholder'=>'Nombre de usuario', 'autofocus'=> 'autofocus')) }}
                    </div>

                    <br/>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                        </span>
                        {{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'Contraseña')) }}
                    </div>

                    <br/>

                    {{ Form::submit('Entrar al sistema', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop