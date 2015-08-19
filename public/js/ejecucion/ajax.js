$(document).ready(function() 
{	

	window.onload = function () 
	{ 
	    document.getElementById("file").onchange = function () 
	    {
	        document.getElementById('form-boton').hidden="";
	    };
	};





    //petición al enviar el formulario de registro
	var form = $('.register_ajax');
    form.bind('submit',function () 
    {
    	$.ajax(
        {
        	type: 'POST',
            data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
		    processData: false,
		    contentType: false,
            url: '/ejecucion/cargaEjecucion',
            beforeSend: function()
            {
                $('.preload_users').html('Cargando datos... <span class="glyphicon glyphicon-refresh spin"></span>');
            },
            success: function (data) 
            {
            	//Se codifica en  Base64


				//<br> <a class="btn btn-warning" title="Editar Predio" href="data:application/octet-stream;charset=utf-8;base64, '+encodedString+'" download="error.txt" > <span class="glyphicon glyphicon-pencil"></span> </a>

              	var encodedString = btoa(data.fallasV+" "+data.fallasR);
                $('.load_ajax').html("El total de registros: "+data.totalR+"<br> Error de sintaxis: "+data.totalFV+
                	"<br> Claves sin registro: "+data.totalNE+
                	' <br> <a class="btn btn-info" title="Editar Predio" href="data:application/octet-stream;charset=utf-8;base64, '+encodedString+'" download="error.txt" >  <span class="glyphicon glyphicon-save"> Descargar Errores </span> </a><br>')
                $('.preload_users').html('');
                if (data.vale.length > 0) {
                $('.carta').html('<a class="btn btn-info" href="cartainv/'+data.vale+'"target=_blank> <span class="glyphicon glyphicon-save">Descargar Carta Invitación</span></a>');
                };
                $('#form-group').hidden="";
            }
        });
      		return false;
    });
});

