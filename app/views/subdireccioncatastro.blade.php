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
        <div class="col-sm-6"></div>
        @include('ventanilla._form_buscador')

    </div>
    @include('ventanilla._lista_tramites',[
        'tramites' => Tramite::involucrado( Auth::id(), Auth::user()->roleIdArray(), Auth::user()->municipioIdArray() )->orderBy('created_at','desc')->paginate(10)
    ])
@stop
