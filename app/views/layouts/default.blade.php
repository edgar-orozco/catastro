<!DOCTYPE html>
<html lang="es_MX">
<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            - Sistema de Gestión Catastral
        @show
    </title>
    <link rel="icon" type="image/png" href="/css/images/main/favicon.png">
    <!-- CSS bootstrap -->
    {{ HTML::style('css/bootstrap.css') }}

    <!-- css general de la app -->
    {{ HTML::style('css/general.css') }}

    <!-- Navbar css custom menu -->
    {{ HTML::style('css/navmenu.css') }}
    {{ HTML::style('css/header.css') }}
    {{ HTML::style('css/footer.css') }}
    <!-- CSS del  Lock Screen -->
    {{ HTML::style('css/lockscreen.css') }}


    {{ HTML::style('css/geoCatastro.css') }}
    <style>
        @yield('styles')
        .navbar-custom{
            border: none;
        }
        .navbar-custom .navbar-nav > .active > a, .navbar-custom .navbar-nav > .active > a:hover, .navbar-custom .navbar-nav > .active > a:focus{
            color:white !important;
        }
        .container{
            margin-top: 40px;
        }
    </style>

    <!-- JQuery -->
    {{ HTML::script('js/jquery/jquery.min.js') }}

    <!-- JS Bootstrap -->
    {{ HTML::script('js/bootstrap.min.js') }}

</head>
<body>
<header class="catatro-df">
    <div class="container">
        <div class="col-lg-8 col-md-8 col-sm-6">
            <div class="img-cont">
                <img src="/css/images/main/main-logo.png" alt="Catastro">
            </div>
            <div class="img-cont spf">
                <img src="/css/images/main/logo-spf.png" alt="SPF">
            </div>
            <div class="img-cont catastro">
                <img src="/css/images/main/logo-header.png" alt="Catastro">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <ul class="social">
                <li><a href="https://www.facebook.com/gobiernodetabasco" target="_blank" class="facebook"></a></li>
                <li><a href="https://twitter.com/Gobierno_Tab" target="_blank" class="twitter"></a></li>
                <li><a href="https://www.flickr.com/photos/93709152@N04" target="_blank" class="plus"></a></li>
                <li><a href="https://www.youtube.com/user/ArturoNunezTV" target="_blank" class="youtube"></a></li>
            </ul>
        </div>
    </div>
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
</header>
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
            <h3>
                {{$title_section}}
            </h3>
            @if(isset($subtitle_section))
                <h4>{{$subtitle_section}}</h4>
            @endif
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
<footer>
    <div class="container">
        <div class="col-md-4 col-lg-4 col-sm-4">
            <h2>Gobierno de <b>Tabasco</b></h2>
            <ul>
                <li>
                    <a href="/users/login">Portal Transparencia</a>
                </li>
                <li>
                    <a href="/users/login">ITAIP</a>
                </li>
                <li>
                    <a href="/users/login">Infomex</a>
                </li>
                <li>
                    <a href="/users/login">Aviso de Privacidad</a>
                </li>
                <li>
                    <a href="/users/login">Buzón</a>
                </li>
            </ul>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4">
            <h2>Dirección / <b>Ubicación</b></h2>
            <p>
                Independencia No. 2, Col. Centro Palacio, <br>
                de Gobierno, C.P. 86000 Villahermosa, <br>
                Tabasco, MX. <br>
                Tel. (993) 358 0400
            </p>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4">
            <h2>Contactanos / <b>Comenta</b></h2>

            <form action="">
                <input type="text" placeholder="Nombre">
                <input type="text" placeholder="Email">
                <input type="text" placeholder="Teléfono">
                <textarea name="" id="" cols="30" rows="10" placeholder="Comentarios"></textarea>
                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>
</footer>
<div class="footer legal container">
    <div class="col-sm-8 col-md-8 col-lg-8">
        <p><b>Gobierno del Estado de Tabasco © Derechos Reservados 2013 - 2018</b><br>
            Dirección General de Tecnologías de Información y Comunicaciones</p>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-4">
        <div class="img-cont">
            <img src="/css/images/main/main-logo.png" alt="Catastro">
        </div>
    </div>
</div>

<!-- Lock Screen -->
@include('layouts._lockscreen')


<!-- AngularJS -->
{{ HTML::script('js/angular/angular.js') }}
{{ HTML::script('js/angular/angular-resource.js') }}
{{ HTML::script('js/angular/angular-sanitize.js') }}
{{ HTML::script('js/angular/angular-animate.js') }}
{{ HTML::script('js/ui-bootstrap.js') }}
<!-- JS del Lock Screen -->
{{ HTML::script('js/lockscreen.js') }}

@yield('javascript')

</body>
</html>