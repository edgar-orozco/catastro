

<link href="../css/complementarios_cargar/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        
<input id="file" name="file[]" type="file" multiple class="file-loading">

@section('javascript')   

<script src="../js/jquery/fileinput.js" type="text/javascript"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js" type="text/javascript"></script>
<script>
	$("#file").fileinput(
	{
		uploadUrl: "/cargarArchivo",
		uploadAsync: false,
		maxFileCount: 5
	});
</script>
@append