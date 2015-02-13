@extends('layouts.default')

@section('title')
Bienvenido :: @parent
@stop

@section('content')
<div>
    <div class="panel panel-primary">
    
    <div class="panel-heading">

        <h4 class="panel-title">Busqueda de Predios</h4>
        
    </div>

</div>
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/theme.default.css') }}
    <script src="/js/jquery-1.4.3.min.js" type="text/javascript"></script>
    <script src="/js/checks.js" type="text/javascript"></script>
    <script src="/js/jquery.tablesorter.widgets.js" type="text/javascript"></script>
        <script>
            function SINO(cual) {
            var elElemento=document.getElementById(cual);
            if(elElemento.style.display == 'block') 
            {
                elElemento.style.display = 'none';
                 } else {
                    elElemento.style.display = 'block';
                 }
            }
        </script>
        <script>
            $ ( función () { 
  $ ( "#myTable" ). tablesorter (); 
});
        </script>
<script>
    $ ( función () { 
  $ ( "#myTable" ). tablesorter ({ sortList :  [[ 0 , 0 ],  [ 1 , 0 ]]  }); 
});
</script>
    <div class="panel-body">
             {{ Form::open(array(
                    'role' => 'form',
                    'method'=>'BuscarController@getIndex',
                    'method' => 'GET'
                    ))
        }}

        <div class="input-group">
            <table class="table datatable">
                <tr>
                    <td>
            {{Form::label('Clave Catastral:') }}
            {{ Form::text('clave',null, array('class' => 'form-control focus', 'placeholder'=>'xxx-xxxx-xxxxxx', 'autofocus'=> 'autofocus')) }}
                    </td>
                    <td>
            {{Form::label('Nombre Propietario:') }}
            {{ Form::text('nombre',null, array('class' => 'form-control focus', 'placeholder'=>'Nombre')) }}
                    </td>

            {{$errors->first("predios")}}
                </tr>
            </table>
        </div>
        <br>
        <div id="demo1" style="display:none;">
            <table class="table datatable">
                <tr>
                    <td>
            {{Form::label('Municipio:') }}
            {{ Form::text('municipio','', array('class' => 'form-control focus', 'placeholder'=>'Mucipio', 'autofocus'=> 'autofocus')) }}
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
             {{Form::select('size', array('PC' => 'PC', 'CI' => 'CI', 'RC' => 'RC', 'RI' => 'RI', 'RA' => 'RA', 
             'RN' => 'RN', 'DC' => 'DC', 'DI' => 'DI', 'DA' => 'DA', 'DN' => 'DN', 'EC' => 'EC', 'EI' => 'EI',
              'EA' => 'EA', 'EN' => 'EN', 'SS' => 'SS', 'XE' => 'XE', 'XC' => 'XC', 'XP' => 'XP'))}}
            
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
         <p> <a class="liga" href="javascript:void(0);" onclick="SINO('demo1')">Mas opciones de busqueda / Ocultar</a></p>
         <br>
        {{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>
    {{ Form::open(array(
                    'role' => 'form',
                    'method'=>'BuscarController@metodo',
                    'method' => 'GET'
                    ))
        }}
    <div class="panel panel-primary">

    <div class="panel-heading">

        <h4 class="panel-title">Resultados</h4>
        
    </div>

    <table border="1"  id="myTable" class="tablesorter">
     <thead>
        <tr>
                <th width="700">{{ Form::checkbox('checkMain', 'checkMain', false, array('id' => 'checkMain'))}}Seleccionar todos</th>
                <th width="500">Clave Catastral</th>
                <th width="700">Nombre Propietario</th>
                <th width="200">Municpio</th>
                <th width="500">Calle No.</th>
                <th width="400">Colonia</th>
                <th width="400">Codigo Postal</th>
                <th width="700">Periodo Mas Antiguo</th>
                <th width="350">Monto Adeudo</th>
                <th width="250">Estatus</th>
        </tr>
    </thead>
    <tbody>
        <tr>

            @foreach($busqueda as $row)
            <td>
                
                {{ Form::checkbox($row->clave, $row->clave, false, array('class' => 'checkAll'))}}
            </td>

            <td>
             {{$row->clave;}}  
            </td>
            <td>
             {{$row->nombre;}}
            </td>
            <td>
              {{$row->municipio;}}
            </td>
            <td>
                 {{$row->calle;}}
            </td>
            <td>
               {{ $row->colonia;}}
            </td>
            <td>
                 {{$row->cp;}}
            </td>
            <td>
                 {{$row->minimo;}}
            </td>
            <td>
                {{$row->adeudo;}}
            </td>
            <td>
                {{$row->status;}}
            </td>

            
        </tr>
        @endforeach


        </tr>
    </tbody>
    </table>
</div>
</div>
{{ Form::submit('Enviar', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
@stop
