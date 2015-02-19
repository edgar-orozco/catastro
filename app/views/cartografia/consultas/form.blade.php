<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="/catastro_info/reqAJAX.js" ></script>
    <script src="/catastro_info/reqAJAX2.js" ></script>
    <script src="/catastro_info/gotopage.js" ></script>
    <title>DGCEF-Tabasco</title>

    <!-- Bootstrap Core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>
</head>

<body Onload="ConsultaLadoServidor('municipio','tab_municipios','nada','nada','cve_mun','nom_mun','nada','nada');" >

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cartografia/consultas">Restaurar</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<!-- <div class="container"> -->



<div class="row">
@if ($mapserv) 

	{{ Form::open(['route'=> 'cartografia.consultas.store']) }}

<div class="col-xs-2">
<br>{{Form::radio('zoom', 0, $mapserv['pan'], array('id' => 'pan',))}} Pan
	<br>{{Form::radio('zoom', 1, $mapserv['zoomin'],array('id' => 'zoomin',))}} Zoom In
	<br> {{Form::radio('zoom', -1, $mapserv['zoomout'],array('id' => 'zoomout',))}} Zoom Out
	<br> {{Form::text('zsize', '2')}} Factor Zoom
	
	<br> {{Form::checkbox('layer[]', 'Estado',$mapserv['Estado'])}} Estado
	<br> {{Form::checkbox('layer[]', 'Carreteras',$mapserv['Carreteras'])}}Carreteras
	<br> {{Form::checkbox('layer[]', 'Predios',$mapserv['Predios'])}} Predios
	<br> {{Form::checkbox('layer[]', 'Manzanas',$mapserv['Manzanas'])}}Manzanas
</div>	<!-- cierra col1  -->

<div class="col-xs-7">	
	 
	{{Form::image($mapserv['image_url'],'img',
	array( 'id' => 'img', 'width'=> '800', 'height' => '600'))}}

</div>	<!-- cierra col2  -->
<div class="col-xs-2">
<img src='{{$mapserv['ref_url']}}'>

	{{Form::hidden('extent', $mapserv['new_extent'], array('id' =>'extent'))}}
	<img src='{{$mapserv['leg_url']}}'>
	<p> Municipio
	<br>{{Form::select('municipio', array( '0' => 'Seleccione---'), 'default', array( 'id' => 'municipio', 'OnChange'=>"ConsultaLadoServidor('localidad','localidades_a','cve_mun',this.value,'nombre','nombre','nada','nada');"))}}
	<p> Localidad
	<br>{{Form::select('localidad', array( '0' => 'Seleccione---'), 'default', array( 'id' => 'localidad', 'OnChange'=>"ConsultaLadoServidor2('manzana','lim_colonias','nada',this.value,'cve_manzana','cve_manzana','nada','nada','nada','1');"))}}

	<p> Manzana
	<br>{{Form::select('manzana', array( '0' => 'Seleccione---'), 'default', array( 'id' => 'manzana'))}}
<p><input type="button" name="gen" value="Generar" onclick="gotopage1(document.getElementById('municipio').value,document.getElementById('manzana').value)"> 
</div>	<!-- cierra col3  -->	
	
	<br> {{ Form::close() }} @else No hay Mapa @endif





</div><!-- cierra renglon -->






<!-- </div> -->
<script src="/dist/js/jquery-1.11.2.min.js"></script>
<script src="/dist/js/bootstrap.min.js"></script>

</body>
</html>
