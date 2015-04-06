@extends('layouts.default')

@section('title')
    Bienvenido :: @parent
@stop

@section('content')

    <div class="page-header">
        <h2>Bienvenid@
            <small>{{Auth::user()->nombreCompleto()}}</small>
        </h2>
    </div>

    <div class="row">

        <div class="col-sm-6">

            <div class="col-lg-3 col-md-6">
                <a class="btn btn-primary" href="{{URL::to('ventanilla/primera-atencion')}}" role="button">
                    <span class="glyphicon glyphicon-plus"></span> Iniciar trámite
                </a>
            </div>

        </div>

        @include('ventanilla._form_buscador')

    </div>

    @include('ventanilla._lista_tramites',['tramites' => Tramite::orderBy('created_at','desc')->paginate(10)])
@stop
