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
    <!-- CSS bootstrap -->
    {{ HTML::style('css/bootstrap.css') }}

    <!--fancybox-->
       {{ HTML::style('/css/jquery.fancybox.css') }}

        {{ HTML::script('/js/jquery-1.7.1.min.js') }}
        {{ HTML::script('/js/jquery.fancybox.pack.js') }}
    
    <!-- css general de la app -->
    {{ HTML::style('css/general.css') }}

    <!-- Navbar css custom menu -->
    {{ HTML::style('css/navmenu.css') }}
    {{ HTML::style('css/header.css') }}
    {{ HTML::style('css/footer.css') }}




</head>

<body>

	<h1>@yield('titulo')</h1>
	
	<div class="panel panel-primary">

		<div class="panel-heading">

			<h4 class="panel-title">@yield('titulo2') </h4>
		
		</div>

		<div class="panel-body">

		
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						{{Form::label('corevat','Corevat')}}
						<br>
						@yield('corevat')
					</div>
				</div>

				<div class="col-md-5">
					<div class="form-group">
						{{Form::label('nombre','Nombre')}}
						<br>
						@yield('nombre')
					</div>
				</div>
			
				<div class="col-md-6">
					<div class="form-group">
						{{Form::label('direccion','Dirección')}}
						<br>
						@yield('direccion')
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						{{Form::label('telefono','Telefono')}}
						<br>
						@yield('telefono')	
					</div>
				</div>			
				<div class="col-md-12">
					<div class="form-group">
						{{Form::label('correo','Correo')}}
						<br>
						@yield('correo')
					</div>
					<br>
					@yield('boton')
				</div>
			
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