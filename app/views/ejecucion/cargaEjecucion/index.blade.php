@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

</style>
@section('content')
    <div class="col-md-5">
        
              
            {{ Form::open(array('url' => 'ejecucion/cargaEjecucion', 'method' => 'POST', 'class' => 'register_ajax', 'files' => true)) }}

                @include('ejecucion.cargaEjecucion._form')
                <p align="left"> Para realizar de forma masiva las invitaciones de ejecución, agregar en un archivo de texto plano las claves catastrales correspondientes, una por línea, seleccionar el archivo y enviarlo. <a href="" data-toggle="modal" data-target="#myModal">Ver formato</a></p>
                     
                <div class="form-actions form-group" id="form-boton" hidden="hidden">
                    <button id ="boton" type="submit" class="btn btn-info">
                        <i class="glyphicon glyphicon-plus"> </i>
                        Validar Claves
                    </button>
                </div>

            {{Form::close()}}

    </div>

        <div class="col-md-6">
            <div align="center"class='preload_users'>
                  <!--aquí se mostrará spin mientras procesa el archivo cargado-->
            </div>
            <br>
            <div align="left" class='load_ajax'>
                <!--aquí se mostrará total de errores, total aprobados y boton de descarga con las lineas de error-->
            </div>
            <div>
                
            </div>
            <br>
            <div align="left" class='carta'>
                <!--aquí se mostrará total de errores, total aprobados y boton de descarga con las lineas de error-->
            </div>
        </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>

          <div class="modal-body" id="modalBody">

          <!--Aqui se carga el PDF en la pantalla modal-->
          <img src="/css/images/ejecucionFiscal/carga_masiva_formato.jpg" width="580" height="500">

          </div>

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



