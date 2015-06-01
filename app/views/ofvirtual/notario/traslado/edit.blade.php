@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

{{ HTML::style('css/forms.css') }}



        <div class="row">

            {{ Form::model($traslado, ['url' => array('ofvirtual/notario/traslado/update', $traslado->id ), 'method'=>'GET' ]) }}
                @include('ofvirtual.notario.traslado._form', compact('traslado'))

                <div class="form-actions form-group col-md-4" style="clear:both; float: right;">
                  {{ Form::submit('Guardar cambios en traslado de dominio', array('class' => 'btn btn-primary')) }}
                </div>
            {{Form::close()}}


        </div>



@stop


