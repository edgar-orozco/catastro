<html>
    <head>
        <style>
            .titulo
            {
                font-weight:bold;
            }
            /* @page invitacion {
                size: A4 portrait;
                            margin: 2cm;
                            font-family: arial;
                            font-size:8px;
                                    }*/
            .invitacionPage
            {
                /*  page: invitacion;
                    page-break-after: always;*/
                background-repeat: no-repeat;
                width: 100%;
                height: 97%;
            }
            table {            
                text-align: left;                
                border-collapse: separate;
                /*border-spacing: 20px 0px;*/
                font-family:sans-serif;
                font-size: 11px;
                word-wrap: break-word;
                /*border-spacing: 3px;*/

            }
            th {
                /*padding: 0.3em;*/
                background-color:  #dddddd;
                color: #000;
                word-wrap: break-word;
            }
            td{
                border: 1px solid #dddddd;
                width: 25%;
                word-wrap: break-word;
                height: auto;
            }
            .letras{
                margin-left: 400px;
                margin-top: 0px;
                font-size:12px;
            }
            .encabezado
            {
                text-align: center;
            }
            hr {
                page-break-after: always;
                border: 0;
                margin: 0;
                padding: 0;
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
                    <td style="border:none; font-family:sans-serif;font-size: 10px " align="right" width="200">Gobierno del Estado de Tabasco<br>
                        Secretaria de Planeción y Finanzas<br>
                        Dirección General de Catastro
                        <p>Av.Adolfo Ruiz Cortinez s/n<br>Col. Casa Blanca C.P.86060 <br>Villahermosa Tabasco</p>
                    </td>
                </tr>
            </table> 
            <br>
            <p class="encabezado"><strong>Cédula Catastral Registral</strong></p>
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
                        <td class='row'style="border:none">Clave Catastral:</td>
                        <td class='row'style="border:none">{{$clave}} </td>
                        <td class='row'style="border:none">Folio Real:</td>
                        <td class='row'style="border:none">{{$folio}} </td> 
                    </tr>
                </table>
            </div>
            <br>
            <div class="info-propietario">
                <table style="width:100%">
                    <tr>
                        <td width="5%" class='row'> Tipo Propiedad </td>
                        <td width="8%" class='row'> Apellido Paterno </td>
                        <td width="8%" class='row'> Apellido Materno </td>
                        <td width="8%" class='row'> Nombre(s) ó Razón Social </td>
                        <td width="10%" class='row'> Curp </td>
                    </tr>
                    <tr>
                        <?php
                        foreach ($predios as $row) {
                            $tp = $row->tipo_predio;
                            $entidad = $row->entidad;
                            if ($tp == 'U') {
                                $tipo = 'Urbano';
                            } elseif ($tp == '') {
                                $tipo = "";
                            } else {
                                $tipo = 'Rustico';
                            }
                            ?>
                            <td class='row'><?php echo $tipo ?></td>
                        <?php } ?>

                        <?php
//                        echo "<pre>";
//                        print_r($predios);
//                               echo "</pre>";
                        foreach ($predios as $predio) {
                            $municipio = $predio->municipio;
                            $valor=$predio->valor_catastral;
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
                        foreach ($localidad as $row) {
                            $nombre = $row->nombrec;
                        }
                        if ($nombre == "") {
                            $name = "No Hay Propietario Registrado";
                        }
                        $name = $nombre;
                        ?>
                        <td colspan="3" ><?php echo $nombre ?></td>
                        <?php
                        foreach ($rfc as $row) {
                            $curp = $row->curp;
                            if ($curp == "") {
                                $curp = "No hay CURP registrada";
                            }
                        }
                        ?>
                        <td>{{$curp}}</td>

                    </tr>
                </table>
            </div>

            <div>
                <br>
                <table style="width:100%"  >
                    <tr>
                        <td width="10%">Tipo de Dato :</td>
                        <td width="10%">Catastro:</td>
                        <td width="10%">RPP- RAN -INDAABIN:</td>  
                    </tr>
                    <tr>
                        <td>Tipo de Predio:</td>  
                        <td><?php echo $tipo ?></td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Entidad Federativa:</td>
                        <?php
                        if ($entidad == 27) {
                            $entidad = 'Tabasco';
                        }
                        ?>
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
                        foreach ($localidad as $dom) {
                            $loc = $dom->ubicacion;
                        }
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
//                        if ($localidad[0] == "") {
//                            $numi = "Sin Numero Interior";
//                        } else {
//                            $numi = $localidad[0];
//                        }
                        ?>

                        <td>Num de Exterior:</td>
                        <td><?php // echo $numi  ?></td>
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
                        <?php
                        foreach ($niveles as $row) {
                            $nvel=$row->numnivel;
                        
                        if ($nivel=="") {
                            $nivel = 'Sin Niveles';
                        } else {
                            $nivel = $nvel;
                        }
                        }
                        ?>
                        <td><?php echo $nivel ?></td>
                        <td></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Num de Interior:</td>
<?php
//$locarray=str_split($loc);
//var_dump($locarray);

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
//                        if ($localidad[4] == "") {
//                            $cp = "Sin Codigo Postal";
//                        } else {
//                            $cp = $localidad[4];
//                        }
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
                        <?php
                        $lat = strlen($latitud);
                        $mid = $lat / 2;
                        $lat = substr($latitud, 0, $mid);
                        $long = substr($latitud, $mid, $mid + 2);
                        ?>
                        <td><?php echo $lat ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Centroide del Predio Longitud:</td>
                        <td><?php echo $long ?></td>
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
                        <?php 
                        if($valor=="")
                        {
                            $val="Sin valor registrado";
                        }else
                        {
                            $val = $valor;
                        }
                        ?>
                        <td><?php echo '$'.$val?></td>
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
//                        foreach ($imagenes as $url) {
                    ?>
                        <td style="border:none;" width="16%"><img  src=".<?php print_r($mapURL) ?>"width="200" height="150"/></td>
                        <?php // }    ?>
                        <!--<td  style="border:none;" width="16%"><img  src="<?php // echo $img . '/' . $dir;         ?>" width="200" height="150"/></td>-->

<!--<td width="20%" style="text-align: center;"><img width="300" height="250" src="/complementarios/anexos/008/002/0007/002-0007-000008/1-2-22-05-15-0020007000008.jpg"/></td>-->
                    </tr>
                </table> 

            </div>
        </div>
    </body>
</html>