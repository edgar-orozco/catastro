<html>
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
    {{ HTML::style('css/geoCatastro.css') }}
    <!-- JQuery -->
    {{ HTML::script('js/jquery/jquery.min.js') }}
    <!-- JS Bootstrap -->
    {{ HTML::script('js/bootstrap.min.js') }}
</head>
<body>
<div class="container">
    @yield('content')
</div>
@yield('javascript')
</body>
</html>