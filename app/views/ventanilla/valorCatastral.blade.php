<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<style>
#contenedor{  
        //background-color:#F4ABF2;
        background-image: url("css/images/main/logo-header.png-agua.png");
        background-repeat: no-repeat;
        background-position: center;
        border:2px solid #000000; 
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: #0000000;
        width: 100%;
        height: 97%;
}  
#cabecera{  
        //background-color:#E5BC7A;  
        height:20%;  
}  
#menu{  
        height:10%;  
        background-color:#C8CACC;  
}  
#centro{  
        height:25%;  
        //background-color:#BDD2EF; 
        border: 2px solid #000000;
        margin: 5px;
        width:100%;
}
#centro2{  
        height:10%;  
        //background-color:#BDD2EF; 
        //border: 2px solid #000000;
        margin: 5px;
        width:100%;
}
#centro3{
        height:4%;  
        //background-color:#BDD2EF; 
        //border: 2px solid #000000;
        margin: 5px;
        width:100%;
}
#dentro{
    height: 4%;
    //background-color: #FFFF99;
    margin: 5px;
    width: 100%;
    /*tipo de letra*/
    font-family: 'Arial Black', Gadget, sans-serif;
    text-align: center;
    font-size: 16px;
    color: #0000000; 
}
#izquierda{  
        height:26%;
        //background-color:blanchedalmond;
        display:inline-block;
        float:left;  
        width:50%; 
        margin: 2px;
}  
#derecha{  
        height:26%;  
        //background-color:burlywood;
        display:inline-block;
        float:right;  
        width:48.3%;
        margin: 2px;
}  

#pie{  
        height:10%;  
        //background-color:#D3D1C1;  
        clear:both;
        margin: 4px;
}
.title{
        font-family: 'Arial Black', Gadget, sans-serif;
        text-align: center;
        font-size: 13px;
        color: #0000000; 
}
</style>
<body>
@foreach($datos as $row)
<div id="contenedor">
    <div id="cabecera">
        <table width="100%">
            <tr>
                <td width="20%" align="right"><img src="css/images/main/main-logo.png"  height="70"></td>
                <td width="60%" align="center" class="title">H. AYUNTAMIENTO CONSTITUCIONAL DE {{strtoupper($nmunicipio)}}, TAB.<br>DIRECCION DE FINANZAS<br>SUBDIRECCIÓN DE CATASTRO</td>
                <td width="20%" align="center"><img src="css/images/home/logos/{{$logo}}"  height="100"></td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td width="33.33%">Lugar: {{$nmunicipio}}, Tabasco.</td>
                <td width="33.33%" align="center"><strong>CERTIFICADO DE VALOR CATASTRAL</strong></td>
                <td width="33.33%" align="right">Fecha de Impresión:</td>
            </tr>
            <tr>
                <td width="33.33%">Fecha de Valuación:</td>
                <td width="33.33%" ></td>
                <td width="33.33%" align="right"></td>
            </tr>
        </table>
        <p id="pie" align="justify">Previo al pago de los derechos correspondientes solicito me sea proporcionado al calce de la presente, el valor catastral del predio que acontinuación describio, del cual anexo plano con carácter devolutivo. Afirmo que la información proporcionada es veraz. Quedando bajo las sanciones contenidas en el artículo 71 Fracción V de la ley de Catastro del Estado en vigor.</p>
    </div>
        <div id="centro">
            <div id="dentro"><strong>DESCRIPCIÓN DEL PREDIO</strong></div>
                <div id="izquierda">
                    <p>
                        Propietario: {{$row->nombres}} {{$row->apellido_paterno}} {{$row->apellido_materno}}
                    </p>
                    <p>
                        Ubicación del predio: {{$row->ubicacion}}
                    </p>  
                    <p>
                        Cuenta: {{$row->cuenta}}
                    </p>
                    <p>
                        Tipo de Predio: {{$row->tipo_predio}}
                    </p>
                    <p>
                        Nombre del Solicitante:@foreach($solicitante as $ro) {{$ro->nombre}} {{$ro->paterno}} {{$ro->materno}}  @endforeach
                    </p>
                </div>
            <div id="derecha">
                <p>
                   Zona: {{$zona}}
                </p>
                <p>
                    Manzana: {{$manzana}}
                </p>
                <p>
                    Predio: {{$predio}}
                </p>
                <p>
                    Superficie de Terreno: {{$row->superficie_terreno}} m<sup>2</sup>
                </p>
                <p>
                    Superficie de Construcción: {{$row->superficie_construccion}} m<sup>2</sup>
                </p>
            </div>
        </div>
        <div id="centro">
            <div id="dentro"><strong>EL PREDIO AL QUE SE REFIERE LA PRESENTE SOLICITUD SE LE ASIGNÓ:</strong></div>
            <div id="izquierda">
                <p>
                    Clave Catastral: {{$row->clave}}
                </p>
                <p>
                    Superficie Terreno: {{$row->superficie_terreno}} m<sup>2</sup>
                </p>
                <p>
                    Superficie Construcción: {{$row->superficie_construccion}} m<sup>2</sup>
                </p>
            </div>
            <div id="derecha">
                <p>
                    Valor de Terreno:<br/>
                </p>
                <p>
                    Valor de Construcción:<br/>
                </p>
                <p>
                    Valor Catastral: {{$row->valor_catastral}}
                </p>
            </div>
        </div>
    <div id="centro2"></div>
        <div id="pie">
            <table width="100%">
            <tr>
                <td width="33.33%" align="center">
                    ELABORO<br/>
                    
                </td>
                <td width="33.33%" align="center">
                    REVISO<br/>
                    
                </td>
                <td width="33.33%" align="center">
                    AUTORIZO<br/>{{$autorizo}}
                    
                </td>
            </tr>
            </table>
            <h3>NOTA:</h3>
            <p align="justify">
                El Certificado de Valor Catastral para efectos fiscales tendrá una vigencia de 90 días naturales, contados a partir de su fecha de expedición.<strong>Si dentro de este término, el predio en cuestión sufre alguna modificación que altere su valor, el interesado debe solicitar la expedición de otro certificado. Art. 31 R.L.C.E.T.</strong>
            </p>
        </div>
</div>
@endforeach
</body>
</html>