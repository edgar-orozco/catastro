<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>

<style>


    #contenedor {
        /*border: thin solid #000000;*/
        background-repeat: no-repeat;
        background-position: center;
        background-image: url("{{$directo}}css/images/main/logo-header.png-agua.png");
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 9px;
        color: #000000;
        width: 100%;
        /*width: 670px;*/

    }

    #contenedor > table {
        *border-collapse: collapse; /* IE7 and lower */
        border-spacing: 0;
    }

    #cabecera {
        height: 15%;
    }

    table.container {
        width: 100%;

        margin-bottom: 15px;
        border: 1px solid black;
    }

    td {
        font-size: 11px;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        color: #000000;
        padding: 3px;
    }

    table.container td {
        font-size: 11px;
        font-family: Verdana, Arial, Helvetica, sans-serif;

        color: #000000;
        padding: 3px;
    }

    table.container th {
        font-size: 9px;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        color: #000000;

        border-bottom: 1px solid black;
        height: 2px;
    }

    td.advertencias{
        font-size: 8px;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        color: #000000;
        padding: 3px;
    }
</style>
<body>

<div id="contenedor">

    <table class="container" width="100%" style="border: none !important">
        <tr>
            <td width="20%" align="center"><img src="{{$directo}}css/images/main/main-logo.png"  height="70"></td>
            <td width="60%" align="center" class="title"><h4>Subsecretaría de Ingresos<br>
                    Dirección General de Catastro<br>
                    Y Ejecución Fiscal<br>
                    Dirección de Catastro</h4></td>
            <td width="20%" align="right"><img src="{{$directo}}css/images/main/logo-spf.png" height="70"></td>
        </tr>
    </table>

    <table class="container" width="100%" style="border:thin solid black;">
        <tr>
            <td>CLAVE CATASTRAL:</td>
            <td>
                {{$predio->clave}}
            </td>
            <td>CUENTA PREDIAL:</td>
            <td>
                {{$predio->cuenta}}
            </td>
        </tr>
    </table>

    <table class="container" width="100%" style="border:thin solid black;">
        <tr>
            <td>Contribuyente:</td>
            <td>
                @foreach($predio->propietarios as $propietario)@endforeach
                {{$propietario->propietario->nombrec}}
            </td>
            <td>RFC:</td>
            <td>{{str_replace("-","",$propietario->propietario->rfc)}}</td>
        </tr>
    </table>

    <table class="container" width="100%" style="border:thin solid black;">
        <tr>
            <td colspan="6" align="center">UBICACIÓN DEL PREDIO</td>
        </tr>
        <tr>
            <td>ZONA:</td>
            <td>
                {{substr($predio->clave,7,3)}}
            </td>
            <td>MANZANA:</td>
            <td>{{substr($predio->clave,11,4)}}</td>
            <td>PREDIO:</td>
            <td>{{substr($predio->clave,16,6)}}</td>
        </tr>
        <tr>
            <td>Dirección:</td>
            <td colspan="5">
                {{$predio->ubicacionFiscal->ubicacion}}
            </td>
        </tr>
    </table>

    <table class="container" width="100%" style="border:thin solid black;">
        <tr>
            <td align="center">SUPERFICIE TERRENO</td>
            <td align="center">SUPERFICIE CONSTRUCCION</td>
            <td align="center">VALOR CATASTRAL</td>
        </tr>
        <tr>
            <td align="center">{{number_format( $predio->superficie_terreno, 2,'.',',')}} m<sup>2</sup></td>
            <td align="center">{{number_format( $predio->superficie_construccion, 2,'.',',')}} m<sup>2</sup></td>
            <td align="center">$ {{ number_format( $predio->valor_catastral, 2,'.',',') }}</td>
        </tr>
    </table>

    <table class="container" width="100%" border="1" >
        <tr>
            <td align="center" width="70%">CONCEPTO</td>
            <td align="center">IMPORTE</td>
        </tr>
        <tr>
            <td align="left">IMPUESTO PREDIAL</td>
            <td align="right">$ {{ number_format( $predio->impuesto, 2,'.',',') }}</td>
        </tr>
        @if($actualizacion)
        <tr>
            <td align="left">ACTUALIZACIÓN</td>
            <td align="right">$ {{ number_format( $actualizacion, 2,'.',',') }}</td>
        </tr>
        @endif
        @if($recargos)
        <tr>
            <td align="left">RECARGOS</td>
            <td align="right">$ {{ number_format( $recargos, 2,'.',',') }}</td>
        </tr>
        @endif
        @if($gastosejecucion)
        <tr>
            <td align="left">GASTOS DE EJECUCIÓN</td>
            <td align="right">$ {{ number_format( $gastosejecucion, 2,'.',',') }}</td>
        </tr>
        @endif
        <tr>
            <td align="right">TOTAL A PAGAR</td>
            <td align="right">$ {{ number_format( $total, 2,'.',',') }}</td>
        </tr>

    </table>

    <table class="container" width="100%">
        <tr>
            <td align="center">VIGENCIA<br>
                DEL: {{$linea_captura['vigencia_del']}} <br/>
                AL: {{$linea_captura['vigencia_al']}}
            </td>
            <td align="center" valign="top">
                LÍNEA DE CAPTURA <br/>
                {{$linea_captura['finanzas'] or "201583114706661278"}} <br/>
                <img src="{{$linea_captura_cb['finanzas']}}"/>
            </td>
            <td align="center">
                TRANSACCIÓN <br/>
                {{$linea_captura['transaccion']}}
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td colspan="2" align="center">Puede efectuar su pago en los siguientes bancos y tiendas de conveniencia</td>
        </tr>
        <tr>
            <td  colspan="2" align="center">
                <img src="{{$directo}}logos/logo-oxxo.png" width="120" alt=""/>
                <br>
                {{$linea_captura['oxxo'] or "0900008311471510160012627"}}
                <br>
                <img src="{{$linea_captura_cb['oxxo'] or "0900008311471510160012627"}}" />
            </td>
        </tr>
        <tr>
            <td align="center">
                <table>
                    <tr>
                        <td valign="center" align="center">
                            <img src="{{$directo}}logos/logo-banamex.png" width="100">
                        </td>
                        <td valign="center" align="center">
                            <img src="{{$directo}}logos/logo-bancomer.png" width="100">

                        </td>
                        <td valign="center" align="center">
                            <img src="{{$directo}}logos/logo-banorte.jpg" width="100">

                        </td>
                    </tr>
                    <tr>
                        <td valign="center" align="center">

                            <img src="{{$directo}}logos/logo-elektra.png" width="100">
                        </td>
                        <td valign="center" align="center">
                            <img src="{{$directo}}logos/logo-santander.png" width="100">
                        </td>
                        <td valign="center" align="center">
                            <img src="{{$directo}}logos/logo-telecomtelegrafos.jpg" width="100">

                        </td>
                    </tr>
                    <tr>
                        <td valign="center" align="center">
                            <img src="{{$directo}}logos/logo-banco-azteca.png" width="100" height="70">
                        </td>
                        <td valign="center" align="center">
                            <img src="{{$directo}}logos/logo-scotiabank.jpg" width="100" height="70">
                        </td>
                        <td valign="center" align="center">
                            <img src="{{$directo}}logos/logo-banbajio.jpg" width="100" height="70">
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                BANAMEX : {{$linea_captura['banamex'] or "00201583114706661278"}}<br>
                BANCOMER : CIE =672505<br>
                SCOTIABANK : NO.DE SERVICIO 1098<br>
                BANORTE : NO.DE EMPRESA 48421 <br>
                SANTANDER : CONVENIO =2527 <br>
                HSBC : Clave RAP: 2950 <br>
                BANBAJIO : NO.SERVICIO 1108 <br>
                BANCO AZTECA : <br>
                ELEKTRA : <br/>

            </td>
        </tr>

        <tr>
            <td class="advertencias" valign="top" colspan="2">
                <br>
                <strong>ESTIMADO CONTRIBUYENTE, LE RECOMENDAMOS LEER LOS SIGUIENTES COMENTARIOS:</strong>
                <br>
                En caso de que instrumento de pago sea CHEQUE nominativo distinto al banco donde presentará; su pago, el vencimiento de
                la línea de captura tendrá; un día hábil menos del citado en éste documento. Lo anterior, se debe a políticas bancarias.Si usted
                es contribuyente del Impuesto Especial Sobre Producción y Servicios (IEPS), únicamente realice su pago en Instituciones
                <br><br/>
                a) Si usted no cuenta con Banca Electrónica, le recomendamos utilizar la opción de "PAGO REFERENCIADO", el cuál le proporcionara
                una Línea de Captura con la cual usted podrá realizar su contribución en sucursales de BANORTE, BANCOMER, BANAMEX, SCOTIABANK,
                BANCO AZTECA, SANTANDER, HSBC Y TIENDAS OXXO.
                <br>
                b) La Línea de Captura generada por la opción PAGO REFERENCIADO tiene vigencia de 2 días hábiles, en su hoja de pago se refleja dicha
                fecha.
            </td>
        </tr>
        <tr>
            <td class="advertencias" colspan="2">
                Ante cualquier duda, favor de comunicarse al Centro
                de Atención Telefónica de la SPF al 01-800-3-10-40-
                10 donde con gusto le atenderemos de Lunes a
                Viernes en horario de 8 a 16 horas ó escríbanos al
                correo catspf@tabasco.gob.mx
            </td>
        </tr>
    </table>


</div>


</body>
</html>
