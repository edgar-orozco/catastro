<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<style>
#contenedor{  
        //background-color:#F4ABF2;
        background-image: url("css/images/main/logo-header.png-agua.png");
        background-repeat: no-repeat;
        background-position: center;
        //border:2px solid #000000; 
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: #0000000;
        width: 100%;
        height: 97%;
}  
#cabecera{  
        //background-color:#E5BC7A;  
        height:20%;  
}  
#menu{  
        height:10%;  
        //background-color:#C8CACC;  
}  
#centro{  
        height:25%;  
        //background-color:#BDD2EF; 
        border: 2px solid #000000;
        margin: 5px;
        width:100%;
}
#centro2{  
        height:10%;  
        //background-color:#BDD2EF; 
        //border: 2px solid #000000;
        margin: 5px;
        width:100%;
}
#centro3{
        height:4%;  
        //background-color:#BDD2EF; 
        //border: 2px solid #000000;
        margin: 5px;
        width:100%;
}
#dentro{
    height: 4%;
    //background-color: #FFFF99;
    margin: 5px;
    width: 100%;
    /*tipo de letra*/
    font-family: 'Arial Black', Gadget, sans-serif;
    text-align: center;
    font-size: 16px;
    color: #0000000; 
}
#izquierda{  
        height:26%;
        //background-color:blanchedalmond;
        display:inline-block;
        float:left;  
        width:50%; 
        margin: 2px;
}  
#derecha{  
        height:26%;  
        //background-color:burlywood;
        display:inline-block;
        float:right;  
        width:48.3%;
        margin: 2px;
}  

#pie{  
        height:10%;  
        //background-color:#D3D1C1;  
        clear:both;
        margin: 4px;
}
.title{
        font-family: 'Arial Black', Gadget, sans-serif;
        text-align: center;
        font-size: 13px;
        color: #0000000; 
}
</style>
<body>
    <div id="contenedor">
        <table width="100%">
            <tr>
                <td width="20%" align="right"><img src="css/images/main/main-logo.png"  height="70"></td>
                <td width="60%" align="center" class="title"><strong>SERVICIOS CATASTRALES</strong></td>
                <td width="20%" align="center"></td>
            </tr>
        </table>    
        <table class="table" rules="all">
        <thead>
            <tr>
                <th>Nombre del trámite</th>
                <th>Duración aprox.</th>
                <th>Costo</th>
                <th>Requisitos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tipotramites as $tipotramite)
            <tr>
                <td align="center">
                   <strong>{{$tipotramite->nombre}}</strong>
                </td>
                <td align="center">
                    {{$tipotramite->tiempo}}
                </td>
                <td align="center">
                    ${{money_format("%i",$tipotramite->costoPesos())}}
                </td>
                <td>
                    <ul>
                        @foreach($tipotramite->requisitos as $requisito )
                           <strong> <li>{{$requisito->nombre}} {{$requisito->pivot->original ? 'original' : ''}} {{$requisito->pivot->original &&  $requisito->pivot->copias ? ' y ' : ''}}  {{$requisito->pivot->copias ? $requisito->pivot->copias. " ".Lang::choice('messages.copias', $requisito->pivot->copias ) : ''}} {{$requisito->pivot->certificadas ? Lang::choice('messages.certificadas', $requisito->pivot->copias) : ''}}  </li> </strong>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>
