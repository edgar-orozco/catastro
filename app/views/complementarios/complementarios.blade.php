@extends('layouts.default')

@section('title')
Bienvenido :: @parent
@stop

@section('content')
<div>
    <h1>Captura de Datos Complementarios </h1>
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    <div class="panel-body">

        {{ Form::open(array(
                    'role' => 'form',
                    'method'=>'ComplementariosController@index',
                    'method' => 'GET',
                    'url'=>'/complementarios'
                    ))
        }}
        <div class="row">
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-search"></span>
                    </span>
                    {{ Form::text('b',null, array('class' => 'form-control focus', 'placeholder'=>'Buscar por...', 'autofocus'=> 'autofocus','ng-model' => 'b' )) }}

                </div><!-- /input-group -->
            </div>
        </div>

        {{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}

        @if(count($busqueda) == 0)
        <div class="panel-body">
            <p>No hay predios dados de alta actualmente en el sistema.</p>

        </div>
        @endif
        <div class="list-group">
            <table class="table">
                <thead>
                    <tr>
                        <td>Predios</td>
                        <td>Clave</td>
                        <td>Geom</td>
                        <td>Superficie Construccion </td>        
                        <td>Accion</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($busqueda as $row)
                    <tr>
                        <td>
                            <?php echo $row->gid; ?>
                        </td>
                        <td>
                            <?php echo $row->clave; ?>
                        </td>
                        <td>
                            <?php echo $row->superficie_terreno; ?>
                        </td>

                        <td>
                            <?php echo $row->superficie_construccion; ?>
                        </td>
                        <td nowrap>
                        <a href="{{ URL::action('complementarios_ComplementariosController@getPredio',$row->clave) }}" class="btn btn-warning" title="Editar Predio">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <?php  echo $busqueda->links(); ?>
    </div>
    @stop
