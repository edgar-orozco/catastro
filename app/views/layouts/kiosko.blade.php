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
    <!-- CDN para CSS bootstrap -->
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/header.css') }}
    {{ HTML::style('css/footer.css') }}

    @yield('styles')

    <!-- JQuery -->
    {{ HTML::script('js/jquery/jquery.min.js') }}

    <!-- JS Bootstrap -->
    {{ HTML::script('js/bootstrap.min.js') }}
</head>
<body>

@include('layouts._header');

<div class="container">
    @include('layouts._flash_messages')

    @yield('content')
</div>


@include('layouts._footer')

@yield('javascript')

</body>
</html>