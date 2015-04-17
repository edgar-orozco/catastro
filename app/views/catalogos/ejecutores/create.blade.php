@extends('layouts.default')

@section('content')

<div class="row">
    <a href="{{URL::route('catalogos.ejecutores.index')}}" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

    <div class="col-md-4">

        {{ Form::open(array('id'=>'form','url' => 'catalogos/ejecutores', 'method' => 'POST', 'files' => true)) }}
        @include('catalogos.ejecutores._form')

        <div class="form-actions form-group">
            {{ Form::submit('Crear nuevo ejecutor', array('class' => 'btn btn-primary','tabindex'=>'5')) }} 
            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
        </div>
        {{Form::close()}}


    </div>

    <div class="col-sm-8 col-md-8 col-lg-8">

        @include('catalogos.ejecutores._list', compact('ejecutoress'))<!--_list -->
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Nuevo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" id="modalBody" >

            </div>
            <div class="modal-footer" id="modal-footer">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="quien" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" id="modalBody" >
                @include('catalogos.ejecutores.nombrador')
            </div>
            <div class="modal-footer" id="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- fin Modal -->
@stop
