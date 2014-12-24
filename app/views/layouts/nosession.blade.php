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


    @yield('styles')

</head>
<body >

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

@yield('javascript')

</body>
</html>