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
            .texto{
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 12px;
                color: #0000000;
                font-style: normal;
                font-weight: normal;
                font-variant: normal;
                text-transform: none;
                line-height:15px;
            }
            .texto3{
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 13px;
                color: #0000000;
                font-style: normal;
                font-weight: normal;
                font-variant: normal;
                text-transform: none;
                line-height:15px;
            }
            .texto2{
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 35px;
                color: #0000000;
                font-style: normal;
                font-weight: normal;
                font-variant: normal;
                text-transform: none;
                line-height:15px;
            }
            #datos{
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 10px;
            }
            #encabezado{
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 12px;
                color: #0000000;
                font-style: normal;
                font-weight: normal;
                font-variant: normal;
                text-transform: none;
            }
            .page:after { content: counter(page, upper-roman); }
        </style>
        <title>Carta Invitación</title>
    </header>
    <body>
        <?php
        $fechas = date_parse($fecha);
        $fecha = array();
        $fecha['1'] = "Enero";
        $fecha['2'] = "Febrero";
        $fecha['3'] = "Marzo";
        $fecha['4'] = "Abril";
        $fecha['5'] = "Mayo";
        $fecha['6'] = "Junio";
        $fecha['7'] = "Julio";
        $fecha['8'] = "Agosto";
        $fecha['9'] = "Septiembre";
        $fecha['10'] = "Octubre";
        $fecha['11'] = "Noviebre";
        $fecha['12'] = "Diciembre";
        ?>
        <!-- Recorro todos los elementos -->
        <?php
        foreach ($vale as $key) {
            $mun = $key[0];
            $id_mun = substr($mun, 3, 3);
            $gid = Municipio::where('municipio', $id_mun)->pluck('gid');
            $mun_actual = Municipio::where('municipio', $id_mun)->pluck('nombre_municipio');
            $configutacion = configuracionMunicipal::where('municipio', $gid)->take(1)->get();
            foreach ($configutacion as $keys) {
                $nombrec = $keys->nombre;
                $cargo = $keys->cargo;
                $logo = $keys->file;
                $des_recargo = $keys->descuento_recargo;
                $des_gasto_eje = $keys->descuento_gasto_ejecucion;
            }
            ?>
            <div class="invitacionPage">
                <!-- saco el valor de cada elemento -->
                <!-- nuevo fotmato -->
                <table width ="100%" border="0" align="center">
                    <tr>
                        <td width    ="12%"><img src="logos/escudo.png" width="70" height="70"></td>
                        <td width    ="72%"><p align="center">AYUNTAMIENTO CONSTITUCIONAL DE <?php echo strtoupper($mun_actual); ?>, TAB.<br>DIRECCIÓN DE FINANZAS MUNICIPALES</p></td>

                        <td width    ="16%"><img src="css/images/logos/{{$logo}}" width="70" height="70"><br/></td>

                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan  ="2"><div align="right" class="texto3">INVITACION: DF/INV/0/2015</div></td>
                    </tr>
                </table>

                <p align     ="left" class="texto3">ESTIMADO (A): <b> <?php echo $key[1] ?> </b> R.F.C:</p>
            </p>

            <p class     ="texto" align="justify">
                <strong>La dirección de finanzas del municipio de <?php echo ucwords(strtolower($mun_actual)); ?>, no tiene registrado el cumplimiento del pago impuesto predial de un predio inscrito a su nombre, con número  de cuenta: <b> <?php echo $mun ?>, Ubicado en: CHICOACAN ?, Sup. Predio: <b> <?php echo str_replace(')', '',$key[3]) ?>m2, Sup. Construcion: <b> <?php echo $key[2] ?> m2 de este municipio; por lo que confundamento   en los artículos 1,6,8 fracción IV, 16 fracciones I, II y XII, 19, 22, 24, 31, 44, 45, 46, 47, 48, 72 fracciones I y IV, 87, 88 fracciones I, II y III, 103 y 105 fracciones IV y VII, 153, 154 y 155   de la ley de Hacienda Municipal del Estado de Tabasco; se le invita   a que realice su pago correspondiente de  a los años detallados a continuación:</strong></p>
        </p>
        <table width ="100%" border="0" class="texto">
            <tr>
                <td>
                    <table width="42%" border="0" align="right">
                        <thead>
                            <tr>
                                <th>VENCIDOS</th>
                                <th><div align="right">ADEUDO</div></th>
            </tr>
            </thead>
            <?php
            $vencido = DB::select("select sp_get_anios_vencidos('$mun')");
            $total_adeudo = 0;
            foreach ($vencido as $keys) {
                $vencidos = explode(',', $keys->sp_get_anios_vencidos);
                $aniov = str_replace('(', '', $vencidos[0]);
                $adeudov = str_replace(')', '', $vencidos[1]);
                $total_adeudo = $total_adeudo + $adeudov;
                ?>
                <tr>
                    <td><div align="center">{{$aniov}}</div></td>
                    <td><div align="right">{{$adeudov}}</div></td>
                </tr>
                <br>
            <?php } ?>
        </table>
    </td>
    </tr>
    <tr>
        <td>
            <br> <br>
            <table width="42%" border="0" align="right">
                <tr>
                    <th width="55%"><div align="right">SUB-TOTAL:</div></th>
                <td width="45%"><div align="right">$<?php echo $total_adeudo ?></div></td>
    </tr>
    <tr>
        <th><div align="right">ACTUALIZACION:</div></th>
    <?php
    $resultadog = DB::select("select sp_get_concepto_adeudo('$mun','$gid')");
    foreach ($resultadog as $keyss) {
        $itemsg = explode('-', $keyss->sp_get_concepto_adeudo);
    }
    $actualizacion = Number_format($itemsg[0], 2, '.', ',');
    $recargo = Number_format($itemsg[1], 2, '.', ',');
    $gastos_ejecucion = Number_format($itemsg[2], 2, '.', ',');
    $gran_total = Number_format($itemsg[3], 2, '.', ',');
    $descuento_multa = Number_format($itemsg[4], 2, '.', ',');
    $descuento_gasto = Number_format($itemsg[5], 2, '.', ',');
    $desccuento_recargo = Number_format($itemsg[6], 2, '.', ',');
    $total_vale = Number_format($itemsg[7], 2, '.', ',');
    ?>
    <td><div align="right">$<?php echo $actualizacion ?></div></td>
    </tr>
    <tr>
        <th><div align="right">RECARGOS</div></th>
    <td><div align="right">$<?php echo $recargo ?></div></td>
    </tr>
    <tr>
        <th><div align="right">MULTAS</div></th>
    <td><div align="right">$<?php echo $descuento_multa ?></div></td>
    </tr>
    <tr>
        <th><div align="right">GASTO DE EJECUCION:</div></th>
    <td><div align="right">$<?php echo $gastos_ejecucion ?></div></td>
    </tr>
    <tr>
        <th><div align="right">TOTAL ADEUDO:</div></th>
    <td><div align="right">$<?php echo $gran_total ?></div></td>
    </tr>
    </table></td>
    </tr>
    </table>

    <br><br><br><br><br><br>



    <p align="right" class="texto"><?php echo $mun_actual; ?>, Tab. a <?php echo $fechas['day'] . " de " . $fecha[$fechas['month']] . " del " . $fechas['year']; ?></p>



    <p class="texto" align="center">ATENTAMENTE</p>
    </br>
    <hr align="center" color="#000000" width="250">

    <p class="texto" align="center">{{$nombrec}}</p>
    <p class="texto" align="center">{{$cargo}}</p>

    <p>_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ _ _ _ _ _  _ _ _</p>
    <table width="100%" border="0">
        <tr>
            <td width="33%"><b class="texto3"><strong>C. <?php echo $key[1] ?>.</strong></b><br>

                <b class="texto">CUENTA: <?php echo $mun ?></b><br>
                <b class="texto">ENTREGA dd/mm/aaaa:</b>
            </td>
            <td width="33%"><p align="center" class="texto2">VALE</p></td>
        </tr>
    </table>
    <hr align="left" color="#000000" width="250">


    <p class="texto" align="justify">


        <strong>La Autoridad Municipal, en apoyo al contribuyente, brinda un plazo de 5 días hábiles para efectuar el pago correspondiente; al presentar este vale en caja usted recibirá la CONDONACION DEL <?php echo $descuento_multa ?>% en MULTAS y <?php echo $descuento_gasto ?>% en GASTOS DE EJECUCION, además de un DESCUENTO DEL <?php echo $desccuento_recargo ?>% sobre los RECARGOS, Pagando solamente Usted:</p>


    <p align="right">TOTAL A PAGAR: $<?php echo $total_vale ?></p>
    <br>
    <p align="center" class="texto2">¡ACTUALIZATE!</p><br/>

    <p class="texto" align="center"><strong>¡ESTE VALE SE HACE EXTENSIVO PARA TODOS SUS PREDIOS! Si usted ya realizo sus pagos, hace caso omiso de esta Invitación.</strong></p>
    </div>
<?php } ?>
</body>
</html>