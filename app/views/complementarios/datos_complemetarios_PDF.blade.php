<html>
    <head>
        <style>
            .titulo
            {
                font-weight:bold;
                width: 300px;

            }
            @page invitacion {
                size: A4 portrait;
                margin: 2cm;
                font-family: arial;
                font-size:8px;
            }
            table {
                border: 1px solid #dddddd;
                text-align: center;
                border-collapse: collapse;

            }
            td, th {
                /*padding: 0.3em;*/
            }
            th, td {
                border: 1px solid #dddddd;
                width: 15%;
            }

            .invitacionPage
            {
                page: invitacion;
                page-break-after: always;
            }
            /*            table tr {
                            border: 1px solid black;
                            font-size:14px;
                        }
                        table td th {
                            padding: 5px;
                            text-align: left;
                        }*/
            .letras{
                margin-left: 400px;
                margin-top: 0px;
                font-size:12px;

            }

        </style>
    </head>
    <body>
        <div class="invitacionPage"> 
            <table style="border:none;">
                <tr>
                    <td style="border:none;"><img src="css/images/main/main-logo.png" width="140" height="88" alt="Catastro"/></td>
                    <td style="border:none;"><img src="css/images/home/secrt.png" width="140" height="88" alt="Secretaria de planeacion y finanzas"/></td>
                    <td style="border:none;"> <img src="css/images/main/logo-header.png" width="92" height="88" alt="Catastro"></td>
                    <td  style="border:none;" align="right" width="250">Gobierno del Estado de Tabasco<br>
                        Secretaria de Planeción y Finanzas<br>
                        Dirección General de Catastro
                        <p>Av.Adolfo Ruiz Cortinez s/n<br>Col. Casa Blanca C.P.86060 <br>Villahermosa Tabasco</p>
                    </td>
                </tr>
            </table> 
            <br>
            <p class="encabezado"><strong>Cédula Unica Catastral</strong></p>
            <div class="header"> 
                <table >
                    <tr>
                        <?php
                        foreach ($predios as $predio) {
                            $clave = $predio->clave_catas;
                            $folio = $predio->folio;
                            $predio = $predio->tipo_predio;
                            $nivel = $predio->nivel;
                        }
                        ?>
                        <td class='row'>Clave Catastral:</td>
                        <td class='row'>{{$clave}} </td>
                        <td class='row'>Folio Real:</td>
                        <td class='row'>{{$folio}} </td> 

                    </tr>
                </table>
            </div>
            <br>
            <div class="info-propietario">
                <table style="width:100%">
                    <tr>
                        <td width="5%" class='row'> Tipo Propietario </td>
                        <td width="8%" class='row'> Apellido Paterno </td>
                        <td width="8%" class='row'> Apellido Materno </td>
                        <td width="8%" class='row'> Nombre(s) ó Razón Social </td>
                        <td width="10%" class='row'> Curp </td>
                    </tr>
                    <tr>
                        <?php
                        if ($predio == 'U') {
                            $tipo = 'Urbano';
                        } elseif ($predio == '') {
                            $tipo = "";
                        } else {
                            $tipo = 'Rustico';
                        }
                        ?>
                        <td class='row'>{{$tipo}}</td>
                        <?php
//                        echo "<pre>";
//                        print_r($predios);
//                               echo "</pre>";
                        foreach ($predios as $predio) {
                            $municipio = $predio->municipio;
                        }
                        if ($municipio == 1) {
                            $num = "Balancan";
                        } elseif ($municipio == 2) {
                            $num = "Cárdenas";
                        } elseif ($municipio == 3) {
                            $num = "Centla";
                        } elseif ($municipio == 4) {
                            $num = "Centro";
                        } elseif ($municipio == 5) {
                            $num = "Comalcalco";
                        } elseif ($municipio == 6) {
                            $num = "Cunduacan";
                        } elseif ($municipio == 7) {
                            $num = "Emiliano Zapata";
                        } elseif ($municipio == 8) {
                            $num = "Huimanguillo";
                        } elseif ($municipio == 9) {
                            $num = "Jalapa";
                        } elseif ($municipio == 10) {
                            $num = "Jalpa de Méndez";
                        } elseif ($municipio == 11) {
                            $num = "Jonuta";
                        } elseif ($municipio == 12) {
                            $num = "Mascuspana";
                        } elseif ($municipio == 13) {
                            $num = "Nacajuca";
                        } elseif ($municipio == 14) {
                            $num = "Paraiso";
                        } elseif ($municipio == 15) {
                            $num = "Tacotalpa";
                        } elseif ($municipio == 16) {
                            $num = "Teapa";
                        } elseif ($municipio == 17) {
                            $num = "Tenosique";
                        }
                        ?>
                        <?php
