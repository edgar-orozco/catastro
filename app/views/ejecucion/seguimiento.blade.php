<?php
error_reporting (E_ERROR | E_WARNING);
setlocale(LC_MONETARY, 'es_MX');
?>
@extends('layouts.default')

@section('title')
Bienvenido :: @parent
@stop

@section('content')
<div>
    <div class="panel-default">

    <div class="panel-heading">

        <h3 class="panel-title">Busqueda de Predios</h3>

    </div>

</div>
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/theme.default.css') }}

    @section('javascript')
        <script>
        //mostrar  ocultatr vistaa
            function SINO(cual) {
            var elElemento=document.getElementById(cual);
            if(elElemento.style.display == 'block') 
            {
                elElemento.style.display = 'none';
                 } else {
                    elElemento.style.display = 'block';
                 }
            }
            //activar boton
        function validar(obj){
    var d = document.formulario;
    if(obj.checked==true){
        d.boton.disabled = false;
        d.date1.disabled = false;
    }else{
        d.boton.disabled= true;
        d.date1.disabled= true;
    }
}

        </script>


<script type="text/javascript">
    // jQuery
$(document).ready(function(){

    $('#alternar-respuesta-ej5').toggle(

        // Primer click
        function(e){
            $('#respuesta-ej5').slideDown();
            $(this).text('Ocultar respuesta');
            e.preventDefault();
        }, // Separamos las dos funciones con una coma

        // Segundo click
        function(e){
            $('#respuesta-ej5').slideUp();
            $(this).text('Ver respuesta');
            e.preventDefault();
        }

    );

});
</script>
@stop

    <div class="panel-body">
             {{ Form::open(array('class' => 'busquedas',
                    'role' => 'form',
                    'method'=>'SeguimientobusController@getIndex',
                    'method' => 'GET',
                    'url'=>'/busquedas'

                    ))
        }}

        <div class="input-group">
            <table class="table">
                <tr>
                    <th>{{Form::label('Clave Catastral:') }}</th>
                    <th>{{Form::label('Nombre Propietario:') }}</th>
                    <th>{{Form::label('Municipio:') }}</th>
                    <th>{{Form::label('Estatus:') }}</th>
                    <th>{{Form::label('Registros a mostrar:') }}</th>
                </tr>
                <tr>
                    <td>
            {{ Form::text('clave',null, array('class' => 'form-control focus', 'placeholder'=>'xx-xxx-xxx-xxxx-xxxxxx', 'autofocus'=> 'autofocus', 'pattern'=> '\d{2}[\-]\d{3}[\-]\d{3}[\-]\d{4}[\-]\d{6}'))  }}
                    </td>
                    <td>
            {{ Form::text('nombre',null, array('class' => 'form-control focus', 'placeholder'=>'Nombre')) }}
                    </td>


            {{$errors->first("predios")}}
                    <td>
            <select name="municipio" class="form-control"  >
            <option value=''>Elija un municipio...</option>
            @foreach($municipio as $row)
            <option value="{{$row->municipio}}">{{$row->nombre_municipio}}</option>
            @endforeach
        </select>
                    </td>
                    <td>
                   <select name="estatus" class="form-control"  >
            <option value=''>Elija un estatus...</option>
            @foreach($status as $row)
            <option value="{{$row->cve_status}}">{{$row->descrip}}</option>
            @endforeach
        </select>
                    </td>
                    <td>
            {{Form::select('paginado', array('10' => '10', '20' => '20', '30' => '30', '40' => '40', '50' => '50','60' => '60'))}}
                    </td>
                </tr>
                <tr>
                        <td>{{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}</td>
                        <td>{{ Form::reset('Limpiar', array('class' => 'btn btn-primary')) }} </td>
                </tr>
            </table>
            </div>
        <br/>
         <br>
        {{ Form::close() }}
    </div>
    <br>
    <br>
    <br>
    @if(count($vale) == 0)
        <div class="panel-body">
            <h3><p> {{$mensaje;}}</p></h3>


        </div>
    @endif
    @if(count($vale) > 0)
    {{ Form::open(array('url' => 'cartainv', 'method' => 'post', 'name' => 'formulario',  'target' => '_blank'))}}
    {{$date = new DateTime();}}

    <div class="panel-default">

    <div class="panel-heading">

        <h3 class="panel-title">Resultados de la busqueda</h3>
    </div>

    <table  id="myTable" class="table">
     <thead>
        <tr>
                <th width="100" ><P align="center">{{ Form::checkbox('checkMain', 'checkMain', false, array('name' => 'checktodos'))}}</P></th>
                <th width="500"><P align="center">Clave Catastral</P></th>
                <th width="700"><P align="center">Nombre Propietario</P></th>
                <th width="200"><P align="center">Municpio</P></th>
                <th width="500"><P align="center">Estatus</P></th>
                <th width="700"><P align="center">Fecha Inicio</P></th>
                <th width="350"><P align="center">Fecha Vencimiento</P></th>
                <th width="350"><P align="center"></P>--</th>
        </tr>
    </thead>
    <tbody>
        <tr>
       <div class="preload_users">
       </div>
           <?php $i=0;
           //print_r($vale);

            ?>

             @foreach ($vale as $key  )
            <?php $i++ ?>
                <?php $clave= str_replace('(', '',$key[0]);?>
                 <?php $nombre= str_replace('"', '',$key[1]); ?>
                 <?php $impuesto=$key[5]; ?>
                  <?php $valorcc= $key[6]; ?>
                  <?php $total=$impuesto+$valorcc ?>

            <td align="center">
             {{ Form::checkbox('clave'.$i, $clave.','.$nombre.','.$total, false, ['onclick'=>'validar(this)'], array('id' => 'checkAll'))}}
              <!--  <a href="hoja/{{$row->clave;}}/{{$row->nombre;}}/{{$row->municipio;}}/{{$row->impuesto;}}" class="btn btn-xs btn-info" title="Reimprimir">Generar Carta Invitación<i class="fa fa-file-text-o"></i></a>-->
            </td>
            <td align="center">
                <!-- CLAVE -->
                {{$clave;}}
            </td>
            <td align="center">
                <!-- NOMBRE -->
                {{$nombre;}}
            </td>
            <td align="center">
                <!-- MUNICIPIO -->
               {{$municipio=$key[2];}}
            </td>
            <td align="center">
                <!-- domicilio -->
               Estatus no viene en consulta
            </td>
            <td align="center">
                <!-- periodo -->
                Fecha Inicio indefinida
            </td>
            <td align="center">
               <!-- impuesto-->
               Fecha vencimiento Indefinida
            </td>
            <td align="center">
                <!-- Valor Catastral-->
                 <a href="{{ URL::action('complementarios_ComplementariosController@getPredio',$row->clave) }}" class="btn btn-warning nuevo" title="Editar Predio">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
            </td>
        </tr>

        @endforeach

    </tbody>
    </table>

   {{ $paginator->appends(Request::except('page'))->links() }}
</div>
</div>
<br>
<div>
{{Form::text('mun',$mun=$key[2],array('hidden'))}}
{{Form::label('Fecha Emision Carta Invitacion: ') }}
{{Form::input('date', 'date1', $date->format('d/m/Y') , array('disabled', 'required' ))}}

</div>
<div>
    {{Form::label('Ejecutores:') }}
    <select name="ejecutores" class="form-control">
            @foreach($catalogo as $row)
            <option value="{{$row->id}}">{{$row->nombre}}</option>
            @endforeach
    </select>
</div>
<br>
{{ Form::submit('Generar Carta Invitacion', array('class' => 'btn btn-primary', 'name' => 'boton', 'disabled')) }}
{{ Form::close() }}

 @endif

<br><br><br>
@stop