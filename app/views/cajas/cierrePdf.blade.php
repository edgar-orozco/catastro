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
        background-image: url("css/images/main/logo-header.png-agua.png");
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

        /*margin-bottom: 15px;*/
        border: 1px solid black;
    }

     table.container2 {
        width: 40%;
        border: 1px solid black;
        margin-bottom: 15px;
        margin-top: 15px;
    }

    td {
        font-size: 11px;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        color: #000000;
        padding: 3px;
    }
    .nombre{
        font-size: 14px;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        color: #000000;
        padding: 3px;
    }

    table.container td {
        font-size: 12px;
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

    table.container2 td {
        font-size: 15px;
        font-family: Verdana, Arial, Helvetica, sans-serif;

        color: #000000;
        padding: 3px;
    }

    table.container2 th {
        font-size: 13px;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        color: #000000;
        text-align: left;

        height: 3px;
    }

    td.advertencias{
        font-size: 11px;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        color: #000000;
        padding: 3px;
    }
    td.title{
        font-size: 15px;
        font-family: Verdana, Arial, Helvetica, sans-serif;

        color: #000000;
        padding: 3px;
    }
</style>
<body>

<div id="contenedor">

    <table class="container" width="100%" style="border: none !important">
        <tr>
            <td width="20%" align="center"><img src="css/images/main/main-logo.png"  height="70"></td>
            <td width="60%" align="center" class="title"><h4>Subsecretaría de Ingresos<br>
                    Dirección General de Catastro<br>
                    Y Ejecución Fiscal<br>
                    Dirección de Catastro</h4></td>
            <td width="20%" align="right"><img src="css/images/main/logo-spf.png" height="70"></td>
        </tr>
    </table>

    <table class="container2" >
      <tr>
        <th width="45%" >Usuario:</th>
        <td >Delta</td>
      </tr>
      <tr>
        <th width="45%" >No. Caja:</th>
        <td >10</td>
      </tr>
      <tr>
        <th width="45%" >No. Corte de Caja:</th>
        <td >002</td>
      </tr>
      <tr>
        <th width="45%" >Fecha:</th>
        <td >{{date('d/m/y')}}</td>
      </tr>
    </table>

    <br>
    <div class="nombre">Usuario: Delta</div>
    <div class="nombre">No. Caja: 10</div>
    <br>
    <br>
    <table class="container" width="100%" border="1" >

        <tr>
            <th align="center">ID</td>
            <th align="center">NOMBRE</td>
            <th align="center">MUNICIPIO</td>
            <th align="center">STATUS</td>
            <th align="center">MONTO</td>
        </tr>
      @foreach($ordenes as $orden)
        <tr>
            <td align="center">{{$orden['id']}}</td>
            <td align="left">{{$orden['nombre']}} </td>
            <td align="center">{{$orden['municipio']}} </td>
            <td align="center">
            <img src="{{$orden['status']==='1'?'css/check.png':'css/remove.png'}}" alt="" height=10 width=10></img>
            </td>
            <td align="right">{{number_format( $orden['monto'], 2,'.',',') }} </td>

        </tr>
      @endforeach
    </table>
      <table align="left"  width="100%">
        <tr>
          <td align="right" >TOTAL</td>
          <td align="right">$ {{ number_format( 755, 2,'.',',') }}</td>
        </tr>
        <tr>
          <td align="right" >MONTO INICIAL</td>
          <td align="right">$ {{ number_format( 10, 2,'.',',') }}</td>
        </tr>
        <tr>
          <td align="right">DIFERENCIA</td>
          <td align="right">$ {{ number_format( 745, 2,'.',',') }}</td>
        </tr>
    </table>



    


</div>


</body>
</html>
