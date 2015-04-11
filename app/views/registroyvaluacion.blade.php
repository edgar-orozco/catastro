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
        @include('ventanilla._form_buscador', [
            'por_atender' => count(Tramite::porAtender(Auth::user()->roleIdArray())->get())
        ])

    </div>

    @include('ventanilla._lista_tramites',[
        'tramites' => Tramite::involucrado( Auth::id(), Auth::user()->roleIdArray(), Auth::user()->municipioIdArray() )->orderBy('created_at','desc')->paginate(10)
    ])

@stop
