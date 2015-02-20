<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Usuarios del sistema</h3>
    </div>
    <div class="panel-body text-center" ng-show="loading">
        <span class="glyphicon glyphicon-refresh spin"></span>
    </div>
    <div class="panel-body" ng-show="users.length == 0 && !loading">
        <p>No hay usuarios dados de alta actualmente en el sistema.</p>
    </div>
    <div class="list-group" ng-show="users.length > 0 && !loading">
            <a class="list-group-item" style="cursor:pointer;" ng-click="edit($index, userList.id)" dir-paginate="userList in users| searchBy:q:filterWord | itemsPerPage:itemsPage " current-page="currentPage" ng-class="(userList.id === user.id && !userList.error) ? 'active' : userList.error ? 'list-group-item-warning':''">
                <div class="row">
                    <div class="col-sm-9">
                        <h4 class="list-group-item-heading">{[{ userList.nombreCompleto }]}</h4>
                        <p class="list-group-item-text">{[{ userList.username }]}</p>
                    </div>
                    <div class="col-sm-3">
                        <!-- Roles -->
                        <p class="text-left">
                            <span ng-repeat="rol in userList.roles" class="label label-warning">{[{ rol.name }]}</span>
                        </p>
                        <!-- Municipios -->
                        <p class="text-right">
                            <span ng-repeat="municipio in userList.municipios" class="label label-success">{[{ municipio.nombre_municipio }]}</span>
                            <span ng-if="userList.municipios.length == 0" class="label label-success">Todos</span>
                        </p>

                        <button ng-show="userList.idx !== undefinied && userList.error === undefinied" type="button" class="btn btn-success pull-right" title="Guardando datos ..." disabled="disabled">
                            <span class="glyphicon glyphicon-refresh spin"></span>
                        </button>
                    </div>
                </div>
            </a>
    </div>
    <nav class="text-center">
        <dir-pagination-controls template-url="paginator.html"></dir-pagination-controls>
    </nav>
</div>

<script type="text/ng-template" id="paginator.html">
    <ul class="pagination" ng-if="1 < pages.length">
        <li ng-if="boundaryLinks" ng-class="{ disabled : pagination.current == 1 }">
            <a href="" ng-click="setCurrent(1)">&laquo;</a>
        </li>
        <li ng-if="directionLinks" ng-class="{ disabled : pagination.current == 1 }">
            <a href="" ng-click="setCurrent(pagination.current - 1)">&lsaquo;</a>
        </li>
        <li ng-repeat="pageNumber in pages track by $index" ng-class="{ active : pagination.current == pageNumber, disabled : pageNumber == '...' }">
            <a href="" ng-click="setCurrent(pageNumber)">{[{ pageNumber }]}</a>
        </li>

        <li ng-if="directionLinks" ng-class="{ disabled : pagination.current == pagination.last }">
            <a href="" ng-click="setCurrent(pagination.current + 1)">&rsaquo;</a>
        </li>
        <li ng-if="boundaryLinks"  ng-class="{ disabled : pagination.current == pagination.last }">
            <a href="" ng-click="setCurrent(pagination.last)">&raquo;</a>
        </li>
    </ul>
</script>

<script type="text/ng-template" id="modalContent.html">
    <div class="modal-header">
        <h3 class="modal-title">Eliminar usuario</h3>
    </div>
    <div class="modal-body">
        <div class="well">
            ¿Deseas eliminar el usuario <strong>{[{ name }]}</strong>?
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" ng-click="cancel()">Cancelar</button>
        <button class="btn btn-danger" ng-click="destroy()">Eliminar</button>
    </div>
</script>