@if(!Auth::guest() && (Auth::user()->hasRole("Administrador") || Auth::user()->can("datos_complementarios")) )
    <li class="dropdown @if(Request::is('complementarios/*')) active @endif">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Datos Complementarios <b class="caret"></b></a>
        <ul role="menu" class="dropdown-menu">
            <li class="@if(Request::is('complementarios')) active @endif">
                <a href="{{URL::to('complementarios')}}">
                    <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                 Captura
                </a>
            </li>
            <li class="divider"></li>
       </ul>
    </li>
@endif