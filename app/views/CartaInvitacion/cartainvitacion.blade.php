<html>
    <header>
        <style type="text/css">
            @page invitacion {
              size: A4 portrait;
              margin: 2cm;
            }
            .invitacionPage {
               page: invitacion;
               page-break-after: always;
            }
        </style>
    </header>
    <body>
        <!-- Recorro todos los elementos --> 
        <?php foreach($data as $key ){ ?>
        <div class="invitacionPage">
         <p>Formato Carta Invitaiónn <span>Falta Formato</span> !</p>
            <!-- saco el valor de cada elemento -->
            <p>Id de ejecucion enviado:  <?php echo $key ?> </p>
            <p>Fecha de ejecució:  <?php echo $fecha ?> </p>
            <p></p>

        </div>    
         <?php } ?>   
    </body>
</html>
