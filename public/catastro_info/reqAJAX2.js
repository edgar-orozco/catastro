function ConsultaLadoServidor2(categoria,tabla,columna,valor,denominador,nombre,columna1,valor1,columna2,valor2) {

    var tipo=categoria;
    
    console.log([categoria,tabla,columna,valor,denominador,nombre,columna1,valor1,columna2,valor2]);
    url = "/cartografia/consultajax2";
var req=null;
    if(window.ActiveXObject) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(e) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                req = false;
            }
        }
    }else {
        if (window.XMLHttpRequest) {
            req = new XMLHttpRequest();
        }else{
            alert('No pude crear el objeto XMLHTTPRequest por algun acto divino no identificado.');
        }

         var parametros = "tipo="+categoria+"&tabla="+tabla+"&columna="+columna+"&valor="+valor+"&denominador="+denominador+"&nombre="+nombre+"&columna1="+columna1+"&valor1="+valor1+"&columna2="+columna2+"&valor2="+valor2;
        req.onreadystatechange = function () {

            if (req.readyState == 4) {

                if (req.status == 200) {

                    if(req.responseText){

                        var xml =  req.responseXML;
                        var raiz = xml.getElementsByTagName('tipos').item(0);

                        var colonia = raiz.getElementsByTagName(tipo);

                        document.getElementById(tipo).innerHTML="";
                        for(i=0; i < colonia.length;i++){

                            document.getElementById(tipo).options[i] = new Option(colonia[i].getAttribute('nombre'));
                            document.getElementById(tipo).options[i].value = colonia[i].getAttribute('cp');
                            

                        }

                    }
                    else {
                        alert("No ha regresado ning?n valor su petici?n");
                    }
                } else {
                    alert("Hay problemas de comunicaci?n con el servidor. intente de nuevo.");
                }
            }
        };
        req.open("POST", url, true);
        req.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        req.overrideMimeType('text/xml');
        req.send(parametros);
    }




}
function datecheck()
{
if(document.getElementById("fecha_nac").value == "")
            {
                alert("Por Favor llene la Fecha")
                    }else{
            return true
                }
    var chkdate = document.getElementById("fecha_dep").value
if (chkdate.match(/^[0-9]{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])\s([0-9]{2})\:([0-9]{2})\:([0-9]{2})/)) {
                   return true
                }
else if(chkdate.match(/^[0-9]{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])/))
                    {
                        return true
                    }

                else
                    {
                        alert("el formato de la fecha debe ser AAAA-MM-DD")
                    }
                return false



}
function openWindow(url)
{

    var w = window.open (url, "win", "height=250,width=650,resizable,scrollbars,status");
    if (window.focus) {w.focus()}
	return false;
    
}

function gotopage(id_md,contenido,nombre) {

	    url="/cgi-bin/AdminSeprotom/Seprotom.pl?.State=Desplegar&id_md="+id_md+"&contenido="+contenido+"&nombre="+nombre;


	                    location.href=url;

}

