<!DOCTYPE html>
<html lang="es_MX">
<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            - Sistema de Gestión Catastral
        @show
    </title>
    <!-- CDN para CSS bootstrap -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

    <!-- CDN Para JQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- CDN Para JS Bootstrap -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- CDN Para AngularJS -->
    <script src="//code.angularjs.org/1.3.5/angular.js"></script>
    <script src="//code.angularjs.org/1.3.5/angular-resource.min.js"></script>
    <script src="//code.angularjs.org/1.3.5/angular-sanitize.min.js"></script>
    <script src="//code.angularjs.org/1.3.5/angular-animate.min.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.0.min.js"></script>

    <!-- css general de la app -->
    {{ HTML::style('css/general.css') }}

    <!-- Navbar css custom menu -->
    {{ HTML::style('css/navmenu.css') }}

    <style>
        @yield('styles')
    </style>

</head>
<body>

@section('navbar')
    <nav role="navigation" class="navbar navbar-custom" id="top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{URL::to('/')}}" class="navbar-brand">Sistema de Gestión Catastral</a>
            </div>

            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="@if(Request::is('/')) active @endif">
                        <a href="{{URL::to('/')}}">
                            <i class="glyphicon glyphicon-home"></i>
                        </a>
                    </li>

                    @yield('menu', App::make('Menu'))

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="glyphicon glyphicon-user"></i>
                            <b class="caret"></b>
                        </a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="{{ URL::action('ProfileController@index') }}">Mis datos</a></li>
                            <li><a href="{{ URL::action('ProfileController@edit') }}">Modificar cuenta</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#confirm-logout" title="Salir del sistema">
                            <i class="glyphicon glyphicon-log-out"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@show

<div class="container"  @yield('angular')>

    @if(Session::has('error'))
        <div class="alert alert-danger">
            @if(is_array(Session::get('error')))
                @foreach(Session::get('error') as $error )
                    <h4><span class="glyphicon glyphicon-remove"></span>  {{ $error }}</h4>
                @endforeach
            @else
                <h4><span class="glyphicon glyphicon-remove"></span>  {{ Session::get('error') }}</h4>
            @endif
        </div>
    @endif

    @if (Session::get('notice'))
        <div class="alert alert-notice">
            <h4><span class="glyphicon glyphicon-info-sign"></span>  {{ Session::get('notice') }}</h4>
        </div>
    @endif

    @if (Session::get('success'))
        <div class="alert alert-success">
            <h4><span class="glyphicon glyphicon-ok"></span>  {{ Session::get('success') }}</h4>
        </div>
    @endif

    @if(isset($title_section))
        <div class="page-header">
            <h2>{{$title_section}}
                @if(isset($subtitle_section))
                    <small>{{$subtitle_section}}</small> @endif
            </h2>
        </div>
    @endif

    @yield('breadcrumbs')
    @yield('content')
</div>

<!-- Modal para confirmar cuando se da click en menu logout -->
<div class="modal fade" id="confirm-logout" tabindex="-1" role="dialog" aria-labelledby="confirm-logout"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="confirm-logout-title">Confirme la acción:</h4>
            </div>
            <div class="modal-body">
                <h4 style="text-align: center">¿Realmente desea salir del sistema?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <a href="{{URL::action('UsersController@getLogout')}}" class="btn btn-primary">Salir</a>
            </div>
        </div>
    </div>
</div>

@yield('javascript')

</body>
</html>