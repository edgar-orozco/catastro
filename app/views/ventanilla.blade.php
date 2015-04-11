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

        <div class="col-sm-4">

            <div class="col-lg-2 col-md-4">
                <a class="btn btn-primary" href="{{URL::to('ventanilla/primera-atencion')}}" role="button">
                    <span class="glyphicon glyphicon-plus"></span> Iniciar trámite
                </a>
            </div>

        </div>
        <div class="col-sm-8">
            @include('ventanilla._form_buscador', [
                'por_atender' => count(Tramite::porAtender(Auth::user()->roleIdArray())->get())
            ])
        </div>

    </div>

    @include('ventanilla._lista_tramites',[
        'tramites' => Tramite::involucrado( Auth::id(), Auth::user()->roleIdArray(), Auth::user()->municipioIdArray() )->orderBy('created_at','desc')->paginate(10)
    ])
@stop
