@extends('layouts.default')

@section('title')
	{{{ $title }}} :: @parent
@stop

@section('content')

{{ Form::open(array('url' => 'ofvirtual/notario/traslado/create', 'method' => 'GET')) }}
<!--<form id="lista-tipotramites">-->
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
                        <!-- Inputs de clave o cuenta -->
                         <div class="row ">
                            <div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <!-- Select clave o cuenta -->
                                        <div class="input-group-btn">
                                            <button type="button"
                                                    class="btn btn-default dropdown-toggle select-busqueda select-busqueda-"

                                                    data-tipobusqueda="cuenta"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                <span class="dropdown-label">Cuenta</span>
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu tipo-busqueda" role="menu">
                                                <li><a href="javascript:void(0);" class="opcion-buqueda" data-tipo="cuenta">Cuenta</a>
                                                </li>
                                                <li><a href="javascript:void(0);" class="opcion-busqueda" data-tipo="clave">Clave</a></li>
                                            </ul>
                                        </div>

                                        <!-- Select municipios -->
                                        <div class="input-group-btn control-municipios">
                                            <button type="button"
                                                    class="btn btn-default dropdown-toggle select-municipio select-municipio-"
                                                    data-municipio=""
                                                    data-toggle="dropdown" aria-expanded="false">
                                                <span class="dropdown-label">
                                                    @if(count($municipios) == 1)
                                                        {{$municipios[0]->nombre_municipio}} - {{$municipios[0]->municipio}}
                                                    @else
                                                    Municipio

                                                    @endif
                                                </span>
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu municipio" role="menu">
                                                @foreach($municipios as $municipio)
                                                    <li><a href="javascript:void(0);" class="opcion-municipio"
                                                           data-municipio="{{$municipio->municipio}}">{{$municipio->nombre_municipio}}
                                                            - {{$municipio->municipio}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- //Select municipios -->

                                        <!-- Select Urbano o Rustico -->
                                        <div class="input-group-btn control-tipopredio">
                                            <button type="button"
                                                    class="btn btn-default dropdown-toggle select-tipopredio select-tipopredio-"
                                                    data-tipopredio="U"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                <span class="dropdown-label">Urbano</span>
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu tipo-predio" role="menu">
                                                <li><a href="javascript:void(0);" class="opcion-tipopredio" data-tipopredio="R">Rústico</a></li>
                                                <li><a href="javascript:void(0);" class="opcion-tipopredio" data-tipopredio="U">Urbano</a></li>
                                            </ul>
                                        </div>

                                        {{Form::text('clave', null, ['class'=>'form-control clave-catastral', 'style'=>'text-transform: uppercase;'])}}

                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Crear traslado de dominio
                                                <span class="glyphicon glyphicon-search boton-buscador" aria-hidden="true"></span>
                                            </button>
                                        </span>

                                    </div>


                            <!-- /col-md-6 -->
                            <div>
                                <div class="alert alert-danger" style="display: none;">
                                    No se encontró el predio solicitado en el padrón.
                                </div>
                            </div>
                        <!-- //Inputs de clave o cuenta -->
           </div></div></div>      </div>
<!--</form>-->



{{ Form::close() }}



{{ HTML::style('css/forms.css') }}

    <div class="row">
        @include('ofvirtual.notario.traslado._list', compact('traslados'))
    </div><!-- /.row -->


@stop


@section('javascript')
    {{ HTML::script('js/laroute.js') }}
    {{ HTML::script('js/jquery/jquery.mask.min.js') }}
    {{ HTML::script('js/ventanilla/primera-atencion.js') }}
    @if(count($municipios) == 1)
    <script>
        $(function () {
            var municipio = "{{$municipios[0]->municipio}}";
            $('.select-municipio').data('municipio', municipio);
         });
    </script>
    @endif
@append


