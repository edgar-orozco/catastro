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
    {{ HTML::style('js/jquery/jquery-ui.css') }}

    @section('javascript')
    {{ HTML::script('js/jquery/jquery-ui.js') }}
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
                        d.datepicker.disabled      = false;
                        d.ejecutores.disabled = false;
                    }else
                        {
                        d.boton.disabled      = true;
                        d.datepicker.disabled      = true;
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

<script>
            //actualiza el paginado cuando se cambia el numero de registros a mostrar
            $('#limpiar').on('click', function()
                {
                  document.getElementById('nombre').value ='';
                  document.getElementById('clave').value ='';
                  document.getElementById('mayor').value ='';
                  document.getElementById('menor').value ='';
                  document.getElementById('municipio').value ='';
                  document.getElementById('adeudos').value ='';
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
                d.datepicker.disabled = false;
                d.ejecutores.disabled = false;
            } else {
                this.checked = false;
                d.boton.disabled = true;
                d.datepicker.disabled = true;
                d.ejecutores.disabled = true;
            }
        });
    });

});
</script>
<script>
$(document).ready(function(){
  $("#clave").keydown(function(event) {
     if(event.shiftKey)
     {
          event.preventDefault();
     }

     if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 189 || event.keyCode == 109 )    {
     }
     else {
          if (event.keyCode < 95) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                  event.preventDefault();
            }
          }
          else {
                if (event.keyCode < 96 || event.keyCode > 105) {
                    event.preventDefault();
                }
          }
        }
     });
  });

$(document).ready(function(){
  $("#mayor").keydown(function(event) {
     if(event.shiftKey)
     {
          event.preventDefault();
     }

     if (event.keyCode == 46 || event.keyCode == 8 )    {
     }
     else {
          if (event.keyCode < 95) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                  event.preventDefault();
            }
          }
          else {
                if (event.keyCode < 96 || event.keyCode > 105) {
                    event.preventDefault();
                }
          }
        }
     });
  });
$(document).ready(function(){
  $("#menor").keydown(function(event) {
     if(event.shiftKey)
     {
          event.preventDefault();
     }

     if (event.keyCode == 46 || event.keyCode == 8 )    {
     }
     else {
          if (event.keyCode < 95) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                  event.preventDefault();
            }
          }
          else {
                if (event.keyCode < 96 || event.keyCode > 105) {
                    event.preventDefault();
                }
          }
        }
     });
  });
//Calendario
$(function() {
    $( "#datepicker" ).datepicker();
  });
//Cambiar a español el calendario
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy-mm-dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha").datepicker();
});
</script>

<script>
    function soloLetras(e){
 key = e.keyCode || e.which;
 tecla = String.fromCharCode(key).toLowerCase();
 letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
 especiales = [8,37,39,46];

 tecla_especial = false
 for(var i in especiales){
     if(key == especiales[i]){
  tecla_especial = true;
  break;
            }
 }
        if(letras.indexOf(tecla)==-1 && !tecla_especial)
     return false;
     }
</script>

@stop

<div class="panel-body">
    {{ Form::open(array(
        'class'  => 'busqueda',
        'role'   => 'form',
        'method' => 'BuscarController@index',
        'method' => 'POST',
        'url'    =>'/ejecucion',
        'name'   =>'busqueda'

     )) }}

        <div class="table">
            <table class="table">
                <tr>
                    <th>{{Form::label('clave','Clave Catastral:') }}</th>
                    <th>{{Form::label('nombre','Nombre Propietario:') }}</th>
                    <th>{{Form::label('mayor','Mayor a:') }}</th>
                    <th>{{Form::label('menor','Menor a:') }}</th>
                    <th>{{Form::label('municipios','Municipio:') }}</th>
                    <th>{{Form::label('adeudos','Años de Adeudo:') }}</th>
                </tr>
                <tr>
                    <td>
                        {{ Form::text('clave',$clave, array('class' => 'form-control focus', 'placeholder'=>'xx-xxx-xxx-xxxx-xxxxxx', 'autofocus'=> 'autofocus', 'pattern'=> '\d{2}[\-]\d{3}[\-]\d{3}[\-]\d{4}[\-]\d{6}'))}}
                    </td>
                    <td>
                        {{ Form::text('nombre',$propietario, array('class' => 'form-control focus', 'placeholder'=>'Nombre', 'onkeypress' => 'return soloLetras(event)')) }}
                        {{ Form::number('paginado',10, array('id'=>'paginado', 'hidden')) }}
                    </td>
                    <td>
                        {{ Form::number('mayor',$mayor, array('class' => 'form-control focus', 'placeholder'=>'Mayor a :'))  }}
                    </td>
                    <td>
                        {{ Form::number('menor',menor, array('class' => 'form-control focus', 'placeholder'=>'Menor a :'))  }}
                    </td>
                        {{$errors->first("predios")}}
                    <td>
                        <select name="municipios" class="btn btn-default btn-sm dropdown-toggle">
                            <option value=''>Seleccione un municipio...</option>
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
                    <td>{{ Form::button('limpiar', array('class' => 'btn btn-primary', 'id' => 'limpiar')) }} </td>
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
    {{ Form::open(array('url' => 'cartainv', 'method' => 'post', 'name' => 'formulario', 'target'=>'_blank'))}}
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
                    <?php //$impuesto = Number_format($key[5], 2, '.',',' )?>
                    <?php $impuesto = $key[4]?>
                    <?php $valorcc  =$key[6]; ?>
                    <?php $total    =$impuesto+$valorcc ?>

                  <td align="center">
                    <div class="row">
                    <div class="col-lg-6">
                    <div class="input-group">
                    <span class="input-group-addon">
                    {{ Form::checkbox('clave'.$i, $clave.','.$nombre.','.$total, false, ['onclick'=>'validar(this)'], array('id' => 'checkAll'))}}
                    <?php  $id_mun =substr($clave, 3, 3);?>
                    {{ Form::text('id_municipio',$id_mun,array('hidden'))}}
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
                      <?php $periodo = str_replace(')', '',$key[6]); ?>
                      <!-- periodo -->
                      {{$periodo;}}
                  </td>
                  <td align="right">
                      <!-- impuesto-->
                      $ {{$impuesto}}
                  </td>
                  <td align="right">
                      <!--Convierte formato a moneda mexico-->
                      <?php //$valorc1 = money_format('%i', $key[6]) . "\n"; ?>
                      <?php $valorc = Number_format($key[5], 2, '.',',' ) ?>
                      <!-- Valor Catastral-->
                      $ {{$valorc}}
                  </td>
                  <td align="right">
                      <!--Limpia el registro-->
                      <?php $rezago = str_replace(')', '',$key[7]); ?>
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
<?php $fecha= date("Y-m-d"); ?>
{{Form::text('mun',$mun=$key[2],array('hidden'))}}
{{Form::label('Fecha Emision Carta Invitacion: ') }}
{{Form::text('date', $fecha, ['id'=>'datepicker', 'class'=>'btn btn-default btn-sm dropdown-toggle','autofocus'=> 'autofocus', 'disabled'] )}}


            {{Form::label('Ejecutores:') }}
                <select name="ejecutores" class="btn btn-default btn-sm dropdown-toggle" disabled>
                     @foreach($catalogo as $row)
                        <option value="{{$row->id}}">{{$row->nombre}}</option>
                    @endforeach
                </select>
</div>
<br>
{{ Form::submit('Generar Carta Invitacion', array('class' => 'btn btn-primary', 'name' => 'boton', 'disabled','id' => 'boton')) }}
{{ Form::close() }}
 @endif
<br><br><br>
@stop
