@if(!Auth::guest() && ( Auth::user()->can("solicitud_kioskos") || Auth::user()->can("seguimiento_kioskos")))
<li class="dropdown @if(Request::is('kiosko/*')) active @endif">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Kiosko<b class="caret"></b></a>
    <ul role="menu" class="dropdown-menu">
        <li class="@if(Request::is('kiosko/solicitud')) active @endif">
            <a href="{{URL::to('kiosko/solicitud')}}">
                <i class="glyphicon glyphicon-th-list"></i>&nbsp;
                Solicitud
            </a>
        </li>
        <li class="@if(Request::is('ventanilla/imprimir-catalogo-tramites')) active @endif">
            <a href="{{URL::to('ventanilla/imprimir-catalogo-tramites')}}" target="_blank">
                <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                Trámites y Precios
            </a>
        </li>
        <li class="@if(Request::is('kiosko/consulta-boleta-predial')) active @endif">
            <a href="{{URL::to('kiosko/consulta-boleta-predial')}}">
                <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                Cálculo Predial
            </a>
        </li>
    </ul>
@endif
