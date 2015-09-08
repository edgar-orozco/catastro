@if(!Auth::guest() && ( Auth::user()->hasRole("Administrador") || Auth::user()->hasRole("Super usuario")))

<li class="dropdown @if(Request::is('admin/*')) active @endif">

    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Administrar <b class="caret"></b></a>
    <ul role="menu" class="dropdown-menu">

        <li class="@if(Request::is('admin/user')) active @endif">
            <a href="{{URL::to('admin/user')}}">
                <i class="glyphicon glyphicon-user"></i>&nbsp;
                Usuarios
            </a>
        </li>
        <li class="@if(Request::is('admin/usuarios/notaria')) active @endif">
            <a href="{{URL::to('admin/usuarios/notaria')}}">
                <i class="glyphicon glyphicon-user"></i>&nbsp;
                Usuarios Notaria
            </a>
        </li>
        <li class="@if(Request::is('admin/usuarios/perito')) active @endif">
            <a href="{{URL::to('admin/usuarios/perito')}}">
                <i class="glyphicon glyphicon-user"></i>&nbsp;
                Usuarios Perito
            </a>
        </li>
        <li class="divider"></li>
        <li class="@if(Request::is('admin/permission')) active @endif">
            <a href="{{URL::to('admin/permission')}}">
                <i class="glyphicon glyphicon-lock"></i>&nbsp;
                Permisos
            </a>
        </li>
        <li class="@if(Request::is('admin/role')) active @endif">
            <a href="{{URL::to('admin/role')}}">
                <i class="glyphicon glyphicon-tags"></i>&nbsp;
                Roles
            </a>
        </li>

        <li class="divider"></li>

        <li class="@if(Request::is('admin/tipotramites')) active @endif">
            <a href="{{URL::to('admin/tipotramites')}}">
                <i class="glyphicon glyphicon-th-list"></i>&nbsp;
                Catálogo de trámites
            </a>
        </li>

        <li class="@if(Request::is('admin/requisitos')) active @endif">
            <a href="{{URL::to('admin/requisitos')}}">
                <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                Requisitos de trámites
            </a>
        </li>
        
        <li class="@if(Request::is('admin/notaria')) active @endif">
            <a href="{{URL::to('admin/notaria')}}">
                <i class="glyphicon glyphicon-th-list"></i>&nbsp;
                Catálogo de notarias
            </a>
        </li>
        <li class="divider"></li>

        <li class="@if(Request::is('admin/carga-shapes')) active @endif">
            <a href="{{URL::to('admin/carga-shapes')}}">
                <i class="glyphicon glyphicon-cloud-upload"></i>&nbsp;
                Carga Cartográfica
            </a>
        </li>
        <li class="divider"></li>
        <li class="dropdown-submenu @if(Request::is('admin/auditor')) active @endif">
            <a data-toggle="dropdwon" class="dropdown-toggle" href="#">Auditoria</a>
            <ul role="menu" class="dropdown-menu">
                <li class="@if(Request::is('admin/auditor')) active @endif">
                    <a href="{{URL::to('admin/auditor')}}">
                        <i class="glyphicon glyphicon-user"></i>&nbsp;
                        Movimientos usuarios
                    </a>
                </li>
                <li class="@if(Request::is('admin/laravel-log*')) active @endif">
                    <a href="{{URL::to('admin/laravel-log')}}">
                        <i class="glyphicon glyphicon-fire"></i>&nbsp;
                        Audita bitácora de servidor
                    </a>
                </li>
            </ul>
        </li>
        @if(in_array(App::environment(), ['local','staging']))
        <li class="divider"></li>

        <li class="@if(Request::is('admin/ejecuta-seeds')) active @endif">
            <a href="{{URL::to('admin/ejecuta-seeds')}}">
                <i class="glyphicon glyphicon-cog"></i>&nbsp;
                Ejecuta seeders (desarrollo)
            </a>
        </li>
        @endif
    </ul>
</li>

@endif
