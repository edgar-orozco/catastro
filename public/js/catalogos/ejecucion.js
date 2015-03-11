/**
 * Created by david on 04/12/14.
 *
 * Modulo de angular para interaccion con el modulo de ejecucion
 */

angular.module('ejecuciones', ['ngAnimate', 'ngResource', 'ngSanitize','ui.bootstrap']).
    /**
    * Configuracion del modulo
    */
    config(function($interpolateProvider) {
        // Se cambian los delimitadores default de angular para no chocar con blade
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    }).
    /**
     * Factory para realizar operaciones CRUD sobre las ejecuciones
     */
    factory('Ejecuciones', function($resource)
    {
        var urlsave = decodeURIComponent(laroute.action('catalogos_EjecucionController@store', { format : 'json' }));
        var urlUpdate = decodeURIComponent(laroute.action('catalogos_EjecucionController@update', {ejecucion : ':id', format : 'json' }));
        var urlGetAll = decodeURIComponent(laroute.action('catalogos_EjecucionController@index', { format : 'json' }));
        var urlDestroy = decodeURIComponent(laroute.action('catalogos_EjecucionController@destroy', { ejecucion : ':id' }));
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
    controller('EjecucionCtrl', function($scope, $modal, Ejecuciones) {
    
        // Variables que se exponen en la vista
        $scope.showForm = false;
        $scope.focusForm = false;
        $scope.loading = true;
        $scope.ejecucion = {};
        $scope.ejecuciones = [];
        // Variables para el control
        var getEjecuciones = function(){
            Ejecuciones.getAll(function(response){
                $scope.loading = false;
                $scope.ejecuciones = angular.copy(response);
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
                $scope.ejecuciones[response.data.idx].id = response.data.id;
                delete $scope.ejecuciones[response.data.idx].idx;
            }
            // Si no se guardo correctamente el form,
            // se muestran los mensajes de error correspondientes
            else{
                $scope.ejecuciones[response.data.idx].error = true;
                $scope.ejecuciones[response.data.idx].errors = response.data.errors;
            }
        };
        /**
         * Funcion para crear un permiso nuevo
         * @param permission
         */
        var createEjecucion = function(ejecucion){
            ejecucion.idx = $scope.ejecuciones.length-1;
            Ejecuciones.save(ejecucion,function(response){
                afterSave(response);
            });
        };
        /**
         * Funcion para actualizar un permiso
         * @param permission
         */
        var updateEjecucion = function(ejecucion){
            Ejecuciones.update({ id : ejecucion.id },ejecucion,function(response){
                afterSave(response);
            });
        };
        /**
         * Funcion para eliminar un permiso
         * @param idx
         */
        var deleteEjecucion = function(idx){
            // Se revisa si el permiso esta guardado en el servidor
            if($scope.ejecuciones[idx].id !== undefined){
                Ejecuciones.destroy({ id : $scope.ejecuciones[idx].id });
            }
            // Se elimina el permiso del arreglo
            $scope.ejecuciones.splice(idx, 1);
        };
        // Se obtiene la lista de permisos
        getEjecuciones();
        /**
         * Función para guardar el formulario de permisos
         */
        $scope.store = function(){
            $scope.focusForm = true;
            var ejecucionSave = angular.copy($scope.ejecucion);
            // Se eliminan los errores del permiso al editar
            if(ejecucionSave.error !== undefined ){
                delete ejecucionSave.error;
                delete ejecucionSave.errors;
            }
            $scope.ejecucion = {};
            // Se agrega el permiso a la lista de permisos
            if (ejecucionSave.id == undefined){
                (ejecucionSave.idx == undefined) ? $scope.ejecuciones.push(ejecucionSave) : $scope.ejecuciones[ejecucionSave.idx] = angular.copy(ejecucionSave);
                createEjecucion(ejecucionSave);
            }
            else{
                $scope.ejecuciones[ejecucionSave.idx] = angular.copy(ejecucionSave);
                updateEjecucion(ejecucionSave);
            }

        };
        /**
         * Funcion para editar permiso
         * @param idx
         */
        $scope.edit = function(idx){
            $scope.showForm = true;
            $scope.focusForm = true;
            $scope.ejecucion = angular.copy($scope.ejecuciones[idx]);
            $scope.ejecucion.idx = idx;
        };
        /**
         * Funcion para eliminar un permiso de la lista
         * @param idx
         */
        $scope.destroy = function (idx) {
            //if(confirm('Deseas elimnar el permiso '+ $scope.permissions[idx].name )) deletePermission(idx);
            var modalInstace = $modal.open({
                templateUrl: 'modalContent.html',
                controller : 'ModalCtrl',
                size       : 'sm',
                resolve    : {
                    ejecucion  : function(){
                        return {
                            name: $scope.ejecuciones[idx].name,
                            idx: idx,
                            destroy: function (idx) {
                                deleteEjecucion(idx);
                            }
                        }
                    }
                }
            });
        };
        /**
         * Funcion para ocultar el formulario
         */
        $scope.closeForm = function(){
            $scope.showForm = false;
            $scope.ejecucion = {};
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
    }).
    /**
     * Control para mostrar el modal para confirmar el borrado de un registro
     */
    controller('ModalCtrl', function($scope, $modalInstance, ejecucion) {
        $scope.name = ejecucion.name;
        /**
         * Funcion para elimnar un registro
         */
        $scope.destroy = function () {
            ejecucion.destroy(ejecucion.idx);
            $modalInstance.dismiss('cancel');
        };
        /**
         * Funcion para cerrar el modal
         */
        $scope.cancel = function(){
            $modalInstance.dismiss('cancel');
        };
    });