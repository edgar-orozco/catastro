@if(!Auth::guest() && (
            Auth::user()->can("consulta_cartografica")
            ||
            Auth::user()->can("complementarios")
            )
    )

    <li class="dropdown">

        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Productos cartográficos <b class="caret"></b></a>

        <ul role="menu" class="dropdown-menu">
            <li>
                <a href="{{URL::to('cartografia/consultas')}}">
                    <i class="glyphicon glyphicon-globe"></i>&nbsp;
                    Consulta cartográfica
                </a>
            </li>

            <li>
                <a href="{{URL::to('compleme')}}">
                    <i class="glyphicon glyphicon-list"></i>&nbsp;
                    Captura de datos complementarios
                </a>
            </li>

        </ul>

    </li>
@endif