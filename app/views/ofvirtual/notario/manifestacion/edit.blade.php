<!-- @extends('layouts.default') -->

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    {{--{{ HTML::style('css/forms.css') }} --}}

    <div class="row">

        {{ Form::model($manifestacion, ['action' => array('manifestacion.edit', $manifestacion->id ), 'method'=>'PUT', 'id'=>'formManifestacion' ]) }}

        @include('ofvirtual.notario.manifestacion._form', compact('manifestacion') )

        <div class="form-actions form-group col-md-6" style="clear:both; ">
            {{ Form::submit('Actualizar Manifestación Catastral', array('class' => 'btn btn-primary', 'id'=>'btn-sumbit-manifestacion')) }}
            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
        </div>
        {{Form::token() }}
        {{Form::close()}}

    </div>


@stop
