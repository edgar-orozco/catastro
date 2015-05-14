<html>
    <head>
        <style>
            .titulo
            {
                font-weight:bold;
                /*width: 300px;*/
            }
            @page invitacion {
                size: A4 portrait;
                margin: 2cm;
                font-family: arial;
                font-size:8px;
            }
            .invitacionPage
            {
                page: invitacion;
                page-break-after: always;
            }
            table {
                /*width:600px;*/
                border: 1px solid #dddddd;
                text-align: center;
                border-collapse: collapse;
                /*margin-left: 80px;*/
                /*margin: 0 0 1em 0;*/
                /*caption-side: top;*/
            }
            /*            table tr {
                            border: 1px solid #dddddd;
                            font-size:14px;
                        }
                        table td th {
                            padding: 5px;
                            text-align: left;
                             border: 1px solid #dddddd;
                        }*/
            td, th {
                padding: 0.3em;
            }
            th, td {
                border-bottom: 1px solid #dddddd;
                width: 25%;
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

        </style>
    </head>
    <body>
        <div class="invitacionPage"> 
            <table style="border:none;">
                <tr>
                    <td><img src="css/images/main/main-logo.png" width="140" height="88" alt="Catastro"/></td>
                    <td><img src="css/images/home/secrt.png" width="140" height="88" alt="Secretaria de planeacion y finanzas"/></td>
                    <td> <img src="css/images/main/logo-header.png" width="92" height="88" alt="Catastro"></td>
                    <td align="right" width="250">Gobierno del Estado de Tabasco<br>
                        Secretaria de Planeción y Finanzas<br>
                        Dirección General de Catastro
                        <p>Av.Adolfo Ruiz Cortinez s/n<br>Col. Casa Blanca C.P.86060 <br>Villahermosa Tabasco</p>
                    </td>
                </tr>
            </table> 
            <br>
            <p class="encabezado"><strong>Cédula Unica Catastral</strong></p>
            <div class="header"> 
<!--                <table  rules="all">
                    <tr>
                       
                        <td class='row'>Clave Catastral:</td>
                        <td class='row'> </td>
                        <td class='row'>Folio Real:</td>
                        <td class='row'></td> 

                    </tr>
                </table>-->
            </div>
            <br>
            <div class="info-propietario">
<!--                <table  rules="all">
                    <tr>
                        <td class='row'> Tipo Propietario </td>
                        <td class='row'> Apellido Paterno </td>
                        <td class='row'> Apellido Materno </td>
                        <td class='row'> Nombre(s) ó Razón Social </td>
                        <td class='row'> Curp </td>
                    </tr>
                    <tr>
                        
                        <td class='row'></td>
                      
                        <td class='row'></td>
                        <td class='row'></td>
                        <td class='row'></td>
                        <td class='row'></td>
                    </tr>
                </table>-->
            </div>

            <div>
                <br>
                <table style="margin-left: 80px" width="400">
                    <?php
                    foreach ($predios as $prop) {
                        $predio = $prop->tipo_predio;
                        $clave = $prop->clave_catas;
                        $folio = $prop->folio;
                        $curt = $prop->curt;
                        $mun = $predios->municipio;
                        $ent = $predio->entidad;
                    }

                    if ($predio == 'U') {
                        $tipo = 'Urbano';
                    } else {
                        $tipo = 'Rustico';
                    }
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
                    $clave_cat = '27' . '-' . $num . '-' . $clave;
                    ?>
                    <tr>
                        <td>Tipo de tenencia:</td>
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
                        <td>{{$clave}}</td>
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
                        <td>Folios de Tierrass:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Folios de derecho</td>
                        <td><</td>
                    </tr>
                    <tr>
                        <td>Clave unica del registro del territorio (CURT):</td>
                        <td>{{$curt}}</td>
                    </tr>                
                </table>
            </div>
        </div>
    </body>
</html>


