

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">claves de sistema</h3>
    </div>

    <div class="panel-body">
        <p>No hay claves dadas de alta actualmente en el sistema.</p>
    </div>
    <div class="list-group">
        <table class="table" >
            <thead>
                <tr>
                    <th>Cuenta</th>
                    <th>Tramite</th>
                    <th style="text-align: center;">Clave</th>
                    <th style="text-align: right;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($catalogo as $cat) {
                    ?>
                    <tr>
                        <td nowrap>
                            <?php echo $cuenta = $cat->cuenta; ?>
                        </td>
                        <td>
                            <?php echo $tramite = $cat->descripcion_tramite; ?>
                        </td>
                        <td>
                            <?php echo $clave = $cat->clave; ?>
                        </td>
                        <td style="text-align: right;" nowrap>
                            <a href="/editarclave/?id=<?php echo $cat->idtramite; ?>" class="btn btn-warning" title="Editar rol">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>

                            <a href="/Clavescobros/<?php echo $cat->idtramite; ?>" class="btn btn-danger" title="Borrar rol">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

