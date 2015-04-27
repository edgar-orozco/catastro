@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')
    <div class="row show-grid">
        <div class="span3">
              
            {{ Form::open(array('url' => 'ejecucion/cargaEjecucion', 'method' => 'POST', 'class' => 'register_ajax', 'files' => true)) }}

                @include('ejecucion.cargaEjecucion._form')
                     
                <div class="form-actions form-group" id="form-boton" hidden="hidden">
                    <button id ="boton" type="submit" class="btn btn-info">
                        <i class="glyphicon glyphicon-plus"> </i>
                        Validar Claves
                    </button>
                </div>

            {{Form::close()}}
        </div>
    </div>
    <div class="row show-grid">
        <div class="span 4">
            <div class='preload_users'>
                  <!--aquí se mostrará spin mientras procesa el archivo cargado-->
            </div>
            <div class='load_ajax'>
                <!--aquí se mostrará total de errores, total aprobados y boton de descarga con las lineas de error-->
            </div>
        </div>
    </div>

    <div class="container" hidden="hidden" id="form-group">

        {{Form::label('label_fecha', 'Fecha Emision Carta Invitacion: ', array('class'=>'col-md-2')) }}
        {{Form::input('date', 'date1', null, array('required', 'class'=>'col-md-2' ))}}
        {{Form::label('label_ejecutores', 'Ejecutores:', array('class'=>'col-md-1')) }}

    </div>


        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
     

 
@stop

@section('javascript')
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    {{ HTML::script('js/ejecucion/ajax.js') }}
@stop



