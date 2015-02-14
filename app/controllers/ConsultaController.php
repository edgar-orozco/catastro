 <?php
//--Controlador para la busqueda de predios
class BuscarController extends BaseController {
//cahcar parametros verificar vacio y evitar agregar en consulta k noi entre vacio
    public function getIndex() {


    	/////////// RECIBIENDO LAS VARIABLES
    	$clave = Input::get('clave');
    	$nombre = Input::get('nombre');
    	$municipio = Input::get('municipio');
    	$colonia = Input::get('colonia');
    	$calle = Input::get('calle');
    	$cp = Input::get('cp');
    	$estatus = Input::get('estatus');
    	$date = Input::get('date');
    	////////////////////////////////////////////////
   	//BUSQUEDA AVANZA DATOS DEL PREDIO
 $busqueda = propietarios::WHERE ('clave', '=',  $clave)
            ->orWhere('nombre', $nombre)
            ->orWhere('municipio', $municipio)
            ->orWhere('colonia', $colonia)
            ->orWhere('calle', $calle)
            ->orWhere('cp', $cp)
            ->orWhere('estatus', $estatus)
            ->orWhere('date', $date)
            -> join ( 'emision_predial' ,  'propietarios.clave' ,  '=' ,  'emision_predial.clave' ) 
            -> join ( 'personas', 'predio.id_propietario', '=', 'personas.id_p')
            -> select ( 'propietarios.clave AS clave', 'emision_predial.municipio AS municipio', 'predios.distancia_cabecera AS cabecera', 'predios.id_du AS id', 'predios.tipo_predio AS predio' ,  'personas.nombrec AS nombre', 'emision_predial.anio AS fecha', 'personas.rfc AS rfc', 'personas.id_p AS id_p' ) 
            -> get ();
             return View::make('ejecucion.buscar', compact("busqueda"));

         }

         ////////////////////////////////////////////////////////////////////


            public function getIndex() {


      /////////// RECIBIENDO LAS VARIABLES
      $clave = Input::get('clave');
      $nombre = Input::get('nombre');
      $municipio = Input::get('municipio');
      $colonia = Input::get('colonia');
      $calle = Input::get('calle');
      $cp = Input::get('cp');
      $estatus = Input::get('estatus');
      $date = Input::get('date');
      ////////////////////////////////////////////////
    //BUSQUEDA AVANZA DATOS DEL PREDIO
 $busqueda = propietarios::WHERE ('clave', '=',  $clave)
           // ->orWhere('nombre', $nombre)
            ->orWhere('municipio', $municipio)
           // ->orWhere('colonia', $colonia)
           // ->orWhere('calle', $calle)
           // ->orWhere('cp', $cp)
           // ->orWhere('estatus', $estatus)
           // ->orWhere('date', $date)
            -> join ( 'emision_predial' ,  'propietarios.clave' ,  '=' ,  'emision_predial.clave' ) 
            -> join ( 'personas', 'propietarios.id_propietarios', '=', 'personas.id_p')
            -> select ( 'propietarios.clave AS clave', 'emision_predial.municipio AS municipio', 'emision_predial.entidad AS id', 'personas.rfc AS predio' ,  'personas.nombrec AS nombre', 'emision_predial.anio AS fecha', 'personas.rfc AS rfc', 'personas.id_p AS id_p' ) 
            -> get ();
             return View::make('ejecucion.buscar', compact("busqueda"));

         }
}

/////////////////////////////////////////////////////////////////////////


<?php
//--Controlador para la busqueda de predios
class BuscarController extends BaseController {
//cahcar parametros verificar vacio y evitar agregar en consulta k noi entre vacio

   public function getIndex() {
        //captura de datos de buscar.blade.php
        $clave = Input::get('clave');
       // $propietario = Input::get('nombre');
        $municipio = Input::get('municipio');
      //  $colonia= Input::get('colonia');
      //  $calle = Input::get('calle');
      //  $cp = Input::get('cp');
       // $estatus= Input::get('estatus');
      //  $date = Input::get('date');

        //------------------------------------------    
        $clave = Str::upper($clave);

        //--Consulta a la base de datos a la tabla predios
       /* $busqueda = predios::WHERE ('clave', '=',  $clave)
                ->orWhere('municipio', $municipio)      
                ->orderBy('gid','ASC')
                ->get();
        //--Envio de la informacion a la vista en vuscar.blade.php
        return View::make('ejecucion.buscar', compact("busqueda")); */



            $busqueda = predios::WHERE ('clave', '=',  $clave)
            ->orWhere('municipio', $municipio)
            -> join ('emision_predial', 'predios.clave', '=', 'emision_predial.clave')
            -> join ( 'personas' ,  'predios.id_propietario' ,  '=' ,  'personas.id_p' ) 
            -> select ( 'predios.clave AS clave', 'predios.municipio AS municipio', 'predios.distancia_cabecera AS cabecera', 'predios.id_du AS id', 'predios.tipo_predio AS predio' ,  'personas.nombrec AS nombre', 'personas.fecha_ingr AS fecha', 'personas.rfc AS rfc', 'personas.id_p AS id_p' ) 
            -> get ();
             return View::make('ejecucion.buscar', compact("busqueda"));




  /*   public function getPredio($id=null)
    {
        $datos=predios::find($id);
        return View::make('buscar.complementos',compact("datos"));

    }
     public function getInstalacion()
    {
//        $datos=predios::find('1');
        return View::make('buscar.instalaciones');

    }
*/
    
}
 
   }



   //////////////////////////////////////////////////////////////////////////////

   @extends('layouts.default')

