@if(!Auth::guest() && ( Auth::user()->hasRole("Administrador") || Auth::user()->hasRole("Super usuario")))
    <li class="dropdown @if(Request::is('corevat/*')) active @endif">

        <a data-toggle="dropdown" class="dropdown-toggle" href="#">COREVAT<b class="caret"></b></a>
        <ul role="menu" class="dropdown-menu">

            <li class="dropdown @if(Request::is('Corevat/*')) active @endif">
                <a href="{{URL::to('corevat/Avaluos')}}">Avaluos</a>
            </li>



            <li class="dropdown-submenu @if(Request::is('Ejecucion/*')) active @endif">

                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Folios </a>
                <ul role="menu" class="dropdown-menu">

                    <li class="@if(Request::is('nfolios')) active @endif">
                        <a href="{{URL::to('/nfolios')}}">
                            <i class="glyphicon glyphicon-th-list"></i>&nbsp;
                            Nuevo Folio
                        </a>
                    </li>


                    <li class="@if(Request::is('foliosemitidos')) active @endif">
                        <a href="{{URL::to('/foliosemitidos')}}">
                            <i class="glyphicon glyphicon-lock"></i>&nbsp;
                            Folios Emitidos
                        </a>
                    </li>

                    <li class="divider"></li>

                    <li class="@if(Request::is('entregafoliosmunicipal')) active @endif">
                        <a href="{{URL::to('/entregafoliosmunicipal')}}">
                            <i class="glyphicon glyphicon-user"></i>&nbsp;
                            Folios Autorizados
                        </a>
                    </li>


                    <li class="@if(Request::is('entregafoliosestatal')) active @endif">
                        <a href="{{URL::to('/entregafoliosestatal')}}">
                            <i class="glyphicon glyphicon-open"></i>&nbsp;
                            Entrega Folios Estatal
                        </a>
                    </li>

                    <li class="divider"></li>


                    <li class="@if(Request::is('catalogos/peritos/index')) active @endif">
                        <a href="{{URL::to('catalogos/peritos/index')}}">
                            <i class="glyphicon glyphicon-user"></i>&nbsp;
                            Peritos
                        </a>
                    </li>

                    <li class="divider"></li>

                    <li class="@if(Request::is('/reporteperito')) active @endif">
                        <a href="{{URL::to('/reporteperito')}}">
                            <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                            Reporte Perito
                        </a>
                    </li>

                    <li class="@if(Request::is('/reportemensual')) active @endif">
                        <a href="{{URL::to('/reportemensual')}}">
                            <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                            Reporte Mensual
                        </a>
                    </li>

                    <li class="@if(Request::is('/reportetotal')) active @endif">
                        <a href="{{URL::to('/reportetotal')}}">
                            <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                            Reporte Total
                        </a>
                    </li>

                    <li class="divider"></li>


                    <li class="@if(Request::is('/configuraciones')) active @endif">
                        <a href="{{URL::to('/configuraciones')}}">
                            <i class="glyphicon glyphicon-tags"></i>&nbsp;
                            Configuracion de Oficios
                        </a>
                    </li>

                </ul>
            </li>





            <li class="dropdown-submenu @if(Request::is('CorevatCatalogos/*') && Request::is('Corevat/*')) active @endif">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">CATALOGOS</a>
                <ul role="menu" class="dropdown-menu">
                    <li class="@if(Request::is('corevat/Empresas')) active @endif">
                        <a href="{{URL::to('corevat/Empresas')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Empresas</a>
                    </li>
                    <li class="@if(Request::is('corevat/Estados')) active @endif">
                        <a href="{{URL::to('corevat/Estados')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Estados</a>
                    </li>
                    <li class="@if(Request::is('corevat/Municipios')) active @endif">
                        <a href="{{URL::to('corevat/Municipios')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Municpios</a>
                    </li>
                    <li class="@if(Request::is('corevat/Usuarios')) active @endif">
                        <a href="{{URL::to('corevat/Usuarios')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Usuarios</a>
                    </li>
					<hr>
                    <li class="@if(Request::is('corevat/CatTituloPersona')) active @endif">
                        <a href="{{URL::to('corevat/CatTituloPersona')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Título Persona</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatFinalidad')) active @endif">
                        <a href="{{URL::to('corevat/CatFinalidad')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Finalidad</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown-submenu @if(Request::is('CorevatCatalogos/*')) active @endif">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">PARAMETROS</a>
                <ul role="menu" class="dropdown-menu">
                    <li class="@if(Request::is('corevat/CatAplanados')) active @endif">
                        <a href="{{URL::to('corevat/CatAplanados')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Aplanados</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatBardas')) active @endif">
                        <a href="{{URL::to('corevat/CatBardas')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Bardas</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatCalidadProyecto')) active @endif">
                        <a href="{{URL::to('corevat/CatCalidadProyecto')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Calidad del Proyecto</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatCimentaciones')) active @endif">
                        <a href="{{URL::to('corevat/CatCimentaciones')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Cimentaciones</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatClaseGeneralInmueble')) active @endif">
                        <a href="{{URL::to('corevat/CatClaseGeneralInmueble')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Clase General Inmueble</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatClasificacionZona')) active @endif">
                        <a href="{{URL::to('corevat/CatClasificacionZona')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Clasificación por Zona</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatConstrucciones')) active @endif">
                        <a href="{{URL::to('corevat/CatConstrucciones')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Construcciones</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatEntrepisos')) active @endif">
                        <a href="{{URL::to('corevat/CatEntrepisos')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Entrepisos</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatEstadoConservacion')) active @endif">
                        <a href="{{URL::to('corevat/CatEstadoConservacion')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Estados de Conservación</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatEstructuras')) active @endif">
                        <a href="{{URL::to('corevat/CatEstructuras')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Estructuras</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatMuros')) active @endif">
                        <a href="{{URL::to('corevat/CatMuros')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Muros</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatNiveles')) active @endif">
                        <a href="{{URL::to('corevat/CatNiveles')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Niveles</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatObrasComplementarias')) active @endif">
                        <a href="{{URL::to('corevat/CatObrasComplementarias')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Obras Complementarias</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatOrientaciones')) active @endif">
                        <a href="{{URL::to('corevat/CatOrientaciones')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Orientaciones</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatPisos')) active @endif">
                        <a href="{{URL::to('corevat/CatPisos')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Pisos</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatPlafones')) active @endif">
                        <a href="{{URL::to('corevat/CatPlafones')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Plafones</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatProximidadUrbana')) active @endif">
                        <a href="{{URL::to('corevat/CatProximidadUrbana')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Proximidad Urbana</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatRegimenPropiedad')) active @endif">
                        <a href="{{URL::to('corevat/CatRegimenPropiedad')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Regimen Prioridad</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatTechos')) active @endif">
                        <a href="{{URL::to('corevat/CatTechos')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Techos</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatTipo')) active @endif">
                        <a href="{{URL::to('corevat/CatTipo')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Tipos</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatTipoInmueble')) active @endif">
                        <a href="{{URL::to('corevat/CatTipoInmueble')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Tipo de Inmueble</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatUsosSuelos')) active @endif">
                        <a href="{{URL::to('corevat/CatUsosSuelos')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Uso de Suelo</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown-submenu @if(Request::is('CorevatCatalogos/*')) active @endif">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">FACTORES</a>
                <ul role="menu" class="dropdown-menu">
                    <li class="@if(Request::is('corevat/CatFactoresConservacion')) active @endif">
                        <a href="{{URL::to('corevat/CatFactoresConservacion')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Conservación</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatFactoresForma')) active @endif">
                        <a href="{{URL::to('corevat/CatFactoresForma')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Forma</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatFactoresFrente')) active @endif">
                        <a href="{{URL::to('corevat/CatFactoresFrente')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Frente</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatFactoresSuperficie')) active @endif">
                        <a href="{{URL::to('corevat/CatFactoresSuperficie')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Superficie</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatFactoresUbicacion')) active @endif">
                        <a href="{{URL::to('corevat/CatFactoresUbicacion')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Ubicación</a>
                    </li>
                    <li class="@if(Request::is('corevat/CatFactoresZonas')) active @endif">
                        <a href="{{URL::to('corevat/CatFactoresZonas')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Zonas</a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
@endif


@if(!Auth::guest() && ( Auth::user()->hasRole("Perito Valuador")))
    <li class="@if(Request::is('corevat/Avaluos/create')) active @endif">
        <a href="{{URL::to('corevat/Avaluos/create')}}">Registrar Avalúo</a>
    </li>
    <li class="@if(Request::is('corevat/Avaluos')) active @endif">
        <a href="{{URL::to('corevat/Avaluos')}}">Listar Avalúos</a>
    </li>
@endif