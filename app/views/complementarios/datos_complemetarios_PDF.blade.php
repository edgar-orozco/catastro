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
                        } else {
                            $tipo = 'Rustico';
                        }
                        ?>
                        <td class='row'>{{$tipo}}</td>
                        <?php
                        if ($predios->municipio = 001) {
                            $num = '001';
                        } else if ($predios->municipio = 002) {
                            $num = '002';
                        } else if ($predios->municipio = 003) {
                            $num = '003';
                        } else if ($predios->municipio = 004) {
                            $num = '004';
                        } else if ($predios->municipio = 005) {
                            $num = '005';
                        } else if ($predios->municipio = 006) {
                            $num = '006';
                        } else if ($predios->municipio = 007) {
                            $num = '007';
                        } else if ($predios->municipio = 008) {
                            $num = '008';
                        } else if ($predios->municipio = 009) {
                            $num = '009';
                        } else if ($predios->municipio = 010) {
                            $num = '010';
                        } else if ($predios->municipio = 011) {
                            $num = '011';
                        } else if ($predios->municipio = 012) {
                            $num = '012';
                        } else if ($predios->municipio = 013) {
                            $num = '013';
                        } else if ($predios->municipio = 014) {
                            $num = '014';
                        } else if ($predios->municipio = 015) {
                            $num = '015';
                        } else if ($predios->municipio = 016) {
                            $num = '016';
                        } else if ($predios->municipio = 017) {
                            $num = '017';
                        }
//                        $clave_cat = $predio->entidad . '-' . $num . '-' . $clave;
//                        $prop = DB::SELECT("SELECT datos_propietarios('$clave_cat')");
//                        foreach ($prop as $row) {
//                            $item = explode(' ', $row->datos_propietarios);
//                        }

                        foreach ($nombre as $row) {
                            $row;
                        }
//                        $item=explode(' ',$nombre);
//                         echo $item;
                        ?>
                        <td colspan="3" ><?php echo $row; ?></td>

                        <td ></td>

                    </tr>
                </table>
            </div>

            <div>
                <?php
                if ($predios->municipio = 001) {
                    $mun = 'Balancán';
                } else if ($predios->municipio = 002) {
                    $mun = 'Cárdenas';
                } else if ($predios->municipio = 003) {
                    $mun = 'Centla';
                } else if ($predios->municipio = 004) {
                    $mun = 'Centro';
                } else if ($predios->municipio = 005) {
                    $mun = 'Comalcalco';
                } else if ($predios->municipio = 006) {
                    $mun = 'Cunduacán';
                } else if ($predios->municipio = 007) {
                    $mun = 'Emiliano Zapata';
                } else if ($predios->municipio = 008) {
                    $mun = 'Huimanguillo';
                } else if ($predios->municipio = 009) {
                    $mun = 'Jalapa';
                } else if ($predios->municipio = 010) {
                    $mun = 'Jalpa de Méndez';
                } else if ($predios->municipio = 011) {
                    $mun = 'Jonuta';
                } else if ($predios->municipio = 012) {
                    $mun = 'Macuspana';
                } else if ($predios->municipio = 013) {
                    $mun = 'Nacajuca';
                } else if ($predios->municipio = 014) {
                    $mun = 'Paraíso';
                } else if ($predios->municipio = 015) {
                    $mun = 'Tacotalpa';
                } else if ($predios->municipio = 016) {
                    $mun = 'Teapa';
                } else if ($predios->municipio = 017) {
                    $mun = 'Tenosique';
                }
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
                        <?php
//                        foreach ($predios as $pre) {
//                            echo $pre->municipio;
//                            if($pre->municipio == 008)
//                            {
//                              echo   $total='municipio';
//                            }
                        ?>
                        <td><?php echo $mun ?> </td>
                        <?php // } ?>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Localidad</td>
                        <td>{{$localidad[2]}}</td>
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
                        <td>Num de Exterior:</td>
                        <td>{{$localidad[0]}}</td>
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
                        <td>{{$localidad[0]}}</td>
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
                        <td>{{$localidad[4]}}</td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <?php
                        foreach ($lat as $long) {
                            $latitud = $long->xmax;
                            $longitud = $long->ymax;
                        }
                        ?>
                        <td>Centroide del Predio Latitud:</td>
                        <td><?php //echo $predios->geo;     ?><?php echo $latitud ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Centroide del Predio Longitud:</td>
                        <td><?php echo $longitud; ?></td>
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

