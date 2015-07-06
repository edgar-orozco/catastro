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
                border-spacing: 20px 0px;
                font-family:sans-serif;
                font-size: 11px;
                word-wrap: break-word;
                /*border-spacing: 3px;*/

            }
            th {
                padding: 0.3em;
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
            <p class="encabezado"><strong>I. Cédula Unica Catastral</strong></p>
            <div class="header"> 
            </div>
            <br>
            <div class="info-propietario">
            </div>
            <div>
                <br>
                <table style="margin-left: 80px" width="400">
                    <?php
//                  print_r($predios);
//                    echo 'sdsd'.strlen('08-U-021088');
                    foreach ($predios as $prop) {
                        $predio = $prop->tipo_predio;
                        $clave = $prop->clave_catas;
                        $folio = $prop->folio;
                        $curt = $prop->curt;
                        $mun = $prop->municipio;
                        $ent = $prop->entidad;
                        $sup = $prop->superficie_terreno;
                        if ($predio == 'U') {
                            $tipo = 'Urbano';
                        } else {
                            $tipo = 'Rustico';
                        }
                    }


//                   
                    $clave_cat = '27' . '-' . $mun . '-' . $clave;
                    ?>
                    <tr>
                        <th style="background:none;border: none"></th>
                        <th>Datos</th>
                    </tr>
                    <tr>
                        <td style="border-top:1px solid #dddddd ">Tipo de tenencia:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Clasificacion De Tenencia:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nombre Del Predio:</td>

                        <td>{{$tipo}}</td>

                    </tr>
                    <tr>
                        <td>Tipo De Predio Social</td>
                        <td>{{ $clave }}</td>
                    </tr>
                    <tr>
                        <td>Clave Catastral:</td>
                        <td>{{$clave}}</td>
                    </tr>
                    <tr>
                        <td>Clave Catastral estandar:</td>
                        <td> {{ $clave_cat}}</td>
                    </tr>
                    <tr>
                        <td>Folio Real Electronico:</td>
                        <td>{{$folio}}</td>
                    </tr>
                    <tr>
                        <td>Fecha de inscripcion al RPP:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tipo De Certificado:</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Fecha de expedicion del certificado:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Num de Certificado:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Folios de Tierras:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Folios de derecho</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Clave unica del registro del territorio (CURT):</td>
                        <td>{{$curt}}</td>
                    </tr>                
                </table>
                <p class="encabezado"><strong>II. Ámbito del Predio </strong></p>
                <table style="margin-left: 80px" width="400">
                    <tr>
                        <th style="background:none;border: none"></th>
                        <th>Datos</th>
                    </tr>
                    <tr>
                        <td>Ámbito del predio(rural-urbano):</td>
                        <td>{{$tipo}}</td>
                    </tr>
                </table>
                <hr>
                <?php
//                echo '<pre>';
////                print_r($predios);
//                echo '</pre>';
                foreach ($predios as $pre) {
                    $mun = $pre->municipio;
                }
                ?>
                <p class="encabezado"><strong>III.Ubicación del Predio </strong></p>
                <table style="" width="500">
                    <tr>
                        <th style="background:none;border: none"></th>
                        <th>Datos</th>
                    </tr>
                    <tr>
                        <td>Entidad Federativa:</td>
                        <td><?php echo $predio->entidad; ?></td>
                    </tr>
                    <tr>
                        <?php
                        if ($mun == 001) {
                            $nombremun = "Balancan";
                        } elseif ($mun == 002) {
                            $nombremun = "Cárdenas";
                        } elseif ($mun == 003) {
                            $nombremun = "Centla";
                        } elseif ($mun == 004) {
                            $nombremun = "Centro";
                        } elseif ($mun == 005) {
                            $nombremun = "Comalcalco";
                        } elseif ($mun == 006) {
                            $nombremun = "Cunduacan";
                        } elseif ($mun == 007) {
                            $nombremun = "Emiliano Zapata";
                        } elseif ($mun == 008) {
                            $nombremun = "Huimanguillo";
                        } elseif ($mun == 009) {
                            $nombremun = "Jalapa";
                        } elseif ($mun == 010) {
                            $nombremun = "Jalpa de Méndez";
                        } elseif ($mun == 011) {
                            $nombremun = "Jonuta";
                        } elseif ($mun == 012) {
                            $nombremun = "Mascuspana";
                        } elseif ($mun == 013) {
                            $nombremun = "Nacajuca";
                        } elseif ($mun == 014) {
                            $nombremun = "Paraiso";
                        } elseif ($mun == 015) {
                            $nombremun = "Tacotalpa";
                        } elseif ($mun == 016) {
                            $nombremun = "Teapa";
                        } elseif ($mun == 017) {
                            $nombremun = "Tenosique";
                        }
                        ?>
                        <td>Municipio o delegación:</td>
                        <td><?php echo $nombremun ?></td>  
                    </tr>
                    <tr>
                        <td>Localidad:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nomenclatura y división cartográfica:</td>
                        <td></td> 

                    </tr>
                    <tr>
                        <td><br></td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <?php
                        foreach ($localidad as $loc) {
                            $ubicacion = $loc->ubicacion;
                            $nombre = $loc->nombrec;
                        }
                        ?>
                        <td>Domicilio:</td>
                        <td><?php echo $ubicacion ?></td>
                    </tr>
                    <tr>
                        <td>Tipo de vialidad:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nombre de la vialidad:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Término generico de la vía de la comunicacion:</td>
                        <td></td>   
                    </tr>
                    <tr>
                        <td>Tipo administración de la vía de comunicación:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Derecho de Tránsito de la vía de la comunicación :</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Codigo de la vía de la comunicación:</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Tramo de la vía de la comunicación :</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Derecho de Tránsito de la vía de la comunicación :</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Cadenamiento de la vía de la comunicación :</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Margen de la vía de la comunicación :</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Número Exterior:</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Número Exterior Anterior :</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Edificio:</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Nivel:</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Número Interior:</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Entre Vialidades:</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Vialidad Izquierda:</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Vialidad Derecha:</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Vialidad Posterior:</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Descripción de Ubicacion:</td>
                        <td></td>  
                    </tr>

                    <tr>
                        <td>Tipo de Asentamiento Urbano:</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Nombre de Asentamiento Humano:</td>
                        <td></td>  
                    </tr>

                    <tr>
                        <td>Código Postal:</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td><br></td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>Factor del Indiviso:</td>
                        <td></td>  
                    </tr>
                    <tr>
                        <td>Núcleo Agrario:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Número de Poligono Ejidal o Comunal:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Número de Zona de las Tierras de Uso Común:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Número de Parcela:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><br></td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <?php
                        foreach ($centros as $centro) {
                            $centroide = $centro->centro;
                        }
                        ?>
                        <td>Centro del Predio:</td>
                        <td style="word-wrap: break-word;height: auto;"><?php echo $centroide ?></td>
                    <tr>
                        <?php
//                        print_r($lat);
                        foreach ($lat as $long) {
                            $latitud = $long->lat_long;
                        }
                        $lat = strlen($latitud);                   
                        $mid = $lat / 2;                      
                        $lat = substr($latitud, 0, $mid);
                        $long = substr($latitud, $mid, $mid + 2);
                         ?>
                        <td>Latitud:</td>
                        <td><?php echo $lat  ?></td>
                    </tr>
                    <tr>
                        <td>Longitud:</td>
                        <td><?php echo $long ?></td>
                    </tr>                 
                </table>
                <hr>
                <p class="encabezado"><strong>IV.Datos Del Propietario </strong></p>
                <table style="margin-left: 80px" width="400">
                    <tr>
                        <th style="background:none;border: none"></th>
                        <th>Datos</th>
                    </tr>
                    <tr>
                        <?php
                        foreach ($totalp as $total) {
                            $total = $total->total;
                        }
                        ?>
                        <td>Total propietarios que tiene derecho al predio:</td>
                        <td><?php echo $total; ?></td>
                    </tr>
                    <tr>
                        <td>Tipo de Propietario:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Clase de Propietario(Fisica ó Moral):</td>
                        <td></td>
                    </tr>
                    <tr>
                        <?php
                        foreach ($localidad as $loc) {
                            $ubicacion = $loc->ubicacion;
                            $nombre = $loc->nombrec;
                        }
//                        echo $nombre;
                        $str = explode(" ", $nombre);
//                        print_r ($str);
                        ?>
                        <td>Nombre(s) del Propietario:</td>
                        <td><?php echo $str[2] ?></td>
                    </tr>
                    <tr>
                        <td>Apellido Paterno:</td>
                        <td><?php echo $str[0] ?></td>
                    </tr>
                    <tr>
                        <td>Apellido Materno:</td>
                        <td><?php echo $str[1] ?></td>
                    </tr>
                    <tr>
                        <?php
                        foreach ($rfc as $per) {
                            $rfc = $per->rfc;
                            $curp = $per->curp;
                            if ($rfc == "") {
                                $rfc = 'No hay RFC registrado';
                            }
                            if ($curp == "") {
                                $curp = 'No hay Curp registrado ';
                            }
                        }
                        ?>
                        <td>RFC:</td>
                        <td><?php echo $rfc; ?></td>
                    </tr>
                    <tr>
                        <td>CURP:</td>
                        <td><?php echo $curp; ?></td>
                    </tr>
                    <tr>
                        <td><br></td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>Nombre(s) del Propietario:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Apellido Paterno:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Apellido Materno:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>RFC:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>CURP:</td>
                        <td></td>
                    </tr>
                </table>
                <hr>
                <br>
                <p class="encabezado"><strong>V.Características del Predio</strong></p>
                <table style="margin-left: 80px" width="404">
                    <tr>
                        <th style="background:none;border: none"></th>
                        <th>Datos</th>
                    </tr>
                    <tr>
                        <td>Uso de Suelo:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tipo de Infraestructura:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tipo de Equipamiento:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Clase de Tierra:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Servicios Disponible para el predio:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Ubicacion del predio dentro de la manzana:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Forma:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tipo de vía de acceso:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Medida del enfrente:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Medida de fondo:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Ubicacion del predio con referencia al nivel de la calle:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tipo de relieve donde se ubica el predio:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Distancia de las vias de comunicacion:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Facilidades de comunicaciones y transporte:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Condiciones agrólogicas de las region:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Disponibilidad de agua:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <?php
//                                             print_r($super);
                        foreach ($super as $key) {
                            $sup_priva = $key->sup_terr_privativa;
                            $comun = $key->sup_comun_magno_terreno;
                            $sup = $key->sup_total_terreno;
                            if ($sup_priva == "") {
                                '0.00';
                            }
                            if ($comun == "") {
                                '0.00';
                            }
                        }
                        ?>
                        <td>Superficie del terreno privativo en m<sup>2</sup>:</td>
                        <td><?php echo $sup_priva; ?></td>
                    </tr>
                    <tr>
                        <td>Superficie del terreno común en m<sup>2</sup>:</td>
                        <td><?php echo $comun ?></td>
                    </tr>
                    <tr>
                        <td>Superficie del terreno del predio:</td>
                        <td>{{$sup}}</td>
                    </tr>
                    <tr>
                        <td>Unidad de la superficie total del terreno del predio:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Unidad de la superficie total del terreno del predio:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Superficie de la construcciones privativa en m<sup>2</sup>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Superficie de la construccion común  en m<sup>2</sup>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Valor catastral de la construccion:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Valor de operación:</td>
                        <td></td>
                    </tr>
                </table>
                <br>
                <p class="encabezado"><strong>VI.Características de la Construcción</strong></p>
                <table style="margin-left: 80px" width="400">
                    <tr>
                        <th style="background:none;border: none"></th>
                        <th>Datos</th>
                    </tr>
                    <tr>
                        <td>Número Identificador:</td>
                        <td></td>                    </tr>
                    <tr>
                        <td>Antigüedad:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Grado de Avance:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Conservación:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Número de Niveles:</td>
                        <td><?php
                        foreach ($niveles as $nivel) {
                            echo $nivel = $nivel->numnivel;
                        }
                        ?></td>
                    </tr>
                    <tr>
                        <td>Tipo de Viviendas:</td>
                        <td></td>
                    </tr>
                </table>
                <hr>
                <br>
                <p class="encabezado"><strong>VII.Gráfico Del Predio</strong></p>
                <table style="margin-left: 80px" width="400">
                    <tr>
                        <th>Datos</th>
                    </tr>
                    <tr>

                        <td style="text-align: center">
                            <img id="refMapImg" style="border-style: solid; border-color: #000"  width="400" height="300" src=".<?php echo $mapURL; ?>" alt="">
                        </td>
                    </tr>
                </table>
                <br>    
                <p class="encabezado"><strong>VIII.Colindancias</strong></p>
                <table class="none" style="margin-left: 80px" width="400">
                    <tr>
                        <th style="background:none;border: none"></th>
                        <th style="background:none;border: none"></th>
                        <th>Datos</th>
                    </tr>
                    <tr>
                        <td style=" border-spacing:0">Norte</td> 
                        <td style=" border-spacing:0">Total: <br>Descripción:</td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>Noreste</td> 
                        <td>Total: <br>Descripción:</td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>Este</td> 
                        <td>Total: <br>Descripción:</td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>Sureste</td> 
                        <td>Total: <br>Descripción:</td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>Sur</td> 
                        <td>Total: <br>Descripción:</td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>Suroeste</td> 
                        <td>Total: <br>Descripción:</td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>Oeste</td> 
                        <td>Total: <br>Descripción:</td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>Noroeste:</td> 
                        <td>Total: <br>Descripción:</td>
                        <td><br></td>
                    </tr>
                </table>
                <br>
                <p class="encabezado"><strong>IX.Datos de Control</strong></p>
                <table style="margin-left: 80px" width="400">
                    <tr>
                        <th style="background:none;border: none"></th>
                        <th>Datos</th>
                    </tr>
                    <tr>
                        <td>Fecha y lugar del llenado de la cédula</td>
                        <td><?php echo date('d-m-Y'); ?></td>
                    </tr>
                    <tr>
                        <td>Nombre de la persona que llenó la cédula</td>
                        <td>SICARET V1.0</td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>


