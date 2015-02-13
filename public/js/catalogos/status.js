/**
 * Created by Daniel Rivera on 04/02/15.
 *
 * Modulo de angular para interaccion con el modulo de status
 */

angular.module('statuss', ['ngAnimate', 'ngResource', 'ngSanitize','ui.bootstrap']).
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
    factory('Statuss', function($resource)
    {
        var urlsave = decodeURIComponent(laroute.action('catalogos_statusController@store', { format : 'json' }));
        var urlUpdate = decodeURIComponent(laroute.action('catalogos_statusController@update', {status : ':id', format : 'json' }));
        var urlGetAll = decodeURIComponent(laroute.action('catalogos_statusController@index', { format : 'json' }));
        var urlDestroy = decodeURIComponent(laroute.action('catalogos_statusController@destroy', { status : ':id' }));
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
                        content += '<strong>Nombre del status</strong>';
                        content += '<ul>';
                        for(var i in val.name){
                            content += '<li>'+val.name[i]+'</li>';
                        }
                        content += '</ul>';
                    }
                    if(val.display_name !== undefined){
                        content += '<strong>Descripción del status</strong>';
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
    controller('StatusCtrl', function($scope, $modal, Statuss) {
        // Variables que se exponen en la vista
        $scope.showForm = false;
        $scope.focusForm = false;
        $scope.loading = true;
        $scope.status = {};
        $scope.statuss = [];
        // Variables para el control
        var getStatuss = function(){
            Statuss.getAll(function(response){
                $scope.loading = false;
                $scope.statuss = angular.copy(response);
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
                $scope.statuss[response.data.idx].id = response.data.id;
                delete $scope.statuss[response.data.idx].idx;
            }
            // Si no se guardo correctamente el form,
            // se muestran los mensajes de error correspondientes
            else{
                $scope.statuss[response.data.idx].error = true;
                $scope.statuss[response.data.idx].errors = response.data.errors;
            }
        };
        /**
         * Funcion para crear un permiso nuevo
         * @param status
         */
        var createStatus = function(status){
            status.idx = $scope.statuss.length-1;
            Statuss.save(status,function(response){
                afterSave(response);
            });
        };
        /**
         * Funcion para actualizar un permiso
         * @param status
         */
        var updateStatus = function(status){
            Statuss.update({ id : status.id },status,function(response){
                afterSave(response);
            });
        };
        /**
         * Funcion para eliminar un permiso
         * @param idx
         */
        var deleteStatus = function(idx){
            // Se revisa si el permiso esta guardado en el servidor
            if($scope.statuss[idx].id !== undefined){
                Statuss.destroy({ id : $scope.statuss[idx].id });
            }
            // Se elimina el permiso del arreglo
            $scope.statuss.splice(idx, 1);
        };
        // Se obtiene la lista de permisos
        getStatuss();
        /**
         * Función para guardar el formulario de permisos
         */
        $scope.store = function(){
            $scope.focusForm = true;
            var statusSave = angular.copy($scope.status);
            // Se eliminan los errores del permiso al editar
            if(statusSave.error !== undefined ){
                delete statusSave.error;
                delete statusSave.errors;
            }
            $scope.status = {};
            // Se agrega el permiso a la lista de permisos
            if (statusSave.id == undefined){
                (statusSave.idx == undefined) ? $scope.statuss.push(statusSave) : $scope.statuss[statusSave.idx] = angular.copy(statusSave);
                createStatus(statusSave);
            }
            else{
                $scope.statuss[statusSave.idx] = angular.copy(statusSave);
                updateStatus(statusSave);
            }

        };
        /**
         * Funcion para editar permiso
         * @param idx
         */
        $scope.edit = function(idx){
            $scope.showForm = true;
            $scope.focusForm = true;
            $scope.status = angular.copy($scope.statuss[idx]);
            $scope.status.idx = idx;
        };
        /**
         * Funcion para eliminar un permiso de la lista
         * @param idx
         */
        $scope.destroy = function (idx) {
            //if(confirm('Deseas elimnar el permiso '+ $scope.statuss[idx].name )) deletePermission(idx);
            var modalInstace = $modal.open({
                templateUrl: 'modalContent.html',
                controller : 'ModalCtrl',
                size       : 'sm',
                resolve    : {
                    status  : function(){
                        return {
                            cve_status: $scope.statuss[idx].cve_status,
                            idx: idx,
                            destroy: function (idx) {
                                deleteStatus(idx);
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
            $scope.status = {};
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
    controller('ModalCtrl', function($scope, $modalInstance, status) {
        $scope.cve_status = status.cve_status;
        /**
         * Funcion para elimnar un registro
         */
        $scope.destroy = function () {
            status.destroy(status.idx);
            $modalInstance.dismiss('cancel');
        };
        /**
         * Funcion para cerrar el modal
         */
        $scope.cancel = function(){
            $modalInstance.dismiss('cancel');
        };
    })
;