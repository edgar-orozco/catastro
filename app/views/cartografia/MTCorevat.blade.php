<html>
    <head>
        <style>
            @page encabezado {
                size: US-Letter landscape;
                margin: 0;
                font-size:8px;
            }
            .encabezadoPagina
            {
                page: encabezado;
                font-size:15px;
            }
            .titulo
            {
                font-weight:bold;
                font-family: sans-serif;
                font-size:20px;
                text-align: center;
            }
            .h
            {
                font-weight:bold;
                width: 300px;
                font-family: sans-serif;
                font-size:30px;
            }
            .h2
            {
                font-weight:bold;
                font-family: sans-serif;
                font-size:16px;
            }
            .h3
            {
                font-weight:bold;
                font-family: sans-serif;
                font-size:14px;
                text-align: left;
            }
            .contenido
            {
                font-weight: normal;
                font-family: sans-serif;
                font-size:8px;
            }

            .datosgenerales
            {
                font-weight: normal;
                font-family: sans-serif;
                font-size:8px;
                text-align: center;
            }
            .cuadroCosntrucción
            {
                font-weight: normal;
                font-family: sans-serif;
                font-size:8px;
                text-align: center;
            }
            .footerPlanos
            {
                font-weight:bold;
                font-family: sans-serif;
                font-size:12px;
                text-align: center;
            }
            .footer
            {
                font-family: sans-serif;
                font-size:8px;
                text-align: center;
            }
            .row{
                border: solid;
                border-width: 0.5px;
            }
        </style>
    </head>
    <body>
        <div class="contenido">
            <table style="width:100%;" >
                <tr>
                    <!-- Contenido Izquierdo -->
                    <td width="70%" style="border:solid; height: 800px; background-color: red;">
                            <!-- Plano -->
                            <table width="100%" >
                                <tr>
                                    <td align="center">
                                        <div style="width: 650px; height: 350px; text-align:center; ">
                                            <img id="mapImg" src="<?= substr($mapURL, 1, (strlen($mapURL)-1) ); ?>" style="overflow: hidden; width: 650px; height: 350px;">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                    </td>

                        <!-- Tira marginal -->
                        <td width="29%" valign="top" style="border:solid;">
                            <table style="border:none; font-family: sans-serif; font-size: 11px; width:100%">
                                <tr>
                                    <td style="border:none;" align="center" width="30%"><img src="css/images/main/main-logo.png" height="50" alt="Catastro"/></td>
                                    <td style="border:none;" align="center" width="30%"><img src="css/images/home/secrt.png" height="50" alt="Secretaria de planeacion y finanzas"/></td>
                                    <td style="border:none;" align="center" width="30%"> <img src="css/images/main/logo-header.png" height="40" alt="Catastro"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="border:none;" align="center" width="100%" class='titulo'>
                                        AVALUOS
                                    </td>
                                </tr>
                            </table>       
                            <table width="100%">
                                <tr>
                                    <td class="row">
                                        <div style="font-weight:bold; text-align:center; font-size:10px">
                                            DATOS
                                        </div>
                                        <br>
                                        <div style="font-weight:bold; text-align:center; font-size:8px">
                                            NO. DE CUENTA: <br>
                                            CLAVE CATASTRAL: <br>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr>
                                    <td class="row" width="50%" valign="top">
                                        <div style="font-weight:bold; text-align:left; font-size:8px">
                                            DATOS
                                        </div>
                                        <br>
                                        <div style="font-weight:bold; text-align:center; font-size:10px">
                                           
                                        </div>
                                            <br>
                                    </td>
                                    <td class="row" width="50%" valign="top">
                                        <div style="font-weight:bold; text-align:left; font-size:8px">
                                            USO DEL PREDIO
                                        </div>
                                        <br>
                                        <div style="font-weight:bold; text-align:center; font-size:10px">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <!-- Plano de orientación y localización -->
                            <table width="100%">
                                <tr>
                                    <td class="row">
                                        <div style="width:100%; height:175px">
                                            <img id="mapImg" src="" style="overflow: hidden; width: auto; height: 175px;">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <!-- Información de la construcción -->
                            <table width="100%">
                                <tr>
                                    <td class="row" width="33%" valign="top">
                                        <div style="font-weight:normal; text-align:left; font-size:8px">
                                            SUP. CONST.:
                                        </div>
                                        <div style="font-weight:normal; text-align:center; font-size:10px">
                                           
                                        </div>
                                    </td>
                                    <td class="row" width="33%" valign="top">
                                        <div style="font-weight:normal; text-align:left; font-size:8px">
                                            SUP. LIBRE:
                                        </div>
                                        <div style="font-weight:normal; text-align:center; font-size:10px">
                                           
                                        </div>
                                    </td>
                                    <td class="row" width="33%" valign="top">
                                        <div style="font-weight:normal; text-align:left; font-size:8px">
                                            SUP. TOTAL:
                                        </div>
                                        <div style="font-weight:normal; text-align:center; font-size:10px">
                                            
                                        </div>
                                    </td>                                    
                                </tr>
                            </table>
                            <table width="100%">
                                <tr>
                                    <td class="row" width="100%" valign="top">
                                        <br>
                                        <div style="font-weight:bold; text-align:center">
                                            CARACTERISTICAS:
                                        </div>
                                        <br>
                                        <div style="text-align:center; margin: 0px 10px; ; height:120px">
                                        <br>                      
                                        </div>                                        
                                    </td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr>
                                    <td class="row" width="100%" valign="top">
                                        <div style="font-weight:bold; text-align:left; font-size:8px">
                                            UBICACIÓN:
                                        </div>
                                        <div style="font-weight:bold; text-align:center; font-size:10px">
                                            <br>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr>
                                    <td class="row" width="100%" valign="top">
                                        <div style="font-weight:bold; text-align:left; font-size:8px">
                                            PROPIETARIO:
                                        </div>
                                        <div style="font-weight:bold; text-align:center; font-size:10px">
                                            
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr>
                                    <td class="row" width="50%" valign="top">
                                        <div style="font-weight:bold; text-align:left; font-size:8px">
                                            ESCALA:
                                        </div>
                                        <div style="font-weight:bold; text-align:center; font-size:10px">
                                            {{$escala}}
                                        </div>
                                    </td>
                                    <td class="row" width="50%" valign="top">
                                        <div style="font-weight:bold; text-align:left; font-size:8px">
                                            FECHA:
                                        </div>
                                        <div style="font-weight:bold; text-align:center; font-size:10px">
                                            
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                </table>
            </div>
    </body>
</html>