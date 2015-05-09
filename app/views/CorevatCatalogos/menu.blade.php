@if(!Auth::guest() && ( Auth::user()->hasRole("Administrador") || Auth::user()->hasRole("Super usuario")))

<li class="dropdown @if(Request::is('CorevatCatalogos/*') || Request::is('Corevat/*')) active @endif">
	<a data-toggle="dropdown" class="dropdown-toggle" href="#">COREVAT<b class="caret"></b></a>
	<ul role="menu" class="dropdown-menu">
		<li class="@if(Request::is('corevat/Empresas')) active @endif">
			<a href="{{URL::to('corevat/Empresas')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Empresas</a>
		</li>
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
		<li class="@if(Request::is('corevat/CatFactoresConservacion')) active @endif">
			<a href="{{URL::to('corevat/CatFactoresConservacion')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Factores de Conservación</a>
		</li>
		<li class="@if(Request::is('corevat/CatFactoresForma')) active @endif">
			<a href="{{URL::to('corevat/CatFactoresForma')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Factores de Forma</a>
		</li>
		<li class="@if(Request::is('corevat/CatFactoresFrente')) active @endif">
			<a href="{{URL::to('corevat/CatFactoresFrente')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Factores Frente</a>
		</li>
		<li class="@if(Request::is('corevat/CatFactoresSuperficie')) active @endif">
			<a href="{{URL::to('corevat/CatFactoresSuperficie')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Factores Superficie</a>
		</li>
		<li class="@if(Request::is('corevat/CatFactoresUbicacion')) active @endif">
			<a href="{{URL::to('corevat/CatFactoresUbicacion')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Factores Ubicación</a>
		</li>
		<li class="@if(Request::is('corevat/CatFactoresZonas')) active @endif">
			<a href="{{URL::to('corevat/CatFactoresZonas')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Factores Zonas</a>
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

@endif
