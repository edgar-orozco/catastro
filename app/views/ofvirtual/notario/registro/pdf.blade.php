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
        font-size: 9px;
        color: #000000;
        width: 100%;
        height: 97%;
    }

    #cabecera {
        height: 20%;
    }

    table {
        width: 100%;
        margin-bottom: 10px;
        border: 1px solid black;
    }

    td {
        padding: 4px;

    }

    th {
        border-bottom: 1px solid black;
    }

</style>
<body>

<div id="contenedor">
    <table width="100%" style="border: none !important">
        <tr>
            <td width="20%" align="center"><img src="css/images/main/main-logo.png"  height="70"></td>
            <td width="60%" align="center" class="title"><h2>Subsecretaría de Ingresos<br>
                    Dirección General de Catastro<br>
                    Y Ejecución Fiscal<br>
                    Dirección de Catastro</h2></td>
            <td width="20%" align="right"><img src="css/images/main/logo-spf.png" height="70"></td>
        </tr>
    </table>


    

    <table>
        
        <tr>
            <td align="right">
                 ____________, Tabasco a ___ de ___________ del 20___
            </td>
        </tr>
        <tr>
            <td align="right">
                Folio:   {{ $registro->folio}}
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th colspan="4">
                <hd>Contratantes</hd>
            </th>
        </tr>
        <tr>
            <td nowrap>Naturaleza del Contrato: compra/venta {{$registro->naturaleza_acto}}</td>
        </tr>
        <tr>
            {{--adquiriente --}}

            <td nowrap>
                Adquiriente: {{$registro->adquiriente->nombres}} {{$registro->adquiriente->apellido_paterno}}  {{$registro->adquiriente->apellido_materno}}
            </td>
            <td>
                CURP/RFC: {{$registro->adquiriente->curp}} {{$registro->adquiriente->rfc}}
            </td>{{--/adquiriente --}}
            </tr>
            <tr>
             <td nowrap>
                Domicilio:
            </td>
            </tr>

        </tr>
        {{--enajenante --}}
        <tr>

            <td>
                Enajenante: {{$registro->enajenante->nombres}} {{$registro->enajenante->apellido_paterno }} {{$registro->enajenante->apellido_materno }}
            </td>
            <td>
                CURP/RFC: {{$registro->enajenante->curp}} {{$registro->enajenante->rfc}}
            </td>
            </tr>
            <tr>
             <td nowrap>
                Domicilio:
            </td>
            </tr>
            <tr>
                <td >
                Fecha del Instrumento: 
            </td>
            <td>
               Fecha de la Firma: 
            </td>
            </tr>
            {{--/enajenante --}}
        </tr>
    </table>

    
      {{--Datos del notario --}}
    <table>
        <tr>
            <th colspan="3">
                <h4>Datos del noratio</h4>
            </th>
        </tr>
        <tr>
            <td>
                Tipo de escritura: {{$registro->tipo_escritura}}
            </td>
        </tr>
        <tr>
            <td nowrap>
                Nombre del Notario: {{$registro->notarioEscritura}}
            </td>
            <td nowrap>
                 No. de Notaria:{{$notaria->nombre}}
            </td>
        </tr>
        <tr>
            <td >
                Domicilio:{{$notaria->domicilio}}
            </td>
        </tr>

        <tr >
            <td nowrap>
                 No. Telefónico:{{$notaria->telefono}}
            </td>
            <td nowrap >
                E-mail:roman_madrigal88@hotmail.com{{$notaria->correo}}
            </td>
            <td nowrap>
               Volumen:asdf{{$registro->volumen}}
            </td>
        </tr>
    </table>

    {{--Datos del predio --}}
    <table>
        <tr>
            <th colspan="3">
                <h4>Datos del inmueble</h4>
            </th>
        </tr>
        <tr>
            <td nowrap>
                 Ubicacion: {{$predio->ubicacionFiscal->ubicacion}}
            </td>
        </tr>
        <tr>
            <td nowrap>
               Superficie terreno: {{$predio->superficie_terreno}} m2
            </td>
            <td nowrap>
                Superficie construcción: {{$predio->superficie_construccion}} m2
            </td>

        </tr>
        <tr>
            <td >
               Niveles: {{$registro->escritura_fecha}}
            </td>
            <td>
                Estado de conservación: {{$registro->escritura_fecha}}
            </td>
            <td>  </td>
        </tr>
    </table>

      <table  class="table">
        <tr>
            <th colspan="3">
                <h4>Colindancias</h4>
            </th>
        </tr>
                    <thead>
                    <tr>
                    <th><P align="center">Orientación:</p></th>
                    <th><P align="center">Superficie</p></th>
                    <th><P align="center">Colindancia</p></th>
                </tr>
            </thead>
                <?php 
                    $colindanciasArray=json_decode($JsonColindancias);
                   

                      foreach($colindanciasArray as $key => $value){ ?>
                      <tr>
                        <td>{{$value->orientacion}}</td>
                        <td>{{$value->superficie}}</td>
                        <td>{{$value->colindancia}}</td>
                    </tr>

                     <?php  } ?>
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
                Pasada ante la fe del notario: {{$registro->notarioEscritura}}
            </td>
        <tr>
            <td>
               No. de Notaria:{{$notaria->nombre}}
            </td>
            <td>
                Volumen:{{$registro->volumen_antecedente}}
            </td>
            <td>
                De fecha: {{$registro->fecha_antecedente}}
            </td>
        </tr>
        <tr>
            <td>
                Partida: {{$registro->partida_antecedente  }}
            </td>
            <td>
                Predio: {{$registro->predio_antecedente }}
            </td>
            <td>
                Folio: {{$registro->folio_real_antecedente  }}
            </td>
        </tr>
        <tr>
            <td>
                Volumen: {{$registro->volumen_freal_antecedente}}
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
                Valor comercial de inmueble: {{$registro->valor_comercial_antecedente }}
            </td>
            <td>
                Valuador con registro estatal: {{$registro->valuador_num_ant}}
            </td>
            <td>
                No de folio de avaluo: {{$registro->folio_avaluo_ant  }}
            </td>
        </tr>
    </table>
    {{--/antecedentes de la propiedad--}}

 <table>
                    <tr><th>Clave de Seguimiento</th></tr>
                    <tr>
                        <td align="center">
                            <img src=".{{$seguimiento}}">
                        </td>
                    </tr>
                    <tr><td align="center">
                            {{$registro->seguimiento}}
                        </td>
                    </tr>
                </table>




    


</div>


</body>
</html>
