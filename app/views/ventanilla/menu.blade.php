@if(!Auth::guest() && (Auth::user()->hasRole("Funcionario ventanilla") || Auth::user()->can("atender_ventanilla")) )

<li class="dropdown @if(Request::is('ventanilla/*')) active @endif">

    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Ventanilla <b class="caret"></b></a>
    <ul role="menu" class="dropdown-menu">

        <li class="@if(Request::is('ventanilla/primera-atencion')) active @endif">
            <a href="{{URL::to('ventanilla/primera-atencion')}}">
                <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                Trámites
            </a>
        </li>

        <li class="divider"></li>


    </ul>
</li>

@endif