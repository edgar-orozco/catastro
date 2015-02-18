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
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/header.css') }}

    @yield('styles')

</head>
<body >
<header class="catatro-df">
    <div class="container">
        <div class="col-lg-8 col-md-8 col-sm-6">
            <div class="img-cont">
                <img src="css/images/main/main-logo.png" alt="Catastro">
            </div>
            <div class="img-cont spf">
                <img src="css/images/main/logo-spf.png" alt="SPF">
            </div>
            <div class="img-cont catastro">
                <img src="css/images/main/logo-header.png" alt="Catastro">
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

<!-- JQuery -->
{{ HTML::script('js/jquery/jquery.min.js') }}

<!-- JS Bootstrap -->
{{ HTML::script('js/bootstrap.min.js') }}

@yield('javascript')

</body>
</html>