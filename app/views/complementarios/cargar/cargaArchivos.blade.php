

<link href="../css/complementarios_cargar/fileinput.css" media="all" rel="stylesheet" type="text/css" />

      
<input id="file" name="file[]" type="file" multiple class="file-loading">

<div class="input-group" id="carga-hide">
            {{ Form::hidden('clave_catas',$clave_catas, ['id' => 'clave_catasC'])}}
            {{ Form::hidden('gid_predio',$gid, ['id' => 'gid_predioC'])}}
            {{ Form::hidden('entidad',$estado, ['id' => 'entidadC'])}}
            {{ Form::hidden('municipio',$municipio, ['id' => 'municipioC'])}}
</div>


<select name="instalaciones" class="form-control" id="instalaciones"><option selected="selected" value="">--Seleccione una opción--</option><option value="Frontal">Frontal</option><option value="Lateral">Lateral</option></select>



@section('javascript')   

<script src="../js/jquery/fileinput.js" type="text/javascript"></script>

<script>




var footerTemplate = '<select name="select-instalaciones" class="form-control" id="instalaciones"> '+
            		 	'<option selected="selected" value="">--Seleccione una opción--</option>'+
            			'<option value="1">Frontal</option>'+
                		'<option value="2">Lateral</option>'+
                	 '</select>';
                
	$("#file").fileinput(
	{
		uploadUrl: "/cargarArchivo",
		uploadAsync: false,
		maxFileCount: 5,
		layoutTemplates: {footer: footerTemplate},
		initialPreview: [
        "<img src='http://lorempixel.com/200/150/people/1'>",
        "<img src='http://lorempixel.com/200/150/people/2'>",
   	 ],
		uploadExtraData: function()
		{
			

        	var gid_predio = document.getElementById('gid_predioC').value;
        	var entidad = document.getElementById('entidadC').value;
        	var municipio = document.getElementById('municipioC').value;
        	var clave_catas = document.getElementById('clave_catasC').value;
        	var toma = document.getElementsByName('select-instalaciones');
        	var tomas = [];
        	for (var x = 0; x<toma.length; x++) 
        	{
        		tomas[x]= toma[x].value;
        	};

        	return {gid_predio:gid_predio, entidad:entidad, municipio:municipio, clave_catas:clave_catas, tomas:tomas};
    	}
	});
</script>
@append