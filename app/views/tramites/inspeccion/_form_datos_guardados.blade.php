
{{ HTML::style('js/jquery/jquery-ui.css') }}

{{ HTML::style('css/bootstrap.css') }}
    <!-- css general de la app -->
    {{ HTML::style('css/general.css') }}
    {{ HTML::style('css/geoCatastro.css') }}

    {{--ver el componente de selección de fechas aún cuando no esté usando chrome--}}



    {{ HTML::style('css/select2.min.css') }}
    {{ HTML::style('css/datepicker3.css') }}


<div class="row">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Datos Caprutados</h3>
    </div>
</div>
<div class="row col-md-6">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Datos Porpietario</h3>
    </div>

    <div class="row-fluid panel-body">
        <div class="col-md-6">
            <h4>{{Form::label('nombre','Nombre')}}</h4>
            <h6>{{ $persona->nombres.' '.$persona->apellido_paterno.' '.$persona->apellido_materno}}</h6>

        </div>
        <div class="col-md-6">
        <h4>{{Form::label('curp','Curp')}}</h4>
        <h6>{{ $persona->curp }}</h6>



        </div>

</div>
</div>
</div>

<div class="row col-md-6">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Datos Domicilio</h3>
    </div>

    <div class="row-fluid panel-body">
        <div class="col-md-4">
        <h4>{{Form::label('vialidad','Vialidad')}}</h4>
        <h6>{{ $domicilio->vialidad }}</h6>


        </div>
        <div class="col-md-4">
        <h4>{{Form::label('Numero','Número Ext')}}</h4>
        <h6>{{ $domicilio->num_ext }}</h6>

        </div>
        <div class="col-md-4">
        <h4>{{Form::label('num','Número Int')}}</h4>
         <h6>{{ $domicilio->num_int }}</h6>

        </div>

</div>
</div>
</div>

<div class="row col-md-6">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Datos Del Predio</h3>
    </div>

    <div class="row-fluid panel-body">
        <div class="col-md-6">
            {{Form::label('Superficie ','Superficie  Del Terreno')}}
            <h6>{{ $manifestacion->sup_terreno }}</h6>

        </div>
        <div class="col-md-6">
            {{Form::label('con','Superficie Construccion')}}
            <h6>{{ $manifestacion->sup_construccion }}</h6>
        </div>

</div>
</div>
</div>

    <div class="col-md-12">
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 <h2>Los datos se guardaron correctamente.</h2>
</div>
</div>
</div>
