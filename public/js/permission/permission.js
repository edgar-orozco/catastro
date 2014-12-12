/**
 * Created by david on 04/12/14.
 *
 * Modulo de angular para interaccion con el modulo de permisos
 */

angular.module('permissions', ['ngResource', 'ngSanitize']).
    /**
    * Configuracion del modulo
    */
    config(function($interpolateProvider) {
        // Se cambian los delimitadores default de angular para no chocar con blade
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    }).
    /**
     * Factory para realizar operaciones CRUD sobre los permisos
     */
    factory('Permissions', function($resource)
    {
        var urlsave = decodeURIComponent(laroute.action('AdminPermissionsController@store', { format : 'json' }));
        var urlUpdate = decodeURIComponent(laroute.action('AdminPermissionsController@update', {permission : ':id', format : 'json' }));
        var urlGetAll = decodeURIComponent(laroute.action('AdminPermissionsController@index', { format : 'json' }));
        var urlDestroy = decodeURIComponent(laroute.action('AdminPermissionsController@destroy', { permission : ':id' }));
        return $resource(urlsave, {},
            {
                getAll  : {method:'GET', isArray: true, url : urlGetAll},
                store   : {method:'POST', data: {}, isArray: false},
                update  : {method:'PUT', params: { id : '@id' }, data: {}, isArray: false, url: urlUpdate},
                destroy : {method:'DELETE', params: { id : '@id' }, isArray: false, url: urlDestroy}
            });
    }).
    /**
     * Directiva para mostrar los errores en un popover
     *
     * @param {type} $window
     * @returns {unresolved}
     */
    directive('popover', function ($window) {
        var linker = function(scope, elemnet, attr){
            scope.$watch('options', function(val){
                if(val !== undefined)
                {
                    var content = '';
                    if(val.name !== undefined){
                        content += '<strong>Nombre del permiso</strong>';
                        content += '<ul>';
                        for(var i in val.name){
                            content += '<li>'+val.name[i]+'</li>';
                        }
                        content += '</ul>';
                    }
                    if(val.display_name !== undefined){
                        content += '<strong>Descripción del permiso</strong>';
                        content += '<ul>';
                        for(var i in val.display_name){
                            content += '<li>'+val.display_name[i]+'</li>';
                        }
                        content += '</ul>';
                    }
                    elemnet.popover({
                        title     : 'El formulario contiene errores',
                        content   : content,
                        placement : 'auto',
                        html      : true
                    });
                }
            });
        };
        return {
            restrict : 'A',
            scope : {
                options  : '='
            },
            link : linker
        };
    }).
    /**
     * Directiva para poner el focus en un elemento
     */
    directive('tbFocus', function($timeout) {
        return function(scope, element, attrs) {
            scope.$watch(attrs.tbFocus,function (newValue) {
                if(newValue){
                    $timeout(function(){
                        element.focus();
                    }, 100);
                }
            },true);
        };
    }).
    /**
     *
     */
    controller('PermissionsCtrl', function($scope, Permissions) {
        // Variables que se exponen en la vista
        $scope.showForm = false;
        $scope.focusForm = false;
        $scope.loading = true;
        $scope.permission = {};
        $scope.permissions = [];
        // Variables para el control
        var getPermissions = function(){
            Permissions.getAll(function(response){
                $scope.loading = false;
                $scope.permissions = angular.copy(response);
            });
        };
        /**
         * Funcion que se ejecuta despues de guardar datos
         * @param reponse
         */
        var afterSave = function(response){
            // Se revisa la repuesta, si se guardo correctamente el form
            // se limpia y muestra un mensaje de exito
            if(response.status == 'success'){
                $scope.permissions[response.data.idx].id = response.data.id;
                delete $scope.permissions[response.data.idx].idx;
            }
            // Si no se guardo correctamente el form,
            // se muestran los mensajes de error correspondientes
            else{
                $scope.permissions[response.data.idx].error = true;
                $scope.permissions[response.data.idx].errors = response.data.errors;
            }
        };
        /**
         * Funcion para crear un permiso nuevo
         * @param permission
         */
        var createPermission = function(permission){
            permission.idx = $scope.permissions.length-1;
            Permissions.save(permission,function(response){
                afterSave(response);
            });
        };
        /**
         * Funcion para actualizar un permiso
         * @param permission
         */
        var updatePermission = function(permission){
            Permissions.update({ id : permission.id },permission,function(response){
                afterSave(response);
            });
        };
        /**
         * Funcion para eliminar un permiso
         * @param idx
         */
        var deletePermission = function(idx){
            // Se revisa si el permiso esta guardado en el servidor
            if($scope.permissions[idx].id !== undefined){
                Permissions.destroy({ id : $scope.permissions[idx].id });
            }
            // Se elimina el permiso del arreglo
            $scope.permissions.splice(idx, 1);
        };
        // Se obtiene la lista de permisos
        getPermissions();
        /**
         * Función para guardar el formulario de permisos
         */
        $scope.store = function(){
            $scope.focusForm = true;
            var permissionSave = angular.copy($scope.permission);
            // Se eliminan los errores del permiso al editar
            if(permissionSave.error !== undefined ){
                delete permissionSave.error;
                delete permissionSave.errors;
            }
            $scope.permission = {};
            // Se agrega el permiso a la lista de permisos
            if (permissionSave.id == undefined){
                (permissionSave.idx == undefined) ? $scope.permissions.push(permissionSave) : $scope.permissions[permissionSave.idx] = angular.copy(permissionSave);
                createPermission(permissionSave);
            }
            else{
                $scope.permissions[permissionSave.idx] = angular.copy(permissionSave);
                updatePermission(permissionSave);
            }

        };
        /**
         * Funcion para editar permiso
         * @param idx
         */
        $scope.edit = function(idx){
            $scope.showForm = true;
            $scope.focusForm = true;
            $scope.permission = angular.copy($scope.permissions[idx]);
            $scope.permission.idx = idx;
        };
        /**
         * Funcion para eliminar un permiso de la lista
         * @param idx
         */
        $scope.destroy = function (idx) {
            if(confirm('Deseas elimnar el permiso '+ $scope.permissions[idx].name )) deletePermission(idx);
        };
        /**
         * Funcion para ocultar el formulario
         */
        $scope.closeForm = function(){
            $scope.showForm = false;
            $scope.permission = {};
        };
        /**
         * Funcion para mostrar el formulario
         */
        $scope.openForm = function(){
            $scope.showForm = true;
            $scope.focusForm = true;
        };
        /**
         * Función para validar el contenido del formulario
         */
        $scope.isInvalid = function(){
            // Definir tipo de validaciones para cada campo
            return false;
        }
    })
;