//                        echo'asasass'. $nombre[0];
//                        var_dump($nombre);
//                         foreach ($nombre as $row) {
//                           echo 'ss'. $row[0];
//                        }
                        if ($nombre[0] == "") {
                            $name = "No Hay Propietario Registrado";
                        }
                        $name = $nombre[0];
                        ?>
                        <td colspan="3" ><?php echo $nombre[0] ?></td>

                        <td ></td>

                    </tr>
                </table>
            </div>

            <div>
                <?php
                if ($predios->entidad = '27') {
                    $entidad = 'Tabasco';
                }
                ?>
                <br>
                <table style="width:100%"  >
                    <tr>
                        <td width="10%">Tipo de Dato :</td>
                        <td width="10%">Catastro:</td>
                        <td width="10%">RPP- RAN -INDAABIN:</td>  
                    </tr>
                    <tr>
                        <td>Tipo de Predio:</td>  
                        <td>{{$tipo}}</td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Entidad Federativa:</td>
                        <td>{{$entidad}}</td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Municipio ó Delegacion:</td>
                        <td><?php echo $num ?> </td>                     
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Localidad</td>
                        <?php
                        if ($localidad[2] == "") {
                            $loc = "Sin Localidad";
                        }
                        $loc = $localidad[2]
                        ?>
                        <td><?php echo $loc ?></td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Tipo de Vialidad:</td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <?php
                        if ($localidad[0] == "") {
                            $numi = "Sin Numero Interior";
                        } else {
                            $numi = $localidad[0];
                        }
                        ?>

                        <td>Num de Exterior:</td>
                        <td><?php echo $numi ?></td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Num de Predio:</td>
                        <td>{{$numpredio}}</td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Nivel:</td>
                        <td>{{$nivel}}</td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Num de Interior:</td>
                        <?php
                        if ($localidad[0] == "") {
                            $numi = "Sin Numero Interior";
                        } else {
                            $numi = $localidad[0];
                        }
                        ?>
                        <td><?php echo $numi ?></td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Asentamiento Humano:</td>
                        <td>{{$tipo}}</td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Código Postal:</td>
                        <?php
                        if ($localidad[4] == "") {
                            $cp = "Sin Codigo Postal";
                        } else {
                            $cp = $localidad[4];
                        }
                        ?>
                        <td><?php echo $cp ?></td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <?php
                        foreach ($lat as $long) {
                            $latitud = $long->lat_long;
                        }
                        ?>
                        <td>Centroide del Predio Latitud:</td>
                        <td><?php echo $lat = substr($latitud, 0, 15); ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Centroide del Predio Longitud:</td>
                        <td><?php echo $long = substr($latitud, 15, 16); ?></td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Superficie / Unidad de Medida:</td>
                        <td>M<sup>2</sup></td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Valor:</td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tr>

                    <?php foreach ($condominio as $cond) { ?>
                        <tr>
                            <td>Tipo Privativa:</td>
                            <td>{{$cond->tipo_priva}}</td>
                            <td></td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Terreno Común:</td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Total Construcción Privativa:</td>
                            <td>{{$cond->sup_privativa}}</td>
                            <td></td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Construcción Común:</td>
                            <td>{{$cond->sup_total_comun}}</td>
                            <td></td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Total Construcción:</td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tr> 

                    <?php } ?>
                </table>
                <br>
                <br>
                <table width="100%" style="border:none;">
                    <?php
//                    echo $imagenes;
                    ?>
                    <tr>  
                        <?php
                        foreach ($imagenes as $url) {
                            ?>
                            <td style="border:none;" width="16%"><img  src=".<?php echo $url->nombre_archivo ?>"width="200" height="150"/></td>
                        <?php } ?>
                        <td  style="border:none;" width="16%"><img  src="<?php echo $img . '/' . $dir; ?>" width="200" height="150"/></td>

<!--<td width="20%" style="text-align: center;"><img width="300" height="250" src="/complementarios/anexos/008/002/0007/002-0007-000008/1-2-22-05-15-0020007000008.jpg"/></td>-->
                    </tr>
                </table> 

            </div>
        </div>
    </body>
</html>