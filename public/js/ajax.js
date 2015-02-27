<<<<<<< HEAD
function nuevoAjax(){ 
  var xmlhttp=false; 
  try { 
   // Creación del objeto ajax para navegadores diferentes a Explorer 
   xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
  } catch (e) { 
   // o bien 
   try { 
     // Creación del objet ajax para Explorer 
     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); } catch (E) { 
     xmlhttp = false; 
   } 
  } 

  if (!xmlhttp && typeof XMLHttpRequest!='undefined') { 
   xmlhttp = new XMLHttpRequest(); 
  } 
  return xmlhttp; 
} 
=======
$(document).ready(function() 
{	
   //petición al enviar el formulario de registro
	var form = $('.busqueda');
    form.bind('submit',function () 
    {	
    	$.ajax(
        {
        	type: 'GET',
            //data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
		    processData: false,
		    contentType: false,
            url: '/ejecucion',
            beforeSend: function()
            {
                $('.preload_users').html('Cargando datos... <span class="glyphicon glyphicon-refresh spin"></span>');
            },
            success: function (data) 
            {
            	//Se codifica en  Base64
                alert('hola mundo');

				//<br> <a class="btn btn-warning" title="Editar Predio" href="data:application/octet-stream;charset=utf-8;base64, '+encodedString+'" download="error.txt" > <span class="glyphicon glyphicon-pencil"></span> </a>

              
            }
        });
      		return false;
    });  
});
>>>>>>> 9f018777be0d615dae379cf32dde36062197f977

