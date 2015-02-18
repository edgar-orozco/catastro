<!DOCTYPE html>
<html lang="es_MX">
<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            - Sistema de Gestión Catastral
        @show
    </title>
    <link rel="icon" type="image/png" href="http://104.236.22.240/css/images/main/favicon.png">
    <!-- CDN para CSS bootstrap -->
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/header.css') }}

    @yield('styles')

</head>
<body >
<header class="catatro-df">
    <div class="container">
        <div class="col-lg-8 col-md-8 col-sm-6">
            <div class="img-cont">
                <img src="http://104.236.22.240/css/images/main/main-logo.png" alt="Catastro">
            </div>
            <div class="img-cont spf">
                <img src="http://104.236.22.240/css/images/main/logo-spf.png" alt="SPF">
            </div>
            <div class="img-cont catastro">
                <img src="http://104.236.22.240/css/images/main/logo-header.png" alt="Catastro">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <ul class="social">
                <li><a href="http://104.236.22.240/users/login" class="facebook"></a></li>
                <li><a href="http://104.236.22.240/users/login" class="twitter"></a></li>
                <li><a href="http://104.236.22.240/users/login" class="plus"></a></li>
                <li><a href="http://104.236.22.240/users/login" class="youtube"></a></li>
            </ul>
        </div>
    </div>


</header>
<div class="container">
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

    @yield('content')
</div>
<footer>
    <div class="container">
        <div class="col-md-4 col-lg-4 col-sm-4">
            <h2>Gobierno de <b>Tabasco</b></h2>
            <ul>
                <li>
                    <a href="http://104.236.22.240/users/login">Portal Transparencia</a>
                </li>
                <li>
                    <a href="http://104.236.22.240/users/login">ITAIP</a>
                </li>
                <li>
                    <a href="http://104.236.22.240/users/login">Infomex</a>
                </li>
                <li>
                    <a href="http://104.236.22.240/users/login">Aviso de Privacidad</a>
                </li>
                <li>
                    <a href="http://104.236.22.240/users/login">Buzón</a>
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
            <img src="http://104.236.22.240/css/images/main/main-logo.png" alt="Catastro">
        </div>
    </div>
</div>

<!-- JQuery -->
{{ HTML::script('js/jquery/jquery.min.js') }}

<!-- JS Bootstrap -->
{{ HTML::script('js/bootstrap.min.js') }}

@yield('javascript')

</body>
</html>