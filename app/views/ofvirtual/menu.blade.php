@if(!Auth::guest() && ( Auth::user()->hasRole("Usuario de Notaría")))
    <li class="@if(Request::is('ofvirtual/notario/registro*')) active @endif">
        <a href="{{URL::to('ofvirtual/notario/registro-escrituras')}}">Registro de Escrituras</a>
    </li>
    <li class="@if(Request::is('ofvirtual/notario/traslado*')) active @endif">
        <a href="{{URL::to('ofvirtual/notario/traslado')}}">Traslado de Dominio</a>
    </li>
    <li class="@if(Request::is('ofvirtual/notario/manifestacion*')) active @endif">
        <a href="{{URL::to('ofvirtual/notario/manifestacion/create')}}">Manifestación Catastral</a>
    </li>
@endif