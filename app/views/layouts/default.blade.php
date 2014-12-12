<!DOCTYPE html>
<html lang="es_MX">
<head>
<meta charset="UTF-8">
<title>
    @section('title')
        - Sistema Catastral
    @show
</title>
<!-- CDN para CSS bootstrap -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<!-- CDN Para JQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- CDN Para JS Bootstrap -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!-- Estilos temporales para mostrar actividad de carga de datos -->
<style type="text/css">
.spin {
  -webkit-animation: fa-spin 2s infinite linear;
  animation: spin 2s infinite linear;
}
@-webkit-keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
@keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}

</style>

<!-- CDN Para AngularJS -->
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.5/angular.min.js"></script>
<script src="//code.angularjs.org/1.2.27/angular-resource.min.js"></script>
<script src="//code.angularjs.org/1.2.27/angular-sanitize.min.js"></script>
<script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.0.min.js"></script>

@yield('styles')

</head>
<body >


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

    @yield('breadcrumbs')
    @yield('nav')
    @if(isset($title_section))
        <div class="page-header">
          <h1>{{$title_section}} @if(isset($subtitle_section)) <small>{{$subtitle_section}}</small></h1> @endif
        </div>
    @endif
    @yield('content')
</div>

@yield('javascript')

</body>
</html>