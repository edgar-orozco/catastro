<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recibo</title>
</head>
<style type="text/css">
#contenedor{  
/*      background-color:#F4ABF2;*/
        border:2px solid #000;
        background-image: url("/css/images/main/logo-header.png-agua.png");
        background-repeat: no-repeat;
        background-position: 50% 50%;
        width: 100%;
        height: 40%; 
        margin: 10px; 
}  
#cabecera{  
        /*background-color:#E5BC7A;  */
        height:15%;
        //display:inline-block;
        font-family: Arial, Helvetica, sans-serif;
        
} 
#izquierda{  
        height:15%;  
        //background-color:#BDD2EF; 
        display:inline-block;
        margin-left: 5px;
        float:left;  
        width:50%;  
}  
#derecha{  
        height:15%;  
        //background-color:#DAF7E2;
        display:inline-block;
        float:right;  
        width:50%;  
}  
#pie{  
        height:5%;  
        /*background-color:#D3D1C1;  */
        clear:both;  
}
</style>
<body>
@foreach($tramites as $row)
<div id="contenedor">
    <div id="cabecera">
        <table width="100%" border="0">
            <tr>
              <td align="right"><img src="/css/images/main/main-logo.png"  height="70"></td>
              <td align="center">DIRECCIÓN DE FINANZA MUNICIPALES<br />SUBDIRECCIÓN DE CATASTRO<br/><br/>CONTROL DE RECEPCION DE DOCUMENTOS</td>
                <td>
                    @if($logo)
                        <img src="/css/images/home/logos/{{$logo}}"  height="100">
                    @endif
                </td>
            </tr>
            <tr>
              <td>Fecha ingreso: <?php $fecha=strtotime($row->created_at); echo date("d/m/Y",$fecha) ?></td>
              <td align="center"><strong>{{strtoupper($row->tramite)}}</strong></td>
              <td>FOLIO: <strong>{{$row->anio}}/{{$row->municipio}}/{{sprintf("%06d",$row->folio)}}</strong><br/>Copia solicitante</td>
            </tr>  
        </table>
    </div>
    <div id="izquierda">
      <p>
        Nombre del solicitante:<br/>
        {{$row->nombres}} {{$row->apellido_paterno}} {{$row->apellido_materno}}
      </p>
      @if(!empty($notaria))
        @foreach($notaria as $ro)
      <p>
        Nombre de la notaría:<br/>
        {{$ro->notaria}}
      </p>
        @endforeach
      @endif
      <p>
        Nombre del propietario:<br/>
        {{$row->nombre}} {{$row->paterno}} {{$row->materno}}
      </p>
      <p>
        Cuenta catastral:<br/>
        {{$row->cuenta}}
      </p>
      <p>
        Tiempo estimado: {{$row->tiempo}} días hábiles 
      </p>
    </div>
    <div id="derecha">
    </div>
    <div id="pie"></div>
</div>
<!---->
<div id="contenedor">
    <div id="cabecera">
        <table width="100%" border="0">
            <tr>
              <td align="right"><img src="/css/images/main/main-logo.png"  height="70"></td>
              <td align="center">DIRECCIÓN DE FINANZA MUNICIPALES<br />SUBDIRECCIÓN DE CATASTRO<br/><br/>CONTROL DE RECEPCION DE DOCUMENTOS</td>
                <td>
                    @if($logo)
                        <img src="/css/images/home/logos/{{$logo}}"  height="100">
                    @endif
                </td>
            </tr>
            <tr>
              <td>Fecha ingreso: <?php $fecha=strtotime($row->created_at); echo date("d/m/Y",$fecha) ?></td>
              <td align="center"><strong>{{strtoupper($row->tramite)}}</strong></td>
              <td>FOLIO: <strong>{{$row->anio}}/{{$row->municipio}}/{{sprintf("%06d",$row->folio)}}</strong><br/>Copia municipio</td>
            </tr>
        </table>
    </div>
    <div id="izquierda">
      <br/><br/><br/>
      <p>
        Nombre del solicitante:<br/>
        {{$row->nombres}} {{$row->apellido_paterno}} {{$row->apellido_materno}}
      </p>
      @if(!empty($notaria))
        @foreach($notaria as $ro)
      <p>
        Nombre de la notaría:<br/>
        {{$ro->notaria}}
      </p>
        @endforeach
      @endif
      <p>
        Nombre del propietario:<br/>
        {{$row->nombre}} {{$row->paterno}} {{$row->materno}}
      </p>
      <p>
        Cuenta catastral:<br/>
        {{$row->cuenta}}
      </p>
      <p>
        Tiempo estimado: {{$row->tiempo}} días hábiles 
      </p>
    </div>
    <div id="derecha">
    </div>
    <div id="pie"></div>
</div>
@endforeach
</body>  
</html>