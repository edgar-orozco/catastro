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
                    function SINO(cual)
                        {
                        var elElemento=document.getElementById(cual);
                        if(elElemento.style.display == 'block')
                            {
                                elElemento.style.display = 'none';
                            } else
                            {
                                elElemento.style.display = 'block';
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
@stop

    <div class="panel-body">
             {{ Form::open(array(
                    'class'  => 'busquedas',
                    'role'   => 'form',
                    'method' =>'SeguimientobusController@getIndex',
                    'method' => 'POST',
                    'url'    =>'/busquedas',
                    'name'   =>'busqueda'
                    )) }}

        <div class="input-group">
            <table class="table">
                <tr>
                    <th>{{Form::label('Clave Catastral:') }}</th>
                    <th>{{Form::label('Nombre Propietario:') }}</th>
                    <th>{{Form::label('Municipio:') }}</th>
                    <th>{{Form::label('Estatus:') }}</th>
                </tr>
                <tr>
                    <td>
                        {{ Form::text('clave',null, array('class' => 'form-control focus', 'placeholder'=>'xx-xxx-xxx-xxxx-xxxxxx', 'autofocus'=> 'autofocus', 'pattern'=> '\d{2}[\-]\d{3}[\-]\d{3}[\-]\d{4}[\-]\d{6}'))  }}
                        {{ Form::number('paginado',10, array('id' =>'paginado', 'hidden')) }}
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
                    <p> {{$mensaje;}}</p>
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

    <table  id ="myTable" class="table">
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
            <?php $i=0; ?>
            @foreach ($pagination as $key )
                  <?php $i++ ?>
                  <?php $idrequerimiento =$key[5]; ?>
                  <?php $clave           = str_replace('(', '',$key[0]);?>
                  <?php $nombre          = str_replace('"', '',$key[1]); ?>
                  <?php $impuesto        =$key[5]; ?>
                  <?php $valorcc         = $key[6]; ?>
                  <?php $total           =$impuesto+$valorcc ?>

            <td align="center">
                {{ Form::checkbox('clave'.$i, $clave.','.$nombre.','.$total, false, ['onclick'=>'validar(this)'], array('id' => 'checkAll'))}}
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
              {{$estatus=$key[4];}}
            </td>
            <td align="center">
                <!-- periodo -->
                {{$fechainicio=$key[6];}}
            </td>
            <td align="center">
               <!-- impuesto-->
               <?php $fechavencimiento= str_replace(')', '',$key[7]);?>
               {{$fechavencimiento;}}
               <?php $fechacancelacion = str_replace(')', '',$key[8]);?>
            </td>
            <td align="center">
                <?php if(empty($fechacancelacion))  { ?>
                <!-- agrgar datos requerimiento-->
                @if($fechainicio=='' || $fechavencimiento=='')
                <a data-toggle ="modal"  data-target="#Nuevo" href="/ejecucion/modal/{{$idrequerimiento}}" title="Agregar Requerimiento" ><span class="glyphicon glyphicon-pencil"></span></a>
                @endif
            </td>
            <td align="center">
                <!-- link reimpresion ultimo estado-->
                <a   href ="/reimprimir/{{$clave}}"  ><span class="glyphicon glyphicon-print" title="Reimprimir Documento"></span></a>
            </td>
            <td>
                <?php $fecha= date("d/m/Y");
                    if($fechavencimiento>=$fecha)
                    {
                       echo '<a   href ="#" ><span class="glyphicon glyphicon-forward" title="Continuar Proceso"></span></a>';
                   }elseif ($fechavencimiento<=$fecha)
                   {
                         echo '<span class="glyphicon glyphicon-ok" title="Proceso VIgente"></span>';
                   }?>
            </td>
            <td>
                <a data-toggle ="modal"  data-target="#cancelar" href="/ejecucion/cancelar/{{$idrequerimiento}}" title="Cancelar Requerimiento"><span class="glyphicon glyphicon-remove"></span></a>

            </td> <?php } else {?>
             <td>
                <span class="badge">Cancelado</span>

            </td>
                <?php } ?>
        </tr>
        @endforeach
    </tbody>
    </table>
   {{ $pagination->appends(Request::except('page'))->links() }}
</div>
</div>
{{ Form::close() }}
 @endif
<!-- Modal -->
<div class="modal fade" id="Nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" id="modalBody" >

            </div>
            <div class="modal-footer" id="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- fin Modal -->
<!-- Modal -->
<div class="modal fade" id="cancelar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" id="modalBody" >

            </div>
            <div class="modal-footer" id="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- fin Modal -->
<br>
@stop