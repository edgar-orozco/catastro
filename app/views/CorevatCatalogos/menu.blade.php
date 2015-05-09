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
	</ul>
</li>

@endif