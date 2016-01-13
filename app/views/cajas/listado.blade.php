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
                padding-left: 40px;
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

        <div class="row">
            <div class="col-xs-6 col-sm-4" style="margin-left: 240px;">
                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#one">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Aprobacion, registro de planos y otorgamiento de claves catastrales, por cada predio
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="one" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA024" target="_blank">
                                        Aprobacion, registro de planos y otorgamiento de claves catastrales, por cada predio
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#2">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Archivos de ortofotos escala 1:1,000 cobertura 0.2km2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="2" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA045" target="_blank">
                                        Archivos de ortofotos escala 1:1,000 cobertura 0.2km2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#3">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Archivos de ortofotos escala 1:10,000 cobertura 20km2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="3" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA044" target="_blank">
                                        Archivos de ortofotos escala 1:10,000 cobertura 20km2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#4">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Certificacion de documentos catastrales
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="4" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA006" target="_blank">
                                        Certificacion de documentos catastrales
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#5">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Constancia de no propiedad
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="5" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA001" target="_blank">
                                        Constancia de no propiedad
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#6">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Constancia de propiedad por predio
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="6" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA054" target="_blank">
                                        Consulta de valor catastral de zona por calle
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#7">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    CONSULTA DE VALOR CATASTRAL DE ZONA POR CALLE
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="7" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA054" target="_blank">
                                        CONSULTA DE VALOR CATASTRAL DE ZONA POR CALLE
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#8">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Consultoria aplicada a sistemas de información geográfica (sig) por hora y un máximo de 8 personas
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="8" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA048" target="_blank">
                                        Consultoria aplicada a sistemas de información geográfica (sig) por hora y un máximo de 8 personas
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#9">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Coordinación de programas de actualización catastral por predio
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="9" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA049" target="_blank">
                                        Coordinación de programas de actualización catastral por predio
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#10">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Copia de los planos cartograficos
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="10" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA017" target="_blank">
                                        Copia de los planos cartograficos
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#11">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Copia de los planos cartograficos; tamaño carta (20x25 cms)
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="11" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA018" target="_blank">
                                        Copia de los planos cartograficos; tamaño carta (20x25 cms)
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#12">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Copia de los planos cartograficos; tamaño lamina (60x90 cms)
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="12" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA020" target="_blank">
                                        Copia de los planos cartograficos; tamaño lamina (60x90 cms)
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#13">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Copia de los planos cartograficos; tamaño oficio (20x32 cms)
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="13" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA019" target="_blank">
                                        Copia de los planos cartograficos; tamaño oficio (20x32 cms)
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#14">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Elaboracion de propuestas de zonificación y tablas de valores catastrales de suelo y construcción por zona catastral
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="14" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA047" target="_blank">
                                        Elaboracion de propuestas de zonificación y tablas de valores catastrales de suelo y construcción por zona catastral
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#15">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Expedición anual de constancias que acredite su inscripción como dibujante técnico en la secretaría de administración y finanzas
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="15" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA051" target="_blank">
                                        Expedición anual de constancias que acredite su inscripción como dibujante técnico en la secretaría de administración y finanzas
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#16">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Expedición anual de constancias que acredite su inscripción como perito valuador o perito topográfo en la secretaría de administración y finanzas
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="16" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA050" target="_blank">
                                        Expedición anual de constancias que acredite su inscripción como perito valuador o perito topográfo en la secretaría de administración y finanzas
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#17">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Expedición de avaluos de propiedad raiz sobre el valor catastral
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="17" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA005" target="_blank">
                                        Expedición de avaluos de propiedad raiz sobre el valor catastral
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#18">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Expedición de cada folio para realizar avalúo catastral: rústico y urbano
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="18" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA057" target="_blank">
                                        Expedición de cada folio para realizar avalúo catastral: rústico y urbano
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#19">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Expedición de cada folio para realizar avalúo comercial de predio rústico
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="19" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA056" target="_blank">
                                        Expedición de cada folio para realizar avalúo comercial de predio rústico
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#20">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Expedición de cada folio para realizar avalúo comercial de predio urbano
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="20" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA055" target="_blank">
                                        Expedición de cada folio para realizar avalúo comercial de predio urbano
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#21">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Expedición de cada plano
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="21" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA004" target="_blank">
                                        Expedición de cada plano
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#22">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Expedición y certificacion del valor catastral de la propiedad raiz a peticion de parte
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="22" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA003" target="_blank">
                                        Expedición y certificacion del valor catastral de la propiedad raiz a peticion de parte
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#23">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Levantamiento topográfico (papel 60x80cm) predio urbano de 106 mt2 hasta 200 mt2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="23" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA037" target="_blank">
                                        Levantamiento topográfico (papel 60x80cm) predio urbano de 106 mt2 hasta 200 mt2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#24">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Levantamiento topográfico (papel 60x80cm) predio urbano de 201 mt2 hasta 300 mt2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="24" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA038" target="_blank">
                                        Levantamiento topográfico (papel 60x80cm) predio urbano de 201 mt2 hasta 300 mt2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!--                <div class="accordion" id="accordionid">
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#25">
                
                                                <h5>
                                                    <i class="glyphicon glyphicon-bookmark"></i>
                                                    Levantamiento topográfico (papel 60x80cm) predio urbano de 201 mt2 hasta 300 mt2
                                                    <b class="caret"></b>
                                                </h5>
                
                                            </a>
                                        </div>
                                        <div id="25" class="collapse">
                                            <div class="accordion-inner">
                                                <p>
                                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA038" target="_blank">
                                                        Levantamiento topográfico (papel 60x80cm) predio urbano de 201 mt2 hasta 300 mt2
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#26">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Levantamiento topográfico (papel 60x80cm) predio urbano de 301 mt2 hasta 600 mt2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="26" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA039" target="_blank">
                                        Levantamiento topográfico (papel 60x80cm) predio urbano de 301 mt2 hasta 600 mt2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#27">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Levantamiento topográfico (papel 60x80cm) predio urbano de 601 mt2 en adelante
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="27" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA040" target="_blank">
                                        Levantamiento topográfico (papel 60x80cm) predio urbano de 601 mt2 en adelante
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#28">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Levantamiento topográfico (papel 60x80cm) predio urbano hasta 105 mt2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="28" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA036" target="_blank">
                                        Levantamiento topográfico (papel 60x80cm) predio urbano hasta 105 mt2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#29">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Levantamiento topográfico (papel 60x90cm) predio urbano de 106 mt2 hasta 200 mt2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="29" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA029" target="_blank">
                                        Levantamiento topográfico (papel 60x90cm) predio urbano de 106 mt2 hasta 200 mt2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>



            </div>    
            <div class="col-xs-6 col-md-4">
                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#30">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Levantamiento topográfico (papel 60x90cm) predio urbano de 201 mt2 hasta 300 mt2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="30" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA030" target="_blank">
                                        Levantamiento topográfico (papel 60x90cm) predio urbano de 201 mt2 hasta 300 mt2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#31">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Levantamiento topográfico (papel 60x90cm) predio urbano de 301 mt2 hasta 600 mt2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="31" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA031" target="_blank">
                                        Levantamiento topográfico (papel 60x90cm) predio urbano de 301 mt2 hasta 600 mt2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#32">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Levantamiento topográfico (papel 60x90cm) predio urbano de 601 mt2 en adelante
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="32" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA032" target="_blank">
                                        Levantamiento topográfico (papel 60x90cm) predio urbano de 601 mt2 en adelante
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#33">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Levantamiento topográfico (papel 60x90cm) predio urbano hasta 105 mt2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="33" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA032" target="_blank">
                                        Levantamiento topográfico (papel 60x90cm) predio urbano hasta 105 mt2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#34">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Planos manzaneros de 90 x 200 cms.
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="34" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA021" target="_blank">
                                        Planos manzaneros de 90 x 200 cms.
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#35">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Por cada punto terrestre georreferenciado en la cartografía
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="35" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA046" target="_blank">
                                        Por cada punto terrestre georreferenciado en la cartografía
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#36">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Predios rústicos de 0 a 15 grados (papel 60x80cm)
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="36" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA041" target="_blank">
                                        Predios rústicos de 0 a 15 grados (papel 60x80cm)
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#37">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Predios rústicos de 0 a 15 grados (papel 60x90cm)
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="37" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA033" target="_blank">
                                        Predios rústicos de 0 a 15 grados (papel 60x90cm)
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#38">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Predios rústicos mayor a 15 grados y menor o igual a 45 grados (papel 60x80cm)
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="38" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA042" target="_blank">
                                        Predios rústicos mayor a 15 grados y menor o igual a 45 grados (papel 60x80cm)
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#39">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Predios rústicos mayor a 15 grados y menor o igual a 45 grados (papel 60x90cm)
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="39" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA034" target="_blank">
                                        Predios rústicos mayor a 15 grados y menor o igual a 45 grados (papel 60x90cm)
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#40">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Predios rústicos mayor a 45 grados (papel 60x80cm)
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="40" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA043" target="_blank">
                                        Predios rústicos mayor a 45 grados (papel 60x80cm)
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#41">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Predios rústicos mayor a 45 grados (papel 60x90cm)
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="41" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA035" target="_blank">
                                        Predios rústicos mayor a 45 grados (papel 60x90cm)
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#42">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Rectificación de medidas y colindancias de predio rústico de 1-00-00 ha.a 3-00-00 has.
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="42" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA013" target="_blank">
                                        Rectificación de medidas y colindancias de predio rústico de 1-00-00 ha.a 3-00-00 has.
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#43">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Rectificación de medidas y colindancias de predio rústico de 10-00-00 ha. En adelante
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="43" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA016" target="_blank">
                                        Rectificación de medidas y colindancias de predio rústico de 10-00-00 ha. En adelante
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#44">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    RECTIFICACIÓN DE MEDIDAS Y COLINDANCIAS DE PREDIO RÚSTICO DE 3-00-00 HA.A 5-00-00 HAS.
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="44" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA014" target="_blank">
                                        Rectificación De Medidas Y Colindancias De Predio Rústico De 3-00-00 Ha.A 5-00-00 Has.
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#45">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Rectificación de medidas y colindancias de predio rústico hasta una hectarea
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="45" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA012" target="_blank">
                                        Rectificación de medidas y colindancias de predio rústico hasta una hectarea
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#46">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Rectificación de medidas y colindancias de predio urbano de 106 m2 hasta 200 m2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="46" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA008" target="_blank">
                                        Rectificación de medidas y colindancias de predio urbano de 106 m2 hasta 200 m2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#47">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    RECTIFICACIÓN DE MEDIDAS Y COLINDANCIAS DE PREDIO URBANO DE 201 M2 HASTA 300 M2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="47" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA009" target="_blank">
                                        Rectificación De Medidas Y Colindancias De Predio Urbano De 201 M2 Hasta 300 M2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#48">

                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Rectificación de medidas y colindancias de predio urbano de 301 m2 hasta 600 m2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="48" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA010" target="_blank">
                                        Rectificación de medidas y colindancias de predio urbano de 301 m2 hasta 600 m2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#49">
                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Rectificación de medidas y colindancias de predio urbano de 601 m2 en adelante
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="49" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA011" target="_blank">
                                        Rectificación de medidas y colindancias de predio urbano de 601 m2 en adelante
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#50">
                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Rectificación de medidas y colindancias de predio urbano lote tipo hasta 105 m2
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="50" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA007" target="_blank">
                                        Rectificación de medidas y colindancias de predio urbano lote tipo hasta 105 m2
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#51">
                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Revisión y validación de avaluo catastral a peritos registrados ante la secretaría de administración y finanzas
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="51" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA053" target="_blank">
                                        Revisión y validación de avaluo catastral a peritos registrados ante la secretaría de administración y finanzas
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#52">
                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Revisión y validación de avaluo comercial a peritos registrados ante la secretaría de administración y finanzas
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="52" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA052" target="_blank">
                                        Revisión y validación de avaluo comercial a peritos registrados ante la secretaría de administración y finanzas
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#53">
                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Trámites efectuados via modem consulta de información documental almacenada en disco compacto, por documento
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="53" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA027" target="_blank">
                                        Trámites efectuados via modem consulta de información documental almacenada en disco compacto, por documento
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#54">
                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Trámites efectuados via modem el registro de escrituras
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="54" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA026" target="_blank">
                                        Trámites efectuados via modem el registro de escrituras
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#55">
                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Trámites efectuados via modem la expedición y certificación del valor catastral
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="55" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA025" target="_blank">
                                        Trámites efectuados via modem la expedición y certificación del valor catastral
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#56">
                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Verificacion de la poligonal del terreno de los predios rusticos en caso de fraccionamiento, por metro cuadrado
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="56" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA023" target="_blank">
                                        Verificacion de la poligonal del terreno de los predios rusticos en caso de fraccionamiento, por metro cuadrado
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionid">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="#57">
                                <h5>
                                    <i class="glyphicon glyphicon-bookmark"></i>
                                    Verificacion de predio, planos de fraccionamientos urbanizados, por cada manzana a solicitud del interesado
                                    <b class="caret"></b>
                                </h5>

                            </a>
                        </div>
                        <div id="57" class="collapse">
                            <div class="accordion-inner">
                                <p>
                                    <a href="https://recaudanet.tabasco.gob.mx/derechosCobro.jsp?capturaNuevo=S&mod=CA&derecho=CA022" target="_blank">
                                        Verificacion de predio, planos de fraccionamientos urbanizados, por cada manzana a solicitud del interesado
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
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
