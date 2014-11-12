<!doctype html>
<html lang="es_MX">
<head>
<meta charset="UTF-8">
<title>
    @section('title')
        - Sistema Catastral
    @show
</title>
<!-- CDN para CSS bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<!-- CDN Para JS Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

@yield('styles')

</head>
<body>

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

<div class="container">
    <ol class="breadcrumb">
        <li>
            <a href="#">Administrador</a>
        </li>
        <li class="active">Link</li>
    </ol>
    @if(isset($title_section))
        <div class="page-header">
          <h1>{{$title_section}} @if(isset($subtitle_section)) <small>{{$subtitle_section}}</small></h1> @endif
        </div>
    @endif
    @yield('content')
</div>

</body>
</html>