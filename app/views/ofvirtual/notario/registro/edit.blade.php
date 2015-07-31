@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    {{--{{ HTML::style('css/forms.css') }} --}}

<h1>Registro de escrituras</h1>


        <div class="row">

            {{ Form::model($registro, ['url' => array('ofvirtual/notario/registro/update', $registro->id ), 'method'=>'GET' ]) }}
                @include('ofvirtual.notario.registro._form', compact('registro'))

                <div class="form-actions form-group col-md-4" style="clear:both; float: right;">
                  {{ Form::submit('Guardar cambios en registro de dominio', array('class' => 'btn btn-primary')) }}
                </div>
            {{Form::close()}}

            {{ Form::model($registro, ['url' => array('ofvirtual/notario/registro-escrituras'), 'method'=>'GET' ]) }}
            <div class="form-actions form-group col-md-4" style="clear:both; float: right;">
              {{ Form::submit('No guardar cambios', array('class' => 'btn btn-warning')) }}
            </div>
        {{Form::close()}}



        </div>



@stop