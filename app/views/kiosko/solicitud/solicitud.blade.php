<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>GESTIÓN CATASTRAL</title>
    </head>
    <style>
        #contenedor{  
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
            height:13%;  
        }  
        #menu{  
            height:10%;  
        }  
        #centro{  
            height:30%;  
            border: 2px solid #000000;
            margin: 5px;
            width:100%;
        }
        #centro2{  
            height:10%;  
            margin: 5px;
            width:100%;
        }
        #dentro{
            height: 4%;
            margin: 5px;
            width: 100%;
            /*tipo de letra*/
            font-family: 'Arial Black', Gadget, sans-serif;
            text-align: center;
            font-size: 16px;
            color: #0000000; 
        }
        #izquierda{  
            height:34.5%;

            display:inline-block;
            float:left;  
            width:50%; 
            margin: 2px;
        }  
        #derecha{ 
            height:34.5%;
            display:inline-block;
            float:left;  
            width:48.4%; 
            margin: 2px;
        }  

        #pie{  
            height:10%;   
            clear:both;
            margin: 4px;
        }
        .title{
            font-family: 'Arial Black', Gadget, sans-serif;
            text-align: center;
            font-size: 20px;
            color: #0000000; 
        }
    </style>
    <body>
        <div id="contenedor">
            <div id="cabecera">
                <table width="100%">
                    <tr>
                        <td width="25%" align="center"><img src="css/images/main/main-logo.png"  height="70"></td>
                        <td width="50%" align="center" class="title"><strong>GESTIÓN CATASTRAL</strong></td>
                        <td width="25%" align="center"><img src="css/images/main/logo-spf.png"  height="70"></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">DE CONFORMIDAD CON LOS LINEAMIENTOS PARA LA OPERATIVIDAD DE LOS CATASTROS EN EL ESTADO DE TABASCO, LINEAMIENTO No. 3</td>
                    </tr>
                    <tr>
                        <td>Lugar: {{$solicitud->mupio->nombre_municipio}}, Tabasco.<br>N° de Solicitud {{$solicitud->id}}</td>
                        <td align="center"><strong>{{strtoupper($solicitud->tramite->nombre)}}</strong></td>
                        <td align="right">Fecha: <?php $fecha=strtotime($solicitud->create_at); echo date("d/m/Y",$fecha) ?></td>
                    </tr>
                </table>                
            </div>
            <div id="centro">
                <div id="izquierda">
                    <div id="dentro"><strong>DATOS DEL SOLICITANTE</strong></div>
                    <p>
                        Nombre: {{$solicitud->solicitante->nombrec}}
                    </p>
                    <p>
                        CURP: {{$solicitud->solicitante->curp}}
                    </p>
                    <p>
                        RFC: {{$solicitud->solicitante->rfc}}
                    </p>
                    <p>
                        Telefono: {{$solicitud->solicitante->telefono}}
                    </p>
                    <p>
                        E-mail: {{$solicitud->solicitante->correo}}
                    </p>
                    <p>
                        Dirección: {{$solicitud->solicitante->direccion}}
                    </p>
                </div>
                <div id="derecha">
                    <div id="dentro"><strong>DATOS DEL PREDIO</strong></div>
                    <p>
                       Ubicación del predio: {{$fiscal->ubicacionFiscal->ubicacion}}
                    </p>
                    <p>
                        Tipo de predio: {{$fiscal->tipo_predio}}
                    </p>
                    <p>
                        Zona: {{$zona}}
                    </p>
                    <p>
                        Manzana: {{$manzana}}
                    </p>
                    <p>
                        Clave o Cuenta: {{$solicitud->clave}}
                    </p>
                </div>
            </div>
            <div id="centro">
                <div id="dentro"><strong>CROQUIS DEL PREDIO (ENTRE QUE CALLES SE ENCUENTRA)</strong></div>
                <div id="izquierda">
                <P>En este apartado dibuje el croquis del predio:</P>
                </div>
            </div>
            <br>
            <p align="center"><strong>ATENTAMENTE<br><br><br>____________________________________________<br>{{$solicitud->solicitante->nombrec}}</strong></p>
        </div>
    </body>
</html>