@section('title')
Bienvenido :: @parent
@stop

@section('content')
<div>
    <h1>Busqueda de Predios </h1>
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ HTML::style('css/style.css') }}
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
    <div class="panel-body">
             {{ Form::open(array(
                    'role' => 'form',
                    'method'=>'BuscarController@getIndex',
                    'method' => 'GET'
                    ))
        }}

        <div class="input-group">
            <table>
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
            <table>
                <tr>
                    <td>
            {{Form::label('Municipio:') }}
            {{ Form::text('municipio',null, array('class' => 'form-control focus', 'placeholder'=>'Mucipio', 'autofocus'=> 'autofocus')) }}
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
            {{ Form::text('estatus',null, array('class' => 'form-control focus', 'placeholder'=>'Estatus', 'autofocus'=> 'autofocus')) }}
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
    <table border="1">
        <tr>
            <td width="500">Clave Catastral</td>
                <td width="400">Nombre Propietario</td>--
                <td width="250">Municipio</td>
                <td width="500">Calle No.</td>
                <td width="400">Colonia</td>
                <td width="250">Codigo Postal</td>
                <td width="500">Periodo Mas Antiguo</td>
                <td width="400">Monto Deudo</td>
                <td width="250">Estatus</td>

        </tr>

        <tr>

            @foreach($busqueda as $row)

            <td>
                <?php echo $row->clave; ?>--
            </td>
            <td>
             <?php echo $row->nombre; ?>
            </td>
            <td>
              <?php echo $row->municipio; ?>
            </td>
            <td>
                <?php echo $row->predio; ?>
            </td>
            <td>
                <?php echo $row->id; ?>
            </td>
            <td>
                <?php echo $row->fecha_ingr; ?>
            </td>
            <td>
                <?php echo $row->fecha; ?>
            </td>
            <td>
                <?php echo $row->rfc; ?>
            </td>
            <td>
                <?php echo $row->id_du; ?>
            </td>

            
        </tr>
        @endforeach


        </tr>
    </table>
</div>
@stop


////////////////////////////////////////// busqueda


            $busqueda = propietarios::WHERE ('clave', '=',  $clave)
            ->orWhere('personas.nombrec', $propietario)
            -> join ( 'personas', 'propietarios.id_propietario',  '=',  'personas.id_p' ) 
            -> join ( 'emision_predial', 'propietarios.clave', '=', 'emision_predial.clave')
            -> select ( 'propietarios.clave AS clave', 'propietarios.id_propietario AS id_propietario', 'personas.nombrec AS nombre', 'personas.rfc AS rfc', 'personas.fecha_ingr AS fecha1' ,  'propietarios.fecha_ingr AS fecha2', 'propietarios.tipo_propietario AS tipo', 'propietarios.id_td AS id_td', 'propietarios.id_dom AS dom' ) 
            -> get ();
            return View::make('ejecucion.buscar', compact("busqueda"));



////////////////////////////////////////////////

@extends('layouts.default')



@section('content')

<h1>Gastos Ejecución</h1>

<div class="panel panel-primary">

    <div class="panel-heading">

        <h4 class="panel-title">Busqueda</h4>
        
    </div>

    <div class="panel-body">

        <table class="table datatable">
            <thead>
                <tr>
                    <th>Municipio</th>
                    <th>Porcentaje</th>
                    <th>Usuario</th>
                    <th>Fecha de alta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                <tr>
                    <td>{{$dato->id_municipio}}</td>
                    <td>{{$dato->gasto_ejecucion_porcentaje}}</td>
                    <td>{{$dato->usuario}} </td>
                    <td>{{$dato->f_alta}} </td>
                    <td><a href="actualizar-gastos/{{$dato->id_gasto_ejecucion_municipio}}" class="btn btn-xs btn-warning" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a></td>
                    <td><a href="nuevo-gastos" class="btn btn-xs btn-danger" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>
                    
                </tr>
                @endforeach
            </tbody>


        </table>

        <input class="btn btn-primary nuevo" type="submit" value="Nuevo Perito" onclick=" location.href='nuevo-gastos' " title="Nuevo">


        
    
    </div>
    

</div>
@stop

//////////////////////////////////////////

{{ Form::text('estatus',null, array('class' => 'form-control focus', 'placeholder'=>'Estatus', 'autofocus'=> 'autofocus')) }}