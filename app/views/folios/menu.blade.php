@if(!Auth::guest() && ( Auth::user()->hasRole("Folios") || Auth::user()->hasRole("Folios")))

    <li class="dropdown @if(Request::is('Ejecucion/*')) active @endif">

        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Folios <b class="caret"></b></a>
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


            <li class="@if(Request::is('catalogos/peritos/tablaperitos')) active @endif">
                <a href="{{URL::to('catalogos/peritos/tablaperitos')}}">
                <i class="glyphicon glyphicon-tags"></i>&nbsp;
                    Peritos
                </a>
            </li>
        </ul>
    </li>

@endif

@if(!Auth::guest() && ( Auth::user()->hasRole("Folios usuario") || Auth::user()->hasRole("Folios usuarios")))

    <li class="dropdown @if(Request::is('Ejecucion/*')) active @endif">

        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Folios <b class="caret"></b></a>
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

           
            
            
			

            <li class="@if(Request::is('entregafoliosestatal')) active @endif">
                <a href="{{URL::to('/entregafoliosestatal')}}">
                <i class="glyphicon glyphicon-open"></i>&nbsp;
                    Entrega Folios Estatal
                </a>
            </li>

            <li class="divider"></li>
        </ul>
    </li>
@endif

@if(!Auth::guest() && ( Auth::user()->hasRole("Folios municipio") || Auth::user()->hasRole("Folio municipio")))
    <li class="dropdown @if(Request::is('Ejecucion/*')) active @endif">

        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Folios <b class="caret"></b></a>
        <ul role="menu" class="dropdown-menu">
            
			<li class="divider"></li>
                        
            <li class="@if(Request::is('entregafoliosestatal')) active @endif">
                <a href="{{URL::to('/entregafoliosestatal')}}">
                <i class="glyphicon glyphicon-open"></i>&nbsp;
                    Entrega Folios Estatal
                </a>
            </li>

            <li class="divider"></li>
        </ul>
    </li>
@endif