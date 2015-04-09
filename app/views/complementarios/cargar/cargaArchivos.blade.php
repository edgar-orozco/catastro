

<link href="../css/complementarios_cargar/fileinput.css" media="all" rel="stylesheet" type="text/css" />

      
<input id="file" name="file[]" type="file" multiple class="file-loading">

<div class="input-group" id="carga-hide">
            {{ Form::hidden('clave_catas',$clave_catas, ['id' => 'clave_catasC'])}}
            {{ Form::hidden('gid_predio',$gid, ['id' => 'gid_predioC'])}}
            {{ Form::hidden('entidad',$estado, ['id' => 'entidadC'])}}
            {{ Form::hidden('municipio',$municipio, ['id' => 'municipioC'])}}
</div>


@section('javascript')   

<script src="../js/jquery/fileinput.js" type="text/javascript"></script>

<script>




var footerTemplate = '<div class="btn-group"> '+
            '<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action <span class="caret"></span></button>'+
            '<ul class="dropdown-menu">'+
                '<li><a href="#">Frente</a></li>'+
                '<li><a href="#">Lateral</a></li>'+
                '<li class="divider"></li>'+
                '<li><a href="#">Molestar</a></li>'+
            '</ul>'+
'</div> ';
	$("#file").fileinput(
	{
		uploadUrl: "/cargarArchivo",
		uploadAsync: false,
		maxFileCount: 5,
		layoutTemplates: {footer: footerTemplate},
		uploadExtraData: 
		{
        	gid_predio	: document.getElementById('gid_predioC').value,
        	entidad		: document.getElementById('entidadC').value,
        	municipio 	: document.getElementById('municipioC').value,
        	clave_catas : document.getElementById('clave_catasC').value,
    	}
	});
</script>
@append