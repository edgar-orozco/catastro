<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Cargado de datos</h3>
    </div>
    <div class="panel-body fadein fadeout" ng-show="loading">
        <p>Cargando ...</p>
    </div>
    <div class="panel-body fadein fadeout" ng-show="carga.length == 0 && !loading">
        <p>No hay datos dados de alta actualmente en el sistema.</p>
    </div>
    <div class="list-group" ng-show="carga.length > 0 && !loading">
        <table class="table" >
           
            <tbody>
                <tr ng-repeat="cargas in carga" ng-class="cargas.error !== undefinied ? 'warning' : '' ">
                    <td>
                        

                        {[{ cargas.geom}]}
                        

                        

                    </td>
                    <td>
                        {[{ cargas.clave}]}
                    </td>
                    <td>
                        <button ng-show="ejecucion.idx !== undefinied && ejecucion.error === undefinied" type="button" class="btn btn-success" title="Guardando datos ..." disabled="disabled">
                            <span class="glyphicon glyphicon-refresh spin"></span>
                        </button>
                        <button ng-hide="ejecucion.idx !== undefinied && ejecucion.error === undefinied" type="button" class="btn btn-info" title="Editar permiso" ng-click="edit($index)">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                        <button ng-hide="ejecucion.idx !== undefinied && ejecucion.error === undefinied" type="button" class="btn btn-danger" title="Borrar permiso" ng-click="destroy($index)">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                        <button popover="popover" options="ejecucion.errors" ng-show="ejecucion.idx !== undefinied && ejecucion.error !== undefinied" type="button" class="btn btn-warning" title="El formulario contiene errores">
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
        <h3 class="modal-title">Eliminar registro</h3>
    </div>
    <div class="modal-body">
        <div class="well">
            ¿Deseas eliminar el registro <strong>{[{ ejecucion.municipio }]}</strong>?
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" ng-click="cancel()">Cancelar</button>
        <button class="btn btn-danger" ng-click="destroy()">Eliminar</button>
    </div>
</script>