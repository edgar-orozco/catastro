<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>
{{--HTML::style('css/forms.css')--}}
<style>

    #contenedor {
        /*background-image: url("css/images/main/logo-header.png-agua.png");*/
        background-repeat: no-repeat;
        background-position: center;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: #000000;
        width: 100%;
        height: 97%;
    }

    #cabecera {
        height: 20%;
    }

    table {
        width: 100%;
        margin-bottom: 30px;
        border: 1px solid black;
    }

    td {
        padding: 8px;
    }

    th {
        border-bottom: 1px solid black;
    }

</style>
<body>

<div id="contenedor">
    <table width="100%">
        <tr>
            <td width="20%" align="right"><img src="css/images/main/main-logo.png" height="70"></td>
            <td width="60%" align="center" class="title"><strong>SERVICIOS CATASTRALES</strong></td>
            <td width="20%" align="center"></td>
        </tr>
    </table>


    <h1>Traslado de dominios</h1>

    <p>Con fundamento en los articulos 78, 108, 109, 110, 111, 112,113, 114 Y Art 5to Transitorio de la Ley
        de
        Hacienda
        Municipal del Estado de Tabasco en Vigor; me permito enterar el pago de Impuesto sobre el Traslado
        de
        Dominio de
        Bienes Inmuebles, mediante la siguiente Declaracion presentada en duplicado.</p>
    <br>


    <table>
        <tr>
            <td>
                Lugar:   {{ $traslado->lugar}}
            </td>
            <td>
                Fecha:{{ $traslado->fecha}}
            </td>
            <td>
                Declaración: {{$traslado->declaracion}}
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th colspan="4">
                <h3>Contratantes</h3>
            </th>
        </tr>
        <tr>
            {{--adquiriente --}}
            <td>
                <strong> Adquiriente(s) </strong>
            </td>
            <td>
                Tipo de persona: {{$traslado->adquiriente->tipo->nombre}}
            </td>
            <td nowrap>
                Nombre: {{$traslado->adquiriente->nombres}} {{$traslado->adquiriente->apellido_paterno}}  {{$traslado->adquiriente->apellido_materno}}
            </td>
            <td>
                CURP/RFC: {{$traslado->adquiriente->curp}} {{$traslado->adquiriente->rfc}}
            </td>{{--/adquiriente --}}
        </tr>
        {{--enajenante --}}
        <tr>
            <td>
                <strong> Enajenante(s) </strong>
            <td>
                Tipo de persona: {{$traslado->enajenante->tipo->nombre}}
            </td>
            <td>
                Nombre: {{$traslado->enajenante->nombres}} {{$traslado->enajenante->apellido_paterno }} {{$traslado->enajenante->apellido_materno }}
            </td>
            <td>
                CURP/RFC: {{$traslado->enajenante->curp}} {{$traslado->enajenante->rfc}}
            </td>
            {{--/enajenante --}}
        </tr>
    </table>



    {{--Datos del predio --}}
    <table>
        <tr>
            <th colspan="3">
                <h3>Datos del bien inmueble</h3>
            </th>
        </tr>
        <tr>
            <td>
                Tipo de escritura: {{$traslado->tipo_escritura}}
            </td>
        </tr>
        <tr>
            <td>
                N°. De escritura: {{$traslado->escritura_registro}}
            </td>
            <td>
                Volumen: {{$traslado->escritura_volumen }}
            </td>
            <td>
                De fecha: {{$traslado->escritura_fecha}}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Pasada ante la fe del notario: {{$traslado->notarioEscritura}}
            </td>
            <td>
                Notaría pública: {{$traslado->notariaEscritura}}
            </td>
        </tr>

        <tr>
            <td colspan="3">
                Naturaleza del Contrato: {{$traslado->naturaleza_contrato}}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                Ubicacion: {{$predio->ubicacionFiscal->ubicacion}}
            </td>
        </tr>
        <tr>
            <td>
                Superficie terreno: {{$predio->superficie_terreno}} m2
            </td>
            <td>
                Superficie construcción: {{$predio->superficie_construccion}} m2

            <td></td>
        </tr>
    </table>
    {{--/datos de la propiedad--}}

    {{--antecedentes de la propiedad--}}
    <table>
        <tr>
            <th colspan="3">
                <h3>Antecedentes de la propiedad</h3>
            </th>
        </tr>
        <tr>
            <td colspan="3">
                Pasada ante la fe del notario: {{$traslado->notario_antecedente_id}}
            </td>
        <tr>
            <td>
                N° de escritura: {{$traslado->num_antecedente}}
            </td>
            <td>
                Volumen:{{$traslado->volumen_antecedente}}
            </td>
            <td>
                De fecha: {{$traslado->fecha_antecedente}}
            </td>
        </tr>
        <tr>
            <td>
                Partida: {{$traslado->partida_antecedente  }}
            </td>
            <td>
                Predio: {{$traslado->predio_antecedente }}
            </td>
            <td>
                Folio: {{$traslado->folio_real_antecedente  }}
            </td>
        </tr>
        <tr>
            <td>
                Volumen: {{$traslado->volumen_freal_antecedente}}
            </td>
            <td>
                No. de cuenta predial: {{$predio->cuenta}}
            </td>
            <td>
                Regimen: {{$predio->tipo_predio}}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                Clave catastral: {{$predio->clave}}
            </td>
        </tr>
        <tr>
            <td>
                Valor comercial de inmueble: {{$traslado->valor_comercial_antecedentre }}
            </td>
            <td>
                Valuador con registro estatal: {{$traslado->valuador_num_ant}}
            </td>
            <td>
                No de folio de avaluo: {{$traslado->folio_avaluo_ant  }}
            </td>
        </tr>
    </table>
    {{--/antecedentes de la propiedad--}}



    <table>
        <tr>
            <td>
                <table>
                    <tr>
                        <th colspan="2">
                            <h3>Liquidación vivienda</h3>
                        </th>
                    <tr>
                        <td>
                            Tipo Vivienda:
                        </td>
                        <td>$ {{$traslado->tipo_vivienda}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Precio base:
                        </td>
                        <td>$ {{$traslado->precio_base}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Deducción:
                        </td>
                        <td>$ {{$traslado->deduccion}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Base gravable por la que pagaron:
                        </td>
                        <td>$ {{$traslado->base_gravable}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Diferencia omitida:
                        </td>
                        <td>$ {{$traslado->diferencia_omitida}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Porcentaje aplicarse:
                        </td>
                        <td>$ {{$traslado->porcentaje_aplicarse}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Impuesto enterar:
                        </td>
                        <td>$ {{$traslado->impuesto_enterar}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Actualización:
                        </td>
                        <td>$ {{$traslado->actualizacion}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Recargos:
                        </td>
                        <td>$ {{$traslado->recargos}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Importe total:
                        </td>
                        <td>$ {{$traslado->importe_total}}
                        </td>
                    </tr>

                </table>


            </td>
            <td valign="top">

                <table>
                    <tr>
                        <th colspan="2">
                            <h3>Valores para base de pago</h3>
                        </th>
                    <tr>
                        <td>
                            Valor catastral:
                        </td>
                        <td>$ {{ $traslado->valor_catastral}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Valor de operación:
                        </td>
                        <td>$ {{ $traslado->valor_operacion}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Valor comercial del
                        </td>
                        <td> $ {{ $traslado->valor_comercial }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Valuador num:
                        </td>
                        <td>{{ $traslado->valuador_num}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            N° de folio de avaluo:
                        </td>
                        <td> {{ $traslado->folio_avaluo}}
                        </td>
                    </tr>
                </table>
            </td>

        </tr>

    </table>


    <table>
        <tr>
            <td align="center">
                Se declara bajo protesta de decir verdad, que los datos que se proporcionan en<br>
                Firma de los compradores o Fedatario Publico<br>
                esta declaracion se apegan a la realidad.

                <br><br><br><br><br>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td align="center">
                <img src=".{{$seguimiento}}">
                <br>
                {{$traslado->seguimiento}}
            </td>
        </tr>
    </table>


</div>


</body>
</html>