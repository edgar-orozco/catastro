<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>Sistema de Gestión Catastral</title>
        <link rel="icon" type="image/png" href="/css/images/main/favicon.png">
        <!-- CSS bootstrap -->
        {{ HTML::style('css/bootstrap.css') }}

        <!-- css general de la app -->
        {{ HTML::style('css/general.css') }}

        <!-- Navbar css custom menu -->
        {{ HTML::style('css/navmenu.css') }}
        {{ HTML::style('css/header.css') }}
        {{ HTML::style('css/footer.css') }}
        <!-- JQuery -->
        {{ HTML::script('js/jquery/jquery.min.js') }}

        <!-- JS Bootstrap -->
        {{ HTML::script('js/bootstrap.min.js') }}
        <style>
            /*            .panel{
                            max-width: 600px;
                        }*/
            .center {
                float: none;
                margin-left: auto;
                margin-right: auto;
            }
            /*            .panel-heading a {
                            background: #eee;
                            color: #808080;
                            font-weight: 300;
                            font-size: 18px;
                        }*/
            .panel-default:hover{
                background-color:gray;
                color:white;
            }
            .accordion
            {
                padding-left: 10px;
                padding-right: 10px;
            }

            .accordion-heading
            {
                background-color:#337ab7;
            }
            .accordion-heading:hover
            {
                background-color:#F27007;
                -webkit-transition: all 0.5s ease-in-out;
                -moz-transition: all 0.5s ease-in-out;
                -o-transition: all 0.5s ease-in-out;
                transition: all 0.5s ease-in-out;
            }
            .accordion-heading > a
            {
                color:#FFF;
                text-decoration:none;
                text-transform:uppercase;
            }
            h5
            {
                padding: 15px;
                font-size:12px;
            }
            .col-xs-6 col-sm-4
            {
                // padding-left: 40px;
            }
            .col2{   
                padding-left: 60px
            }
            .page-header
            {
                text-align: center;
            }

        </style>
    </head>
    <body>
        <header class="catatro-df">
            <div class="container">
                <div class="col-lg-8 col-md-8 col-sm-6">
                    <div class="img-cont">
                        <img src="../css/images/main/main-logo.png" alt="Catastro"/>
                    </div>
                    <div class="img-cont spf">
                        <img src="../css/images/main/logo-spf.png" alt="SPF"/>
                    </div>
                    <div class="img-cont catastro">
                        <img src="../css/images/main/logo-header.png" alt="Catastro">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <ul class="social">
                        <li><a href="https://www.facebook.com/gobiernodetabasco" target="_blank" class="facebook"></a></li>
                        <li><a href="https://twitter.com/Gobierno_Tab" target="_blank" class="twitter"></a></li>
                        <li><a href="https://www.flickr.com/photos/93709152@N04" target="_blank" class="plus"></a></li>
                        <li><a href="https://www.youtube.com/user/ArturoNunezTV" target="_blank" class="youtube"></a></li>
                    </ul>
                </div>
            </div>


        </header>
        <div class="page-header">
            <h3>
                Pago de Servicios Catastrales
            </h3>
            
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-4" style="margin-left: 240px;">
                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA024" target="_blank">
                            Aprobacion, registro de planos y otorgamiento de claves catastrales, por cada predio
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA045" target="_blank">
                            Archivos de ortofotos escala 1:1,000 cobertura 0.2km2
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA044" target="_blank">
                            Archivos de ortofotos escala 1:10,000 cobertura 20km2
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA006" target="_blank">
                            Certificacion de documentos catastrales
                        </a>
                    </p>
                </div>
                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA001" target="_blank">
                            Constancia de no propiedad
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA054" target="_blank">
                            Consulta de valor catastral de zona por calle
                        </a>
                    </p>
                </div>
                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA048" target="_blank">
                            Consultoria aplicada a sistemas de información geográfica (sig) 
                            <br>por hora y un máximo de 8 personas
                        </a>
                    </p>
                </div>
                <div >
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA049" target="_blank">
                            Coordinación de programas de actualización catastral por predio
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA017" target="_blank">
                            Copia de los planos cartograficos
                        </a>
                    </p>
                </div>

                <div >
                    <p>
                        <a class="btn btn-default"  href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA018" target="_blank">
                            Copia de los planos cartograficos tamaño carta (20x25 cms)
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a  class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA020" target="_blank">
                            Copia de los planos cartograficos tamaño lamina (60x90 cms)
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA019" target="_blank">
                            Copia de los planos cartograficos tamaño oficio (20x32 cms)
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA047" target="_blank">
                            Elaboracion de propuestas de zonificación y tablas de valores catastrales 
                            <br>de suelo y construcción por zona catastral
                        </a>
                    </p>
                </div>

                <div >
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA051" target="_blank">
                            Expedición anual de constancias que acredite su inscripción 
                            <br>como dibujante técnico en la secretaría de administración y finanzas
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA050" target="_blank">
                            Expedición anual de constancias que acredite su inscripción
                            <br>como perito valuador o perito topográfo en la secretaría de administración y finanzas
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA005" target="_blank">
                            Expedición de avaluos de propiedad raiz sobre el valor catastral
                        </a>
                    </p>
                </div>
                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA057" target="_blank">
                            Expedición de cada folio para realizar avalúo catastral: rústico y urbano
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default"  href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA056" target="_blank">
                            Expedición de cada folio para realizar avalúo comercial de predio rústico
                        </a>
                    </p>
                </div>
                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA055" target="_blank">
                            Expedición de cada folio para realizar avalúo comercial de predio urbano
                        </a>
                    </p>
                </div>

                <div >
                    <p>
                        <a class="btn btn-default"  href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA004" target="_blank">
                            Expedición de cada plano
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA003" target="_blank">
                            Expedición y certificacion del valor catastral de la propiedad raiz a peticion de parte
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA037" target="_blank">
                            Levantamiento topográfico (papel 60x80cm) predio urbano de 106 mt2 hasta 200 mt2
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA038" target="_blank">
                            Levantamiento topográfico (papel 60x80cm) predio urbano de 201 mt2 hasta 300 mt2
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA039" target="_blank">
                            Levantamiento topográfico (papel 60x80cm) predio urbano de 301 mt2 hasta 600 mt2
                        </a>
                    </p>
                </div>
                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA040" target="_blank">
                            Levantamiento topográfico (papel 60x80cm) predio urbano de 601 mt2 en adelante
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA036" target="_blank">
                            Levantamiento topográfico (papel 60x80cm) predio urbano hasta 105 mt2
                        </a>
                    </p>
                </div>

                <div>
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA029" target="_blank">
                            Levantamiento topográfico (papel 60x90cm) predio urbano de 106 mt2 hasta 200 mt2
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-xs-6 col-md-4">
                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA030" target="_blank">
                            Levantamiento topográfico (papel 60x90cm) predio urbano de 201 mt2 hasta 300 mt2
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA031" target="_blank">
                            Levantamiento topográfico (papel 60x90cm) predio urbano de 301 mt2 hasta 600 mt2
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA032" target="_blank">
                            Levantamiento topográfico (papel 60x90cm) predio urbano de 601 mt2 en adelante
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA032" target="_blank">
                            Levantamiento topográfico (papel 60x90cm) predio urbano hasta 105 mt2
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA021" target="_blank">
                            Planos manzaneros de 90 x 200 cms.
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA046" target="_blank">
                            Por cada punto terrestre georreferenciado en la cartografía
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA041" target="_blank">
                            Predios rústicos de 0 a 15 grados (papel 60x80cm)
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA033" target="_blank">
                            Predios rústicos de 0 a 15 grados (papel 60x90cm)
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA042" target="_blank">
                            Predios rústicos mayor a 15 grados y menor o igual a 45 grados (papel 60x80cm)
                        </a>
                    </p>
                </div>
                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA034" target="_blank">
                            Predios rústicos mayor a 15 grados y menor o igual a 45 grados (papel 60x90cm)
                        </a>
                    </p>
                </div>
                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA043" target="_blank">
                            Predios rústicos mayor a 45 grados (papel 60x80cm)
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA035" target="_blank">
                            Predios rústicos mayor a 45 grados (papel 60x90cm)
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA013" target="_blank">
                            Rectificación de medidas y colindancias de predio rústico de 1-00-00 ha.a 3-00-00 has.
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA016" target="_blank">
                            Rectificación de medidas y colindancias de predio rústico de 10-00-00 ha. En adelante
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA014" target="_blank">
                            Rectificación De Medidas Y Colindancias De Predio Rústico De 3-00-00 Ha.A 5-00-00 Has.
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA012" target="_blank">
                            Rectificación de medidas y colindancias de predio rústico hasta una hectarea
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default"  href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA008" target="_blank">
                            Rectificación de medidas y colindancias de predio urbano de 106 m2 hasta 200 m2
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA009" target="_blank">
                            Rectificación De Medidas Y Colindancias De Predio Urbano De 201 M2 Hasta 300 M2
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA010" target="_blank">
                            Rectificación de medidas y colindancias de predio urbano de 301 m2 hasta 600 m2
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default"  href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA011" target="_blank">
                            Rectificación de medidas y colindancias de predio urbano de 601 m2 en adelante
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA007" target="_blank">
                            Rectificación de medidas y colindancias de predio urbano lote tipo hasta 105 m2
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA053" target="_blank">
                            Revisión y validación de avaluo catastral a peritos registrados ante la secretaría de administración y finanzas
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA052" target="_blank">
                            Revisión y validación de avaluo comercial a peritos registrados ante la secretaría de administración y finanzas
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA027" target="_blank">
                            Trámites efectuados via modem consulta de información documental almacenada en disco compacto, por documento
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA026" target="_blank">
                            Trámites efectuados via modem el registro de escrituras
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA025" target="_blank">
                            Trámites efectuados via modem la expedición y certificación del valor catastral
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA023" target="_blank">
                            Verificacion de la poligonal del terreno de los predios rusticos en caso de fraccionamiento, por metro cuadrado
                        </a>
                    </p>
                </div>

                <div  class="col2">
                    <p>
                        <a class="btn btn-default" href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA022" target="_blank">
                            Verificacion de predio, planos de fraccionamientos urbanizados, por cada manzana a solicitud del interesado
                        </a>
                    </p>
                </div>

            </div>

        </div>
        <footer>
            <div class="container">
                <div class="col-md-4 col-lg-4 col-sm-4">
                    <h2>Gobierno de <b>Tabasco</b></h2>
                    <ul>
                        <li>
                            <a href="{{URL::to('users/login')}}">Portal Transparencia</a>
                        </li>
                        <li>
                            <a href="{{URL::to('users/login')}}">ITAIP</a>
                        </li>
                        <li>
                            <a href="{{URL::to('users/login')}}">Infomex</a>
                        </li>
                        <li>
                            <a href="{{URL::to('users/login')}}">Aviso de Privacidad</a>
                        </li>
                        <li>
                            <a href="{{URL::to('users/login')}}">Buzón</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4">
                    <h2>Dirección / <b>Ubicación</b></h2>
                    <p>
                        Independencia No. 2, Col. Centro Palacio, <br/>
                        de Gobierno, C.P. 86000 Villahermosa, <br/>
                        Tabasco, MX. <br/>
                        Tel. (993) 358 0400
                    </p>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4">
                    <h2>Contactanos / <b>Comenta</b></h2>

                    <form action="">
                        <input type="text" placeholder="Nombre"/>
                        <input type="text" placeholder="Email"/>
                        <input type="text" placeholder="Teléfono"/>
                        <textarea name="" id="" cols="30" rows="10" placeholder="Comentarios"></textarea>
                        <input type="submit" value="Enviar"/>
                    </form>
                </div>
            </div>
        </footer>
        <div class="footer legal container">
            <div class="col-sm-8 col-md-8 col-lg-8">
                <p><b>Gobierno del Estado de Tabasco © Derechos Reservados 2013 - 2018</b><br/>
                    Dirección General de Tecnologías de Información y Comunicaciones</p>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="img-cont">
                    <img src="css/images/main/main-logo.png" alt="Catastro"/>
                </div>
            </div>
        </div>
        <script src="js/jquery/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
