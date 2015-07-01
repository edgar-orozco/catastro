@extends('layouts.default')

@section('content')
	<link href="/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
	<label>
		Seleccione archivo a cargar.
		<br>
		<br>
		Solo se aceptan archivos separados por comas que no sean mayor a 10 MB.
	</label>
	<input id="file" name="file" type="file" class="file">
@stop
@section('javascript')
	<script src="/js/fileinput.min.js" type="text/javascript"></script>
	<script src="/js/fileinput_locale_es.js" type="text/javascript"></script>
	<script>
		$("#file").fileinput(
			{
				uploadUrl: "/admin/registro/carga",
				maxFileCount: 1,
		        overwriteInitial: false, //pendiente de informacion
		        allowedFileExtensions: ["csv", "CSV"],
		        maxFileSize: 10240
			});
	</script>
@stop