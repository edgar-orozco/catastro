@extends('layouts.default')

@section('styles')

.panel{
       	max-width: 800px; / change according to your requirement/
}
.center {
     float: none;
     margin-left: auto;
     margin-right: auto;
}
@stop

@section('content')

	<div class="panel panel-default center">
  		<div class="panel-heading">Orden</div>
              <table class="table">
          <thead>
            <tr>
              <th>Id</td>
              <th>No. Orden</td>
              <th>Nombre</td>
              <th>Monto</td>
              <th>Municipio</td>
              <th>Status</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$orden['id']}}</td>
              <td><a href="/cajas/{{$orden['id']}}/edit">{{$orden['no_orden']}}</a></td>
              <td>{{$orden['nombre']}}</td>
              <td>{{$orden['monto']}}</td>
              <td>{{$orden['municipio']}}</td>
              <td>
                <div class="checkbox">
                <label>
                  <input type="checkbox" value=""{{$orden['status']==='1'?'checked':''}} > Activar
                </label>
                
              </td>
            </tr>
          </tbody>
        </table>
  		<div class="panel-body">
    		{{Form::open(['action'=>['Cajas_CajasController@update', $orden['id']]])}}
          
          {{Form::Label('nombre', 'Nombre')}}
          {{Form::Text('Nombre', null, ['class'=>'form-control'])}}

          {{Form::Label('apellido_Paterno', 'Apellido paterno')}}
          {{Form::Text('apellido_paterno', null, ['class'=>'form-control'])}}

          {{Form::Label('apellido_materno', 'Apellido materno')}}
          {{Form::Text('apellido_materno', null, ['class'=>'form-control'])}}

          {{Form::Label('domicilio', 'Domicilio')}}
          {{Form::Text('domicilio', null, ['class'=>'form-control'])}}

        <br>
        <button class="btn btn-primary" type="submit">
          <i class="glyphicon glyphicon-arrow-right"></i>
          Continuar
        </button>

        {{Form::Close()}}
        </div>
	</div>
@stop