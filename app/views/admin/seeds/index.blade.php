@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Ejecutar seeder en servidor:
                <small>{{$environment}}</small>
            </h4>
        </div>
        <div class="panel-body">

            <div class="container-fluid">
                <div class="col-sm-4">
                    {{ Form::open(array('url' => 'admin/ejecuta-seeds', 'method' => 'POST')) }}

                    <br>

                    <div class="row">

                        <div class="form-group">
                            {{Form::label('class','Indica la clase del seed a ejecutar')}}
                            {{Form::text('class', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required'=>'true'] )}}
                            {{$errors->first('class', '<span class=text-danger>:message</span>')}}
                            <p class="help-block">Es el nombre de la clase, no el nombre del archivo.</p>
                        </div>

                        <div class="form-actions form-group">
                            {{ Form::submit('Ejecutar seed', array('class' => 'btn btn-primary')) }}
                            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
                        </div>

                    </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>



@stop
