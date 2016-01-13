@extends('layouts.default')
@section('styles')
@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Formulario para linea de captura</h3>
    </div>
    {{Form::open(['id' => 'WebService','target'=>'_blank'])}}
    <div class="panel-body ">
        <div class="col-md-7"> 
            {{Form::label('nombre','Nombre:')}}
            {{Form::text('nombre', null, ['class' => 'form-control'] )}}
        </div>

        <div class="col-md-7"> 
            {{Form::label('paterno','Apellido Paterno:')}}
            {{Form::text('paterno', null, ['class' => 'form-control'] )}}
        </div>

        <div class="col-md-7"> 
            {{Form::label('materno','Apellido Materno:')}}
            {{Form::text('materno', null, ['class' => 'form-control'] )}}
        </div>

        <!--	        <div class="col-md-7">
                          {{Form::label('folios_urbanos','Cantidad folios Urbanos:')}}
                          {{Form::text('folios_urbanos', null, ['class' => 'form-control'] )}}
                        </div>
                        <div class="col-md-7">
                          {{Form::label('folios_rusticos','Cantidad Folios Rusticos:')}}
                          {{Form::text('folios_rusticos', null, ['class' => 'form-control'] )}}
                        </div>-->
        <div class="col-md-7">
            {{Form::label('numero_oficio','Numero de oficio:')}}
            {{Form::text('numero_oficio', null, ['class' => 'form-control'] )}}
        </div>
        <div class="col-md-7">
            {{Form::label('observacion','Observación:')}}
            {{Form::text('observacion', null, ['class' => 'form-control'] )}}
        </div>

    </div>
    {{Form::submit('Generar',['class'=>'btn btn-primary btn-lg col-md-3 col-md-offset-4'])}}
    {{Form::reset('Limpiar Campos', ['class'=>'btn btn-primary btn-lg col-md-3 col-md-offset-4']) }}
 
    {{Form::close()}}
</div>
@stop
@section('javascript')
<script>
    $('#WebService').bind('submit',
            function(){
            $('#nombre').val();
                    $('#paterno').val();
                    $('#materno').val();
                    $('#numero_oficio').val();
                    $('#observacion').val();
            }
    );
</script>
@stop
