@extends('layouts.default')
@section('title')

@stop
@section('content')
<style>
    #map-canvas {
        height: 30%;
        margin: 0px;
        padding: 0px
    }
</style>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Datos Complementarios</div>

    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Clave</th>
                <th>Superficie Terreno</th>
                <th>Superficie Construcion</th>
                <th>Tipo de Predio</th>
                <th>Propietario</th>
                <th>Tipo Propiedad</th>
                <th>Entidad</th>
                <th>Municipio</th>
            </tr>
        </thead>
        <tbody>
            <tr>    
                @foreach($predios as $predio)             
                <th scope="row">{{$predio->clave}}</th>
                <td>{{$predio->superficie_terreno}}</td>
                <td>{{$predio->superficie_construccion}}</td>
                <td>{{$predio->tipo_predio}}</td>
                <td>{{$predio->id_propietario}}</td>
                <td>{{$predio->tipo_propiedad}}</td>
                <td>{{$predio->nombre_entidad}}</td>
                <td>{{$predio->nombre_municipio }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
<div style="float: right;margin-top: -7px;margin-right: -66px;">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15179.10423749334!2d-92.83543432609864!3d17.989152844348357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2smx!4v1423185076690" width="600" height="450" frameborder="0" style="border:0"></iframe>  
</div>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false" style="width: 600px;">
    <!--otro -->
    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading-{{1}}">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                   href="#collapse-{{1}}" aria-expanded="false"
                   aria-controls="collapse-{{1}}">
                       <?php echo 'Construcciones' ?>
                </a>
            </h4>
        </div>
        <div id="collapse-{{1}}" class="panel-collapse collapse" role="tabpanel"
             aria-labelledby="heading-{{1}}">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            @include('complementarios.complementos.construcciones')

                        </div><!-- /input-group -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--otro -->
    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading-{{2}}">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                   href="#collapse-{{2}}" aria-expanded="false"
                   aria-controls="collapse-{{2}}">
                       <?php echo 'Instalaciones Especiales' ?>
                </a>
            </h4>
        </div>
        <div id="collapse-{{2}}" class="panel-collapse collapse" role="tabpanel"
             aria-labelledby="heading-{{2}}">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <!--Instalaciones-->
                            @include('complementarios.complementos.instalacion')
                        </div><!-- /input-group -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--otro -->
    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading-{{3}}">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                   href="#collapse-{{3}}" aria-expanded="false"
                   aria-controls="collapse-{{3}}">
                       <?php echo 'Condominios' ?>
                </a>
            </h4>
        </div>
        <div id="collapse-{{3}}" class="panel-collapse collapse" role="tabpanel"
             aria-labelledby="heading-{{3}}">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">

                            @include('complementarios.complementos.condominio')
                        </div><!-- /input-group -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--otro --> 
    <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading-{{4}}">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                   href="#collapse-{{4}}" aria-expanded="false"
                   aria-controls="collapse-{{4}}">
                       <?php echo 'Servicios' ?>
                </a>
            </h4>
        </div>
        <div id="collapse-{{4}}" class="panel-collapse collapse" role="tabpanel"
             aria-labelledby="heading-{{4}}">
            <div class="panel-body">
                <div class="row">
                    <div style=width:105%;">
                        <div class="input-group">
                            @include('complementarios.complementos.servicio')
                        </div><!-- /input-group -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@stop
