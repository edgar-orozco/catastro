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

.fadein, .fadeout {
  -webkit-transition:all cubic-bezier(0.250, 0.460, 0.450, 0.940) .2s;
  -moz-transition:all cubic-bezier(0.250, 0.460, 0.450, 0.940) .2s;
  -o-transition:all cubic-bezier(0.250, 0.460, 0.450, 0.940) .2s;
  transition:all cubic-bezier(0.250, 0.460, 0.450, 0.940) .2s;
}

.fadein.ng-hide-remove, .fadeout.ng-hide-add.ng-hide-add-active {
  opacity: 0;
  display: block !important;
}

.fadeout.ng-hide-add, .fadein.ng-hide-remove.ng-hide-remove-active {
  opacity: 1;
  display: block !important;
}

</style>

<!-- CDN Para AngularJS -->
<script src="//code.angularjs.org/1.3.5/angular.js"></script>
<script src="//code.angularjs.org/1.3.5/angular-resource.min.js"></script>
<script src="//code.angularjs.org/1.3.5/angular-sanitize.min.js"></script>
<script src="//code.angularjs.org/1.3.5/angular-animate.min.js"></script>
<script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.0.min.js"></script>


@yield('styles')

</head>
<body >

<nav role="navigation" class="navbar navbar-default">
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

                @yield('menu')

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="glyphicon glyphicon-user"></i>
                        <b class="caret"></b>
                    </a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">Mis datos</a></li>
                        <li><a href="#">Modificar cuenta</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#confirm-logout">
                        <i class="glyphicon glyphicon-off"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


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
          <h2>{{$title_section}} @if(isset($subtitle_section)) <small>{{$subtitle_section}}</small></h2> @endif
        </div>
    @endif

    @yield('breadcrumbs')
    @yield('content')
</div>


<!-- Modal para confirmar cuando se da click en menu logout -->
<div class="modal fade" id="confirm-logout" tabindex="-1" role="dialog" aria-labelledby="confirm-logout" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="confirm-logout-title">Confirme la acción:</h4>
            </div>
            <div class="modal-body">
                <h3 style="text-align: center">¿Realmente desea salir del sistema?</h3>
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