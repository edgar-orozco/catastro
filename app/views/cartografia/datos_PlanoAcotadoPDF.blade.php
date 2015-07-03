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
            <table style="width:100%" >
                <tr>
                    <!-- Contenido Izquierdo -->
                    <td width="70%" style="border:solid;">
                        <!-- Plano -->
                        <table width="100%" >
                            <tr>
                                <td align="center">
                                    <div style="width: 650px; height: 350px; text-align:center ">
                                        <img id="mapImg" src="<?php echo $imgPlanoAcotado ?>" style="overflow: hidden; width: 650px; height: 350px;">
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <!-- cuadro de construcciones -->
                        <table class = "cuadroCosntrucción" style="width: 100%; text-align: center; font-family: sans-serif; font-size: 8px; ">
                            <tr>
                                <td width="10%" class='row' rowspan="2">LADO<br>EST-PV</td>
                                <td width="10%" class='row' rowspan="2">AZIMUT</td>
                                <td width="10%" class='row' rowspan="2">DISTANCIA<br>(MTS.)</td>
                                <td colspan="2" class='row'>CORDENADAS UTM</td>
                                <td width="10%" class='row' rowspan="2">CONVERGENCIA</td>
                                <td width="10%" class='row' rowspan="2">FACTOR DE<br>ESCALA LINEAL</td>
                                <td width="15%" class='row' rowspan="2">LATITUD</td>
                                <td width="15%" class='row' rowspan="2">LONGITUD</td>
                            </tr>
                            <tr>
                                <td width="10%" class='row'>X</td>
                                <td width="10%" class='row'>Y</td>
                            </tr>

                            <?php
                            for($i=0;$i<sizeof($planoacotado);$i++) {
                                if ($i!=0){
                            ?>
                            <tr>
                                <td class='row'><?php echo $planoacotado[$i]->get_est() ?>-<?php echo $planoacotado[$i]->get_pv() ?></td>
                                <td class='row'><?php echo $planoacotado[$i]->cast_grados($planoacotado[$i]->get_azimut()) ?></td>
                                <td class='row'><?php echo round($planoacotado[$i]->get_distancia(),2) ?></td>
                                <td class='row'><?php echo round($planoacotado[$i]->get_x(),3) ?></td>
                                <td class='row'><?php echo round($planoacotado[$i]->get_y(),2) ?></td>
                                <td class='row'><?php echo $planoacotado[$i]->cast_grados($planoacotado[$i]->get_convergencia()) ?></td>
                                <td class='row'><?php echo $planoacotado[$i]->get_factor() ?></td>
                                <td class='row'><?php echo $planoacotado[$i]->get_latitud() ?></td>
                                <td class='row'><?php echo $planoacotado[$i]->get_longitud() ?></td>
        
                            </tr>
                            <?php 
                                }
                            } 
                            ?>
                        </table>
                        <table width="100%" >
                            <tr>
                                <td width="50%" class="row" align="center"> AREA = <?php echo round($planoacotado[0]->get_superficie(),2) ?> m2</td>
                                <td width="50%" class="row" align="center"> PERIMETRO = <?php echo round($planoacotado[0]->get_perimetro(),2) ?> m</td>
                            </tr>
                        </table>                           
                        </td>
                        <td width="1%">
                            
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
                                        Plano Acotado
                                    </td>
                                </tr>
                            </table>       
                            <table width="100%">
                                <tr>
                                    <td class="row">
                                        <div style="font-weight:bold; text-align:center; font-size:10px">
                                            DATOS DEL PREDIO
                                        </div>
                                        <br>
                                        <div style="font-weight:bold; text-align:center; font-size:8px">
                                            NO. DE CUENTA: <?php echo $fiscal->cuenta ?><br>
                                            CLAVE CATASTRAL: <?php echo $fiscal->clave ?><br>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%">
                                <tr>
                                    <td class="row" width="50%" valign="top">
                                        <div style="font-weight:bold; text-align:left; font-size:8px">
                                            TIPO DE PREDIO
                                        </div>
                                        <br>
                                        <div style="font-weight:bold; text-align:center; font-size:10px">
                                            <?php 
                                            $tipo_predio = "";
                                            switch($predios->tipo_predio){
                                                case 'U':   $tipo_predio = "URBANO";
                                                            break;
                                                case 'R':   $tipo_predio = "RUSTICO";
                                                            break;
                                            }
                                            ?>
                                            {{$tipo_predio}}
                                        </div>
                                            <br>
                                    </td>
                                    <td class="row" width="50%" valign="top">
                                        <div style="font-weight:bold; text-align:left; font-size:8px">
                                            USO DEL PREDIO
                                        </div>
                                        <br>
                                        <div style="font-weight:bold; text-align:center; font-size:10px">
                                            <?php echo $usosuelo->descripcion ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <!-- Plano de orientación y localización -->
                            <table width="100%">
                                <tr>
                                    <td class="row">
                                        <div style="width:100%; height:175px">
                                            <img id="mapImg" src="<?php echo $imgCroquis ?>" style="overflow: hidden; width: auto; height: 175px;">
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
                                            {{$superficie[0]}} m2 
                                        </div>
                                    </td>
                                    <td class="row" width="33%" valign="top">
                                        <div style="font-weight:normal; text-align:left; font-size:8px">
                                            SUP. LIBRE:
                                        </div>
                                        <div style="font-weight:normal; text-align:center; font-size:10px">
                                            {{$superficie[1]}} m2
                                        </div>
                                    </td>
                                    <td class="row" width="33%" valign="top">
                                        <div style="font-weight:normal; text-align:left; font-size:8px">
                                            SUP. TOTAL:
                                        </div>
                                        <div style="font-weight:normal; text-align:center; font-size:10px">
                                            {{$superficie[2]}} m2
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
                                        <?php
                                        for($i=0;$i<sizeof($caracteristicas);$i++) {
                                        ?>
                                        {{$caracteristicas[$i]}}<br>                      
                                        <?php
                                        }
                                        ?>
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
                                            {{$ubicacion}}<br>
                                            <?php echo strtoupper($localidad->nombre_municipio).", ".strtoupper($localidad->nom_ent) ?>
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
                                            {{$nombre[0]}}
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
                                            {{$fecha}}
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