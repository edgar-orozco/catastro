
	<h1>@yield('titulo')</h1>

	



		<div class="panel-heading">

			<h4 class="panel-title">@yield('titulo2') </h4>
		
		</div>

		<div class="panel-body">

		
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						{{Form::label('corevat','Corevat')}}
						<br>
						@yield('corevat')
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						{{Form::label('nombre','Nombre')}}
						<br>
						@yield('nombre')
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						{{Form::label('direccion','Dirección')}}
						<br>
						@yield('direccion')
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						{{Form::label('telefono','Telefono')}}
						<br>
						@yield('telefono')	
					</div>
				</div>			
				<div class="col-md-6">
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




	<!-- JQuery -->
{{ HTML::script('js/jquery/jquery.min.js') }}

<!-- JS Bootstrap -->
{{ HTML::script('js/bootstrap.min.js') }}


@yield('javascript')
   
</body>

</html>