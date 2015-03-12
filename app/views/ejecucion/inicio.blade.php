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
                    var elElemento =document.getElementById(cual);
                    if(elElemento.style.display == 'block')
                        {
                             elElemento.style.display = 'none';
                        } else {
                            elElemento.style.display = 'block';
                        }
                        }
                    //activar boton los ementos bloquedos
                    function validar(obj){
                    var d                 = document.formulario;
                    if(obj.checked        ==true)
                    {
                        d.boton.disabled      = false;
                        d.date1.disabled      = false;
                        d.ejecutores.disabled = false;
                    }else
                        {
                        d.boton.disabled      = true;
                        d.date1.disabled      = true;
                        d.ejecutores.disabled = true;
                        }
                        }
                </script>

<script>
            //actualiza el paginado cuando se cambia el numero de registros a mostrar
            $('#pagi').on('change', function()
                {
                   document.getElementById('paginado').value = document.getElementById('pagi').value;
                   document.busqueda.submit();
                });
</script>

<script type="text/javascript">
    // funcion para saleccionar todos los registos y desbolquear elementos bloqueados
$(document).ready(function(){
   var d = document.formulario;
    //Checkbox seleccionar todos
    $("input[name=checktodos]").change(function(){
        $('input[type=checkbox]').each( function() {
            if($("input[name=checktodos]:checked").length == 1){
                this.checked = true;
                d.boton.disabled = false;
                d.date1.disabled = false;
                d.ejecutores.disabled = false;
            } else {
                this.checked = false;
                d.boton.disabled = true;
                d.date1.disabled = true;
                d.ejecutores.disabled = true;
            }
        });
    });

});
</script>
@stop

