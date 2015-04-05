@extends('layouts.default')

@section('styles')
.alert {
padding: 6px;
margin-bottom: 0px;
}
@append

@section('title')
{{{ $title }}} :: @parent
@stop

@section('content')
<form id="lista-tipotramites">
    @if (Session::has('message'))
    {{--*/ $message = Session::get('message') /*--}}
    @if (!empty($message)) 
    @if (Session::get('isSuccess'))
    <div class="alert alert-success">{{ Session::get('message') }}</div>
    @else
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
    @endif
    @endif

    {{ Form::open(array('url' => 'registro/store')) }}
    <div class="form-group">
        {{ Form::label('inputName', 'Nombre') }}
        {{ Form::text('name', Input::old('name'), array(
                'id' => 'inputName',
                'class' => 'form-control'
            ))
        }}
        <p class="error">{{ $errors->first('name') }}</p>
    </div>

    <div class="form-group">
        {{ Form::label('inputEmail', 'Email') }}
        {{ Form::text('email', Input::old('email'), array(
                'id' => 'inputEmail',
                'class' => 'form-control'
            ))
        }}
        <p class="error">{{ $errors->first('email') }}</p>
    </div>

    <div class="form-group">
        {{ Form::label('inputPassword', 'Contraseña') }}

        {{ Form::password('password', array(
                'id' => 'inputPassword',
                'class' => 'form-control'
            ))  
        }}
        <p class="error">{{ $errors->first('password') }}</p>
    </div>

    <div class="form-group">
        {{ Form::label('inputPasswordConfirmation', 'Confirmar Contraseña') }}

        {{ Form::password('password_confirmation', array(
                'id' => 'inputPasswordConfirmation',
                'class' => 'form-control'
            ))  
        }}
        <p class="error">{{ $errors->first('password_confirmation') }}</p>
    </div>

    <div class="form-group">
        {{ $captchaHtml }}
    </div>

    <div class="row">
        <div class="form-group col-sm-4">
            {{ Form::label('CaptchaCode', 'Vuelva a escribir los caracteres de la imagen') }}

            {{ Form::text('CaptchaCode', null, array(
                    'id' => 'CaptchaCode',
                    'class' => 'form-control'
                ))
            }}

            <p class="error">
                @if (Session::has('captchaValidationStatus'))
                {{ Session::get('captchaValidationStatus') }}
                @endif
            </p>
        </div>
    </div>

    {{ Form::submit('Registrar', array('class' => 'btn btn-primary')) }}     
    {{ Form::close() }}

    @stop
</form>



<!-- modal cargando -->
<div class="modal" id="loading-modal" tabindex="-1" role="dialog" aria-labelledby="loading-modal"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="confirm-logout-title">Cargando...</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<!-- /modal cargando -->

@stop

@section('javascript')
{{ HTML::script('js/laroute.js') }}
{{ HTML::script('js/jquery/jquery.mask.min.js') }}
{{ HTML::script('js/ventanilla/primera-atencion.js') }}
@append