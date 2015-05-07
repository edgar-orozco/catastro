@if(!Auth::guest() && ( Auth::user()->hasRole("Administrador") || Auth::user()->hasRole("Super usuario")))

<li class="dropdown @if(Request::is('CorevatCatalogos/*') || Request::is('Corevat/*')) active @endif">
	<a data-toggle="dropdown" class="dropdown-toggle" href="#">COREVAT<b class="caret"></b></a>
	<ul role="menu" class="dropdown-menu">
		<li class="@if(Request::is('corevat/CatAplanados')) active @endif">
			<a href="{{URL::to('corevat/CatAplanados')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Aplanados</a>
		</li>
	</ul>
</li>

@endif