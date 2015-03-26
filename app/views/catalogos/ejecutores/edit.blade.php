@extends('layouts.default')

@section('title')
{{{ $title }}} :: @parent
@stop

@section('content')

<div class="row">
    <a href="{{URL::route('catalogos.ejecutores.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

    <div class="col-md-4">
        <!--Boton Modal -->    
        <button data-toggle="modal"  data-target="#Nuevo" href="/catalogos/personas" class="btn btn-primary" >NUEVA PERSONA</button>
        <!--Fin Boton Modal -->
        {{ Form::model($ejecutores, ['route' => array('catalogos.ejecutores.update', $ejecutores->id_ejecutor ), 'method'=>'put' ]) }}

        @include('catalogos.ejecutores._form')
<a data-toggle="modal"  data-target="#quien"  href="/catalogos/nombrador">
            <span class="glyphicon glyphicon-plus"></span>
        </a>
        <div class="form-actions form-group">
            {{ Form::submit('Modificar Ejecutores', array('class' => 'btn btn-primary')) }}
            <a href="{{URL::route('catalogos.ejecutores.index')}}" class="btn btn-warning" role="button"> Cancelar</a>
        </div>
        {{Form::close()}}

    </div>

    <div class="col-sm-8 col-md-8 col-lg-8">

        @include('catalogos.ejecutores._list', compact('ejecutoress'))

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" id="modalBody" >

            </div>
            <div class="modal-footer" id="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- fin Modal -->
<div class="modal fade" id="quien" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" id="modalBody" >

            </div>
            <div class="modal-footer" id="modal-footer">

            </div>
        </div>
    </div>
</div>
@stop