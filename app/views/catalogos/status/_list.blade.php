<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Estatus</h3>
    </div>
    <div class="panel-body fadein fadeout" ng-show="loading">
        <p>Cargando ...</p>
    </div>
    <div class="panel-body fadein fadeout" ng-show="statuss.length == 0 && !loading">
        <p>No hay status dados de alta actualmente en el sistema.</p>
    </div>
    <div class="list-group" ng-show="statuss.length > 0 && !loading">
        <table class="table" >
            <thead>
                <tr>
                    <th>Clave estatus</th>
                    <th>Descripción del estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="status in statuss" ng-class="status.error !== undefinied ? 'warning' : '' ">
                    <td>
                        {[{ status.cve_status }]}
                    </td>
                    <td>
                        {[{ status.descrip }]}
                    </td>
                    <td>
                        <button ng-show="status.idx !== undefinied && status.error === undefinied" type="button" class="btn btn-success" title="Guardando datos ..." disabled="disabled">
                            <span class="glyphicon glyphicon-refresh spin"></span>
                        </button>
                        <button ng-hide="status.idx !== undefinied && status.error === undefinied" type="button" class="btn btn-info" title="Editar status" ng-click="edit($index)">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                        <button ng-hide="status.idx !== undefinied && status.error === undefinied" type="button" class="btn btn-danger" title="Borrar status" ng-click="destroy($index)">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                        <button popover="popover" options="status.errors" ng-show="status.idx !== undefinied && status.error !== undefinied" type="button" class="btn btn-warning" title="El formulario contiene errores">
                            <span class="glyphicon glyphicon-exclamation-sign"></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script type="text/ng-template" id="modalContent.html">
    <div class="modal-header">
        <h3 class="modal-title">Eliminar status</h3>
    </div>
    <div class="modal-body">
        <div class="well">
            ¿Deseas eliminar el status <strong>{[{ cve_status }]}</strong>?
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" ng-click="cancel()">Cancelar</button>
        <button class="btn btn-danger" ng-click="destroy()">Eliminar</button>
    </div>
</script>