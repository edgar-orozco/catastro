/**
 * Created by Daniel Rivera on 04/02/15.
 *
 * Modulo de angular para interaccion con el modulo de status
 */
angular.module('inpcs', ['ngAnimate', 'ngResource', 'ngSanitize','ui.bootstrap']).
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
    factory('Inpcs', function($resource)
    {
        var urlsave = decodeURIComponent(laroute.action('catalogos_inpcController@store', { format : 'json' }));
        var urlUpdate = decodeURIComponent(laroute.action('catalogos_inpcController@update', {inpc : ':id', format : 'json' }));
        var urlGetAll = decodeURIComponent(laroute.action('catalogos_inpcController@index', { format : 'json' }));
        var urlDestroy = decodeURIComponent(laroute.action('catalogos_inpcController@destroy', { inpc : ':id' }));
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
                    if(val.mes !== undefined){
                        content += '<strong>Mes del INPC</strong>';
                        content += '<ul>';
                        for(var i in val.mes){
                            content += '<li>'+val.mes[i]+'</li>';
                        }
                        content += '</ul>';
                    }
                    if(val.anio !== undefined){
                        content += '<strong>Año del INPC</strong>';
                        content += '<ul>';
                        for(var i in val.anio){
                            content += '<li>'+val.anio[i]+'</li>';
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
    controller('InpcsCtrl', function($scope, $modal, Inpcs) {
        // Variables que se exponen en la vista
        $scope.showForm = false;
        $scope.focusForm = false;
        $scope.loading = true;
        $scope.inpc = {};
        $scope.inpcs = [];
        // Variables para el control
        //Funcion para obtener la lista de todos los inpc
        var getInpcs = function(){
            Inpcs.getAll(function(response){
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
                $scope.inpcs[response.data.idx].id_inpc = response.data.id_inpc;
                delete $scope.inpcs[response.data.idx].idx;
            }
            // Si no se guardo correctamente el form,
            // se muestran los mensajes de error correspondientes
            else{
                $scope.inpcs[response.data.idx].error = true;
                $scope.inpcs[response.data.idx].errors = response.data.errors;
            }
        };
        /**
         * Funcion para crear un permiso nuevo
         * @param status
         */
        var createInpc = function(inpc){
            inpc.idx = $scope.inpcs.length-1;
            Inpcs.save(inpc,function(response){
                afterSave(response);
            });
        };
        /**
         * Funcion para actualizar un permiso
         * @param status
         */
        var updateInpc = function(inpc){
            Inpcs.update({ id_inpc : inpc.id_inpc },inpc,function(response){
                afterSave(response);
            });
        };
        /**
         * Funcion para eliminar un permiso
         * @param idx
         */
        var deleteInpc = function(idx){
            // Se revisa si el permiso esta guardado en el servidor
            if($scope.inpcs[idx].id_inpc !== undefined){
                Inpcs.destroy({ id_inpc : $scope.inpcs[idx].id_inpc });
            }
            // Se elimina el permiso del arreglo
            $scope.inpcs.splice(idx, 1);
        };
        // Se obtiene la lista de permisos
        getInpcs();
        /**
         * Función para guardar el formulario de permisos
         */
        $scope.store = function(){
            $scope.focusForm = true;
            var inpcSave = angular.copy($scope.inpc);
            // Se eliminan los errores del inpc al editar
            if(inpcSave.error !== undefined ){
                delete inpcSave.error;
                delete inpcSave.errors;
            }
            $scope.inpc = {};
            // Se agrega el permiso a la lista de permisos
            if (inpcSave.id_inpc == undefined){
                (inpcSave.idx == undefined) ? $scope.inpcs.push(inpcSave) : $scope.inpcs[inpcSave.idx] = angular.copy(inpcSave);
                createInpc(inpcSave);
            }
            else{
                $scope.inpcs[inpcSave.idx] = angular.copy(inpcSave);
                updateInpc(inpcSave);
            }

        };
        /**
         * Funcion para editar permiso
         * @param idx
         */
        $scope.edit = function(idx){
            $scope.showForm = true;
            $scope.focusForm = true;
            $scope.inpc = angular.copy($scope.inpcs[idx]);
            $scope.inpc.idx = idx;
        };
        /**
         * Funcion para eliminar un permiso de la lista
         * @param idx
         */
        $scope.destroy = function (idx) {
            //if(confirm('Deseas elimnar el inpc '+ $scope.statuss[idx].name )) deletePermission(idx);
            var modalInstace = $modal.open({
                templateUrl: 'modalContent.html',
                controller : 'ModalCtrl',
                size       : 'sm',
                resolve    : {
                    inpc  : function(){
                        return {
                           inpc : $scope.inpcs[idx].inpc,
                            idx: idx,
                            destroy: function (idx) {
                                deleteInpc(idx);
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
            $scope.inpc = {};
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
    controller('ModalCtrl', function($scope, $modalInstance, inpc) {
        $scope.inpc = inpc.inpc;
        /**
         * Funcion para elimnar un registro
         */
        $scope.destroy = function () {
            inpc.destroy(inpc.idx);
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