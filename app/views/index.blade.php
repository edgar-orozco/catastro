<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Sistema de Gestión Catastral</title>
    <link rel="icon" type="image/png" href="css/images/main/favicon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/home.css"/>
    <link rel="stylesheet" href="css/footer.css"/>
</head>
<body>
<header class="catatro-df">
    <div class="container">
        <div class="col-lg-8 col-md-8 col-sm-6">
            <div class="img-cont">
                <img src="css/images/main/main-logo.png" alt="Catastro"/>
            </div>
            <div class="img-cont spf">
                <img src="css/images/main/logo-spf.png" alt="SPF"/>
            </div>
            <div class="img-cont catastro">
                <img src="css/images/main/logo-header.png" alt="Catastro">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <ul class="social">
                <li><a href="{{URL::to('users/login')}}" class="facebook"></a></li>
                <li><a href="{{URL::to('users/login')}}" class="twitter"></a></li>
                <li><a href="{{URL::to('users/login')}}" class="plus"></a></li>
                <li><a href="{{URL::to('users/login')}}" class="youtube"></a></li>
            </ul>
        </div>
    </div>


</header>
<div class="main-container container">
    <div class="row options-cont">
        <div class="col-sm-6 col-md-4 col-lg-4">
            <a href="{{URL::to('users/login')}}" class="main-option op01">
                <img src="css/images/home/opc01.jpg" alt="SERVICIOS CATASTRALES"/>
                <div class="desc">
                    SERVICIOS CATASTRALES
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
            <a href="{{URL::to('users/login')}}" class="main-option op02">
                <img src="css/images/home/opc02.jpg" alt="CONSULTAR PAGOS Y ADEUDOS DEL IMPUESTO PREDIAL"/>
                <div class="desc">
                    CONSULTAR PAGOS Y ADEUDOS DEL IMPUESTO PREDIAL
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
            <a href="{{URL::to('users/login')}}" class="main-option op03">
                <img src="css/images/home/opc03.jpg" alt="TRÁMITES CATASTRALES"/>
                <div class="desc">
                    TRÁMITES CATASTRALES
                </div>
            </a>
        </div>
    </div>
    <h1>SELECCIONA TU MUNICIPIO</h1>
</div>
<div class="select-municipio">
    <div class="main-container container">
        <div class="row">
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/Balancan.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/Cardenas.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/Centla.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/Centro.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/Comalcalco.png" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/LogoCunduacan.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/LogoEZapata.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/LogoHuimanguillo.png" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/Jalapa.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/jalapademendez.png" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/LogoJonuta.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/LogoMacuspana.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/LogoNacajuca.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/logoparaiso.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/LogoTacotalpa.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/LogoTeapa.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
                <a href="{{URL::to('users/login')}}">
                    <img src="css/images/home/logos/LogoTenosique.jpg" alt="SELECCIONA TU MUNICIPIO"/>
                </a>
            </div>
            <div class="col-sm-6 col-md-2 col-lg-2">
            </div>
        </div>
    </div>
</div>
<div class="main-container container">
    <div class="row">
        <div class="col-sm-6 col-md-8 col-lg-8">
            <img src="css/images/home/logo-catastro.jpg" style="width: 415px; margin: 0 auto; display: block;" alt="Logotipo Catastro"/>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="banner">
                <img src="css/images/home/secrt.png" alt="Secretaria de planeacion y finanzas"/>
            </div>
            <div class="banner">
                <img src="css/images/home/banner02.jpg" alt="Presupuesto Ciudadano"/>
            </div>
            <div>
                <img src="css/images/home/banner03.png" alt="Catalogo Artistico de Tabasco"/>
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