<div class="panel-body">
    {{ Form::open(array(
        'class'  => 'busqueda',
        'role'   => 'form',
        'method' => 'BuscarController@index',
        'method' => 'GET',
        'url'    =>'/ejecucion',
        'name'   =>'busqueda'
     )) }}

        <div class="input-group">
            <table class="table">
                <tr>
                    <th>{{Form::label('Clave Catastral:') }}</th>
                    <th>{{Form::label('Nombre Propietario:') }}</th>
                    <th>{{Form::label('Mayor a:') }}</th>
                    <th>{{Form::label('Menor a:') }}</th>
                    <th>{{Form::label('Municipio:') }}</th>
                    <th>{{Form::label('Años de Adeudo:') }}</th>
                    <th>{{Form::label('paginado','Registros a mostrar:') }}</th>
                </tr>
                <tr>
                    <td>
                        {{ Form::text('clave',null, array('class' => 'form-control focus', 'placeholder'=>'xx-xxx-xxx-xxxx-xxxxxx', 'autofocus'=> 'autofocus', 'pattern'=> '\d{2}[\-]\d{3}[\-]\d{3}[\-]\d{4}[\-]\d{6}'))  }}
                    </td>
                    <td>
                        {{ Form::text('nombre',$propietario, array('class' => 'form-control focus', 'placeholder'=>'Nombre')) }}
                        {{ Form::number('paginado',10, array('id'=>'paginado', 'hidden')) }}
                    </td>
                    <td>
                        {{ Form::number('mayor',null, array('class' => 'form-control focus', 'placeholder'=>'Mayor a :'))  }}
                    </td>
                    <td>
                        {{ Form::number('menor',null, array('class' => 'form-control focus', 'placeholder'=>'Menor a :'))  }}
                    </td>
                        {{$errors->first("predios")}}
                    <td>
                        <select name="municipio" class="btn btn-default btn-sm dropdown-toggle">
                            <option value=''>Elija un municipio...</option>
                                @foreach($municipio as $row)
                                    <option value="{{$row->municipio}}">{{$row->nombre_municipio}}</option>
                                @endforeach
                        </select>
                    </td>
                    <td>
                        {{Form::select('adeudos', array('1' => '1', '1' => '1', '3' => '3', '4' => '4', '5' => '5'),array('class'=>'btn btn-default btn-sm dropdown-toggle'))}}
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>{{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}</td>
                    <td>{{ Form::reset('Limpiar', array('class' => 'btn btn-primary')) }} </td>
                </tr>
            </table>
        </div>
    {{ Form::close() }}
</div>
            @if(count($items) == 0)
                <div class="panel-body">
                    <h3>
                        <p>
                            {{$mensaje;}}
                        </p>
                    </h3>
                </div>
            @endif
    @if(count($items) > 0)
    {{ Form::open(array('url' => 'cartainv', 'method' => 'post', 'name' => 'formulario',  'target' => '_blank'))}}
    {{$date = new DateTime();}}

    <div class="panel-default">

    <div class="panel-heading">
            <h3 class="panel-title">Resultados de la busqueda</h3>
        {{Form::label('pagi','Registros a mostrar:') }}
        {{Form::select('pagi', array('10' => '10', '20' => '20', '30' => '30', '40' => '40', '50' => '50','60' => '60'))}}
    </div>

    <table  id="myTable" class="table">
     <thead>
        <tr>
                <th width="100" ><P align="center">{{ Form::checkbox('checkMain', 'checkMain', false, array('name' => 'checktodos'))}}</P></th>
                <th width="500"><P align="center">Clave Catastral</P></th>
                <th width="700"><P align="center">Nombre Propietario</P></th>
                <th width="200"><P align="center">Municpio</P></th>
                <th width="500"><P align="center">Domicilio</P></th>
                <th width="700"><P align="center">Periodo Mas Antiguo</P></th>
                <th width="350"><P align="center">Impuesto</P></th>
                <th width="350"><P align="center">Valor Catastral</P></th>
                <th width="350"><P align="center">Rezago</P></th>
        </tr>
    </thead>
    <tbody>
            <tr>
        <!--Variable de control-->
        <?php $i=0; ?>
        <!--Se imprimen resultados de la busqueda-->
        @foreach ($pagination as $key  )
                    <?php $i++ ?>
                    <?php $clave  = str_replace('(', '',$key[0]);?>
                    <?php $nombre = str_replace('"', '',$key[1]); ?>
                    <?php $impuesto =$key[5]; ?>
                    <?php $valorcc  =$key[6]; ?>
                    <?php $total    =$impuesto+$valorcc ?>

                  <td align="center">
                    <div class="row">
                    <div class="col-lg-6">
                    <div class="input-group">
                    <span class="input-group-addon">
                    {{ Form::checkbox('clave'.$i, $clave.','.$nombre.','.$total, false, ['onclick'=>'validar(this)'], array('id' => 'checkAll'))}}
                    </samp>
                </div></div></div>
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
                      <!--Limpia el registro-->
                      <?php $domicilio = str_replace('"', '',$key[3]); ?>
                      <!-- domicilio -->
                      {{domicilio;}}
                  </td>
                  <td align="center">
                      <!--Limpia el registro-->
                      <?php $periodo = str_replace(')', '',$key[7]); ?>
                      <!-- periodo -->
                      {{$periodo;}}
                  </td>
                  <td align="center">
                      <!-- impuesto-->
                      $ {{$impuesto}}
                  </td>
                  <td align="center">
                      <!--Convierte formato a moneda mexico-->
                      <?php $valorc = money_format('%i', $key[6]) . "\n"; ?>
                      <!-- Valor Catastral-->
                      $ {{$valorc}}
                  </td>
                  <td align="center">
                      <!--Limpia el registro-->
                      <?php $rezago = str_replace(')', '',$key[8]); ?>
                      <!-- CLAVE -->
                      $ {{$rezago}}
                  </td>
            </tr>
        @endforeach

    </tbody>
    </table>
{{ $pagination->appends(Request::except('page'))->links() }}
</div>
</div>
<br>
<div>
{{Form::text('mun',$mun=$key[2],array('hidden'))}}
{{Form::label('Fecha Emision Carta Invitacion: ') }}
{{Form::input('date', 'date1', $date->format('d/m/Y') , array('class' => 'btn btn-default btn-sm dropdown-toggle','disabled', 'required' ))}}


            {{Form::label('Ejecutores:') }}
                <select name="ejecutores" class="btn btn-default btn-sm dropdown-toggle" disabled>
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
