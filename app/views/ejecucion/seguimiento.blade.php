<?php
error_reporting(E_ERROR | E_WARNING);
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
        {{ HTML::style('css/forms.css') }}
        @section('javascript')
            <script>
                //mostrar  ocultatr vistaa
                function SINO(cual) {
                    var elElemento = document.getElementById(cual);
                    if (elElemento.style.display == 'block') {
                        elElemento.style.display = 'none';
                    } else {
                        elElemento.style.display = 'block';
                    }
                }
            </script>
            <script>
                //actualiza el paginado cuando se cambia el numero de registros a mostrar
                $('#pagi').on('change', function () {
                    document.getElementById('paginado').value = document.getElementById('pagi').value;
                    document.busqueda.submit();
                });


            </script>

            <script type="text/javascript">
                $(document).ready(function () {
                    $("body").delegate('.editar-ejecucion', 'click', function () {

                        var href = $(this).attr('data-requerimiento');

                        $('#id').val(href)
                        $('#modal-footer').html('');
                        $('#nuevo').modal('toggle');


                    });
                });
            </script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("body").delegate('.cancelar-ejecucion', 'click', function () {

                        var href = $(this).attr('data-cancelar');

                        $('#idc').val(href)
                        $('#modal-footer').html('');
                        $('#nuevo').modal('toggle');


                    });
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

            <div>
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
                            <select name="municipio" class="form-control">
                                <option value=''>Elija un municipio...</option>
                                @foreach($municipio as $row)
                                    <option value="{{$row->municipio}}">{{$row->nombre_municipio}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="estatus" class="form-control">
                                <option value=''>Elija un estatus...</option>
                                @foreach($status as $row)
                                    <option value="{{$row->cve_status}}">{{$row->descrip}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">{{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}</td>
                        <td colspan="2">{{ Form::reset('Limpiar', array('class' => 'btn btn-warning limpiar')) }} </td>
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
            {{ Form::open(array('url' => 'cartainv', 'method' => 'post', 'name' => 'formulario', 'id' => 'formulario',  'target' => '_blank'))}}
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
                <th width="500"><P align="center">Clave Catastral</P></th>
                <th width="700"><P align="center">Nombre Propietario</P></th>
                <th width="200"><P align="center">Municpio</P></th>
                <th width="500"><P align="center">Estatus</P></th>
                <th width="500"><P align="center">Fecha de requerimiento</P></th>
                <th width="700"><P align="center">Fecha Inicio</P></th>
                <th width="350"><P align="center">Fecha Vencimiento</P></th>
                <th width="350"><P align="center"></P>--</th>
                <th width="350"><P align="center"></P>--</th>
                <th width="350"><P align="center"></P>--</th>
                <th width="350"><P align="center"></P>--</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php $i=0; ?>
            @foreach ($pagination as $key )
                  <?php $i++ ?>
                  <?php $idrequerimiento = $key[5]; ?>
                  <?php $clave           = str_replace('(', '',$key[0]);?>
                  <?php $nombre          = str_replace('"', '',$key[1]); $nombre=str_replace('{', '',$nombre);$nombre=str_replace('}', '',$nombre);?>
                  <?php $impuesto        = $key[5]; ?>
                  <?php $valorcc         = $key[6]; ?>
                  <?php $total           = $impuesto+$valorcc ?>
                  <?php $fechacancelacion = str_replace(')', '',$key[8]); ?>
                  <?php $notificacion   =  str_replace(')','',$key[9]);?>
                  <?php $style='style="font-size: 80%;"' ?>
            <td align="center" <?php echo $style ?>>
                <!-- CLAVE -->
                {{$clave;}}
            </td>
            <td align="center" <?php echo $style ?>>
                <!-- NOMBRE -->
                {{$nombre;}}
            </td>
            <td align="center" <?php echo $style ?>>
                <!-- MUNICIPIO -->
               {{$municipio=$key[2];}}
            </td>
            <td align="center" <?php echo $style ?>>
                <!-- domicilio -->
              {{$estatus=$key[4];}}
            </td>
             <td align="center" <?php echo $style ?>>
                <!-- periodo -->
                <?php echo $fecharequerimiento = str_replace(')', '',$key[11]);?>
            </td>
            <td align="center" <?php echo $style ?>>
                <!-- periodo -->
                {{$fechainicio=$key[6];}}
            </td>
            <td align="center" <?php echo $style ?>>
               <!-- impuesto-->
               <?php $fechavencimiento= str_replace(')', '',$key[7]);?>
                <?php $vigencia = str_replace(')', '',$key[10]);?>
                <?php $fecharequerimiento = str_replace(')', '',$key[11]);?>
               <?php if(!empty($fechainicio) || $key[3]== 'RC' )
               {
                $fechaven = FechasHelper::diasprueba($vigencia,$fecharequerimiento);
                echo $fechaven;
               }elseif (empty($fechainicio)) {
                   $fechaven='';
               }
               ?>
            </td>
            <td align="center" <?php echo $style ?>>
                <!-- agrgar datos requerimiento-->
                @if($notificacion=='Si')
                @if($fechainicio=='' || $fechaven=='')
                <a data-toggle ="modal" class="editar-ejecucion" data-requerimiento="{{$idrequerimiento}}" data-target="#Nuevo" href="/ejecucion/modal/{{$idrequerimiento}}" title="Agregar Requerimiento" >
                    <span class="glyphicon glyphicon-pencil"></span></a>
                @endif
                @endif
            </td>
            <td align="center" <?php echo $style ?>>
                <?php $arr = array(CI => '<a   href ="/reimprimir/'.$clave.'"  target=_blank><span class="glyphicon glyphicon-print" title="Reimprimir Documento"></span></a>',
                                   RC => '<a   href ="ejecucion/procesorc"     target=_blank><span class="glyphicon glyphicon-print" title="Reimprimir Documento" id="procesocc"></span></a>'); ?>
                <!-- link reimpresion ultimo estado-->
                <?php echo $arr[$key[3]]; ?>
            </td>
            <td>
                <?php $fecha = strtotime(date("d-m-Y"));
                   if(!empty($fechaven))
                   {
                    $fv=strtotime($fechaven);
                    if($fv<$fecha)
                    {
                        $arreglo = array(CI =>'<a  id="prosc1" data-toggle ="modal" class="proceso-ejecucion" data-target="#proceso" target="_blank" href ="/ejecucion/proceso/'.$idrequerimiento.'" ><span class="glyphicon glyphicon-forward" title="Continuar Proceso"></span></a>',
                                         RC =>'<a  data-toggle ="modal" class="proceso-ejecucion" data-target="#requerimiento" target="_blank" href ="/ejecucion/requerimiento/'.$idrequerimiento.'" ><span class="glyphicon glyphicon-forward" title="Proceso"></span></a>');
                        echo $arreglo[$key[3]]; 
                   }else
                   {
                         echo '<span class="glyphicon glyphicon-ok" title="Proceso VIgente"></span>';
                   }}?>
            </td>
            <td>
                <a data-toggle ="modal"  data-cancelar="{{$idrequerimiento}}" class="cancelar-ejecucion" data-target="#cancelar" href="/ejecucion/cancelar/{{$idrequerimiento}}" title="Cancelar Requerimiento"><span class="glyphicon glyphicon-remove"></span></a>

            </td>
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

                <div class="modal-body" id="modalBody1">

                </div>
                <div class="modal-footer" id="modal-footer1">

                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->
      <!-- Modal -->
    <div class="modal fade" id="proceso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body" id="modalBody2">

                </div>
                <div class="modal-footer" id="modal-footer2">

                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->
     <!-- Modal -->
    <div class="modal fade" id="requerimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body" id="modalBody2">

                </div>
                <div class="modal-footer" id="modal-footer2">

                </div>
            </div>
        </div>
    </div>
    <!-- fin Modal -->
    <br>
    <div class="row-fluid">
        <div class="col-lg-3" style="color:white; background-color: #004F80;">Proceso Activo</div>
        <div class="col-lg-3" style="color:white; background-color: #FF8400;">Proceso Vencido</div>
        <div class="col-lg-3" style="color:white; background-color: #CF0000;">Proceso Cancelado</div>
        
    </div>
    </div>
@stop
