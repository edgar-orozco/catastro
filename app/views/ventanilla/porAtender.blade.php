@extends('layouts.default')

@section('title')
    Bienvenido :: @parent
@stop

@section('content')

    <div class="page-header">
        <h3>Bienvenid@</h3>
        <h4>{{Auth::user()->nombreCompleto()}}</h4>
    </div>

    <div class="row margin-null">

        <div class="col-md-4 paddin-null">
            <a class="btn btn-primary btn-actionForm01" href="{{URL::to('ventanilla/primera-atencion')}}" role="button">
                <span class="glyphicon glyphicon-plus"></span> Iniciar trámite
            </a>
        </div>
        <div class="col-md-8 paddin-null">
            @include('ventanilla._form_buscador', [
                'por_atender' => count(Tramite::porAtender(Auth::user()->roleIdArray())->get())
            ])
        </div>

    </div>

    @include('ventanilla._lista_tramites',[
        'tramites' => $tramites
    ])
@stop
