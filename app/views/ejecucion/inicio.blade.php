<?php
error_reporting (E_ERROR | E_WARNING);
?>
@extends('layouts.default')

@section('title')
Bienvenido :: @parent
@stop

@section('content')
<div>
    <div class="panel-default">
    
    <div class="panel-heading">

        <h4 class="panel-title">Busqueda de Predios</h4>
        
    </div>

</div>
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/theme.default.css') }}
    {{ HTML::script('js/jquery-1.4.3.min.js')}}
    {{ HTML::script('js/checks.js')}}
   
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
    <div class="panel-body">
             {{ Form::open(array(
                    'role' => 'form',
                    'method'=>'BuscarController@index',
                    'method' => 'GET',
                    'url'=>'/ejecucion'

                    ))
        }}

        <div class="input-group">
            <table class="input-group">
                <tr>
                    <td>
            {{Form::label('Clave Catastral:') }}
            {{ Form::text('clave',null, array('class' => 'form-control focus', 'placeholder'=>'xx-xxx-xxx-xxxx-xxxxxx', 'autofocus'=> 'autofocus', 'pattern'=> '\d{2}[\-]\d{3}[\-]\d{3}[\-]\d{4}[\-]\d{6}'))  }}
                    </td>
                    <td>
            {{Form::label('Nombre Propietario:') }}
            {{ Form::text('nombre',null, array('class' => 'form-control focus', 'placeholder'=>'Nombre')) }}
                    </td>
                    <td>
            {{Form::label('Registros a mostrar:') }}
            {{Form::select('paginado', array('10' => '10', '20' => '20', '30' => '30', '40' => '40', '50' => '50','60' => '60'))}}
                    </td>
             </tr>
             <tr>
             <td>
            {{Form::label('Rango Valor Catastral:') }}
            {{ Form::number('mayor',null, array('class' => 'form-control focus', 'placeholder'=>'Mayor a :', 'autofocus'=> 'autofocus'))  }}
                    </td> 
            <td>
             {{Form::label('  .') }}
            {{ Form::number('menor',null, array('class' => 'form-control focus', 'placeholder'=>'Menor a :', 'autofocus'=> 'autofocus'))  }}
                    </td>

            {{$errors->first("predios")}}
                </tr>
            </table>

        </div>
        <br>
        <div><p> 
            
            <a class="btn btn-primary" href="javascript:void(0);" onclick="SINO('demo1')">Mas opciones</a></p></div>
        <br>


        <br>
        <div id="demo1" style="display:none;">

            <table class="table datatable">
                <tr>
                    <td>
            {{Form::label('Municipio:') }}
            <select name="municipio" class="form-control"  >
            <option value=''>Elija un municipio...</option>
            @foreach($municipio as $row) 
            <option value="{{$row->municipio}}">{{$row->nombre_municipio}}</option>
            @endforeach
        </select>
                    </td>
                    <td>
            {{Form::label('Colonia:') }}
            {{ Form::text('colonia',null, array('class' => 'form-control focus', 'placeholder'=>'Colonia', 'autofocus'=> 'autofocus')) }}
                    </td>
                    <td>
            {{Form::label('No. Calle:') }}
            {{ Form::text('calle',null, array('class' => 'form-control focus', 'placeholder'=>'No. de calle', 'autofocus'=> 'autofocus')) }}
                    </td>
                    <td>
            {{Form::label('Codigo Postal:') }}
            {{ Form::text('cp',null, array('class' => 'form-control focus', 'placeholder'=>'Codigo postal', 'autofocus'=> 'autofocus')) }}
                    </td>
                    <td>
                       
            {{Form::label('Estatus:') }}
             <select name="status" class="form-control" >
            <option value=''>Seleccione status...</option>
            @foreach($status as $row) 
            <option value="{{$row->cve_status}}">{{$row->descrip}}</option>
            @endforeach
        </select>
            
                    </td>
                    <td>
            {{Form::label('Periodo de Adeudo:') }}
                    </td>
                    <td>
                    {{Form::input('date', 'date', null, ['class' => 'form-control', 'placeholder' => 'Date'])}}
                    </td>
                </tr>
            </table>
            </div>
        <br/>
         
         <br>
        {{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>
    <br>
    <br>
    <br>
   
    @if(count($busqueda) == 0)
        <div class="panel-body">
            <h3><p> {{$mensaje;}}</p></h3>


        </div>
    @endif
    
    @if(count($busqueda) > 0)
    {{ Form::open(array('url' => 'cartainv', 'method' => 'post', 'name' => 'formulario'))}}
    {{$date = new DateTime();}} 

    <div class="panel-default">

    <div class="panel-heading">

        <h4 class="panel-default">Resultados</h4>
        
    </div>

    <table  border="1" id="myTable" class="tablesorter">
     <thead>
        <tr>
                <th width="100" ><P align="center">{{ Form::checkbox('checkMain', 'checkMain', false, array('name' => 'checktodos'))}}</P></th>
                <th width="500"><P align="center">Clave Catastral</P></th>
                <th width="700"><P align="center">Nombre Propietario</P></th>
                <th width="200"><P align="center">Municpio</P></th>
                <th width="500"><P align="center">Calle No.</P></th>
                <th width="400"><P align="center">Colonia</P></th>
                <th width="400"><P align="center">Codigo Postal</P></th>
                <th width="700"><P align="center">Periodo Mas Antiguo</P></th>
                <th width="350"><P align="center">Monto Adeudo</P></th>
                <th width="250"><P align="center">Estatus</P></th>
        </tr>
    </thead>
    <tbody>
        <tr>
       
           <?php $i=0 ?>
            @foreach($busqueda as $row)
            <?php $i++ ?>
                
            <td align="center">
             {{ Form::checkbox('clave'.$i, $row->clave, false, ['onclick'=>'validar(this)'], array('id' => 'checkAll'))}}
              <!--  <a href="hoja/{{$row->clave;}}/{{$row->nombre;}}/{{$row->municipio;}}/{{$row->impuesto;}}" class="btn btn-xs btn-info" title="Reimprimir">Generar Carta Invitación<i class="fa fa-file-text-o"></i></a>-->
            </td>
            <td align="center">
                {{$row->clave}}
            </td>
            <td align="center">
                {{$row->nombre;}}
            </td>
            <td align="center">
               {{$row->id_p;}}
            </td>
            <td align="center">
                {{$row->calle;}}
            </td>
            <td align="center">
                {{ $row->colonia;}}
            </td>
            <td align="center">
                {{$row->cp;}}
            </td>
            <td align="center">
                {{$row->minimo;}}
            </td>
            <td align="center">
                {{$row->impuesto;}}
            </td>
            <td align="center">
                {{$row->estatus;}}
            </td>         
        </tr>
        @endforeach
   
        </tr>
    </tbody>
    </table>
{{ $busqueda->appends(Request::except('page'))->links() }}
    
                    
</div>
</div>
<br>
<div>

{{Form::label('Fecha Emision Carta Invitacion: ') }}
{{Form::input('date', 'date1', $date->format('d/m/Y') , array('disabled', 'required' ))}}

</div>
<div>
    {{Form::label('Ejecutores:') }}
     <select name="ejecutores" class="form-control">
            @foreach($catalogo as $row) 
            <option value="{{$row->id_ejecutor}}">{{$row->cargo}}</option>
            @endforeach
        </select>
   
</div>
<br>
{{ Form::submit('Generar Carta Invitacion', array('class' => 'btn btn-primary', 'name' => 'boton', 'disabled')) }}
{{ Form::close() }}

 @endif

<br><br><br>
@stop
