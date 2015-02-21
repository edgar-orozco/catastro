/**
 * Created by david on 06/01/15.
 *
 * Modulo de angular para interaccion con el modulo de administracion de usuarios
 */
angular.module('app', ['ngAnimate', 'ngResource', 'ngSanitize','ui.bootstrap', 'angularUtils.directives.dirPagination']).
/**
 * Configuracion del modulo
 */
    config(function($interpolateProvider) {
        // Se cambian los delimitadores default de angular para no chocar con blade
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    }).
    /**
     * Factory para realizar operaciones CRUD sobre los usuarios
     */
    factory('Users', function($resource)
    {
        var urlsave = decodeURIComponent(laroute.action('AdminUserController@store', { format : 'json' }));
        var urlUpdate = decodeURIComponent(laroute.action('AdminUserController@update', {user : ':id', format : 'json' }));
        var urlGetAll = decodeURIComponent(laroute.action('AdminUserController@index', { format : 'json' }));
        var urlDestroy = decodeURIComponent(laroute.action('AdminUserController@destroy', { user : ':id' }));
        return $resource(urlsave, {},
            {
                getAll  : {method:'GET', isArray: true, url : urlGetAll},
                store   : {method:'POST', data: {}, isArray: false},
                update  : {method:'PUT', params: { id : '@id' }, data: {}, isArray: false, url: urlUpdate},
                destroy : {method:'DELETE', params: { id : '@id' }, isArray: false, url: urlDestroy}
            });
    }).
    filter('searchBy', function () {
        return function (items, q, filter) {
            var filtered = [];
            var exp = new RegExp(q, 'i');
            /**
             * Funcion para realizar filtros multiples
             *
             * @param term - Palabra a buscar
             * @param objectsFiltered - Lista de obejetos en los que se busca la palabra
             * @param element - Elemento que se busca
             * @param filtered - Lista de elementos filtrados
             * @param item - Item que se se deba agregar al arrelgo
             * @return filtered
             */
            var multipleFilter = function(term, objectsFiltered, element, filtered, item){
                var words = term.split(" ");
                // Se revisa cada una de las palabras ingresadas
                words.forEach(function( word ) {
                    var expWord = new RegExp(word, 'i');
                    var haveTerm = false;
                    var exist = false;
                    // Se revisa si el elemento a filtrar es un objeto
                    if(typeof objectsFiltered == "object") {
                        // Se revisa si la expresion de cada una de las palabras coincide con algun elemento de la lista enviada
                        objectsFiltered.forEach(function (objectFiltered) {
                            if (objectFiltered[element].search(expWord) >= 0) haveTerm = true;
                        });
                    }
                    // Se revisa si el elemento a filtrar es una cadena de texto
                    else if(typeof objectsFiltered == "string"){
                        if (objectsFiltered.search(expWord) >= 0) haveTerm = true;
                    }
                    // Se busca si el elemento no se agrego ya al arreglo
                    filtered.every(function (filters) {
                        if (angular.equals(filters, item)) {
                            exist = true;
                            return false;
                        }
                        return true;
                    });

                    if (haveTerm && !exist) filtered.push(item);
                });

                return filtered;
            };

            if(q!== undefined && q.length > 0)
            {
                items.forEach(function(item, i){
                    switch (filter){
                        case 'name':
                            filtered = multipleFilter(q, item.nombreCompleto, 'nombreCompleto', filtered, item);
                            break;
                        case 'apepat':
                            if (item.apepat.search(exp) >= 0) filtered.push(item);
                            break;
                        case 'apemat':
                            if (item.apemat.search(exp) >= 0) filtered.push(item);
                            break;
                        case 'email':
                            if (item.email.search(exp) >= 0) filtered.push(item);
                            break;
                        case 'user':
                            if (item.username.search(exp) >= 0) filtered.push(item);
                            break;
                        case 'rol':
                                filtered = multipleFilter(q, item.roles, 'name', filtered, item);
                            break;
                        case 'municipio':
                            // Se separa la expresion por espacios para poder buscar por mas de un municipio
                            var words = q.split(" ");
                            // Se revisa cada una de las palabras ingresadas
                            words.forEach(function( word ){
                                var expWord;
                                // Se reivsa que el usuario tenga municipios, si no los tiene no tiene caso hacer la busqueda
                                if( item.municipios.length == 0){
                                    expWord = new RegExp('todos', 'i');
                                    // Se revisa que se este buscando la palabra 'todos'
                                    if(word.search(expWord) >= 0) filtered.push(item);
                                }
                                else {
                                    expWord = new RegExp(word, 'i');
                                    var haveMunicipio = false;
                                    var exist = false;
                                    // Se revisa si la expresion de cada una de las palabras coincide con algun municipio de la lista
                                    item.municipios.forEach(function (municipio) {
                                        if (municipio.nombre_municipio.search(expWord) >= 0) {
                                            haveMunicipio = true;
                                        }
                                    });
                                    // Se busca si el elemento no se agrego ya al arreglo
                                    filtered.every(function (filters) {
                                        if (angular.equals(filters, item)) {
                                            exist = true;
                                            return false;
                                        }
                                        return true;
                                    });

                                    if (haveMunicipio && !exist) filtered.push(item);
                                }
                            });
                            // Por ultimo se reivsa si el usuario no tiene municipios y se esta buscando "todos municipios"

                            break
                    }
                });
                return filtered;
            }
            else{
               return items;
            }
        };
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
                        content += '<strong>Nombre del usuario</strong>';
                        content += '<ul>';
                        for(var i in val.name){
                            content += '<li>'+val.name[i]+'</li>';
                        }
                        content += '</ul>';
                    }
                    if(val.display_name !== undefined){
                        content += '<strong>Descripción del usuario</strong>';
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
     *Control para mostrar, crear, editar, actualizar y eliminar usuarios de la aplicacion
     */
    controller('UserCtrl', function($scope, $modal, $timeout, $location, $anchorScroll, Users) {
        // Variables que se exponen en la vista
        $scope.showForm = false;
        $scope.focusForm = false;
        $scope.focusFilter = false;
        $scope.loading = true;
        $scope.user = {};
        $scope.users = [];
        $scope.filterWord = 'name';
        $scope.currentPage = 1;
        $scope.itemsPage = 10;
        $scope.successSave = false;
        $scope.roles = {};
        $scope.municipios = {};
        // Variables para el control
        /**
         * Funcion para obtener la lista de todos los usuarios
         */
        var getUsers = function(){
            Users.getAll(function(response){
                $scope.loading = false;
                $scope.users = angular.copy(response);
            });
        };
        /**
         * Funcion que se ejecuta despues de guardar datos
         * @param reponse
         */
        var afterSave = function(response){
            // Se agrega el nombre completo al usuario
            $scope.users[response.data.idx].nombreCompleto = $scope.users[response.data.idx].nombre + ' ' + $scope.users[response.data.idx].apepat +' '+$scope.users[response.data.idx].apemat;
            // Se revisa la repuesta, si se guardo correctamente el form
            // se limpia y muestra un mensaje de exito
            if(response.status == 'success'){
                var idx = null;
                // Se limpian los roles seleccionados
                $scope.roles = {};
                // Se limpian los municipios seleccionados
                $scope.municipios = {};
                // Se busca el index del usuario en el arreglo
                $scope.users.forEach(function (element, index) {
                    if (element.id === response.data.id) {
                        idx = index;
                        return false;
                    }
                });
                // Si no se encontro el index es un usuario nuevo y su indice es el ultimo del arreglo
                if(idx === null){
                    idx = $scope.users.length-1;
                }
                // Se agregan los roles del usuario
                $scope.users[idx].roles = response.data.roles;
                // Se agregan los municipios al usuario
                $scope.users[idx].municipios = response.data.municipios;
                // Se agrega el id del usuario
                $scope.users[idx].id = response.data.id;
                delete $scope.users[idx].idx;
                // Se muestra el mensaje de exito
                $scope.successSave = true;
                $timeout(function(){
                    $scope.successSave = false;
                }, 10000)
            }
            // Si no se guardo correctamente el form,
            // se muestran los mensajes de error correspondientes
            else{
                $scope.users[response.data.idx].error = true;
                $scope.users[response.data.idx].errors = response.data.errors;
                $scope.user = angular.copy($scope.users[response.data.idx]);
            }
            // Se mueve el scroll a la parte superior
            $location.hash('top');
            $anchorScroll();
        };
        /**
         * Funcion para crear un usuario nuevo
         * @param user
         */
        var createUser = function(user){
            user.idx = $scope.users.length-1;
            Users.save(user,function(response){
                // Se mueve el paginador a la ultima pagina
                $scope.currentPage = Math.ceil($scope.users.length / $scope.itemsPage);
                afterSave(response);
            });
        };
        /**
         * Funcion para actualizar un usuario
         * @param user
         */
        var updateUser = function(user){
            Users.update({ id : user.id },user,function(response){
                afterSave(response);
            });
        };
        /**
         * Funcion para eliminar un usuario
         * @param idx
         */
        var deleteUser = function(idx){
            // Se revisa si el usuario esta guardado en el servidor
            if($scope.users[idx].id !== undefined){
                Users.destroy({ id : $scope.users[idx].id });
            }
            // Se elimina el usuario del arreglo
            $scope.users.splice(idx, 1);
        };
        // Se obtiene la lista de usuarios
        getUsers();
        /**
         * Funcion para iniciar la aplicacion
         */
        $scope.initApp = function(){
            $('#users').show();
        };
        /**
         * Función para guardar el formulario de usuarios
         */
        $scope.store = function(){
            $scope.focusForm = true;
            var userSave = angular.copy($scope.user);
            // Se resetean los datos del usuario
            $scope.user = {};
            // Se eliminan los errores del usuario al editar
            if(userSave.error !== undefined ){
                delete userSave.error;
                delete userSave.errors;
            }
            // Se modifican los datos de los roles como los espera recibir laravel
            userSave.roles = {};
            Object.getOwnPropertyNames($scope.roles).forEach(function(val, idx, array) {
                if($scope.roles[val] == true){
                    var role = val.replace('role', '');
                    userSave.roles[role] = role;
                }
            });
            // Se modifican los datos de los municipios como los espera recibir laravel
            userSave.municipios = {};
            Object.getOwnPropertyNames($scope.municipios).forEach(function(val, idx, array) {
                if($scope.municipios[val] == true){
                    var municipio = val.replace('municipio', '');
                    userSave.municipios[municipio] = municipio;
                }
            });
            // Se agrega el usuario a la lista de usuarios
            if (userSave.id == undefined){
                (userSave.idx == undefined) ? $scope.users.push(userSave) : $scope.users[userSave.idx] = angular.copy(userSave);
                createUser(userSave);
            }
            else{
                $scope.users[userSave.idx] = angular.copy(userSave);
                updateUser(userSave);
            }

        };
        /**
         * Funcion para editar usuario
         * @param idx
         */
        $scope.edit = function(idx, id){
            // Se borrran los roles previamente seleccionados
            $scope.roles = {};
            // Se borrran los municipios previamente seleccionados
            $scope.municipios = {};
            // Se borra la busqueda
            var idx = $scope.users.length -1;
            $scope.showForm = true;
            $scope.focusForm = true;
            if(id !== undefined){
                $scope.users.forEach(function (element, index) {
                    if (element.id === id) {
                        idx = index;
                        $scope.user = angular.copy(element);
                        return false;
                    }
                });
            }
            else{
                $scope.user = angular.copy($scope.users[idx]);
            }
            $scope.q = '';
            $scope.currentPage = Math.ceil( ( (idx+1) / $scope.itemsPage) );
            // Se marcan los roles que tiene el usuario
            for(var i in $scope.user.roles){
                $scope.roles['role'+$scope.user.roles[i].id] = true;
            }
            // Se marcan los municipios a los que esta asignado el usuario
            for(var i in $scope.user.municipios){
                $scope.municipios['municipio'+$scope.user.municipios[i].gid] = true;
            }
            $scope.user.idx = idx;
        };
        /**
         * Funcion para eliminar un usuario de la lista
         * @param idx
         */
        $scope.destroy = function (idx) {
            //if(confirm('Deseas elimnar el usuario '+ $scope.users[idx].name )) deleteUser(idx);
            var modalInstace = $modal.open({
                templateUrl: 'modalContent.html',
                controller : 'ModalCtrl',
                size       : 'sm',
                resolve    : {
                    user  : function(){
                        return {
                            name: $scope.users[idx].name,
                            idx: idx,
                            destroy: function (idx) {
                                deleteUser(idx);
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
            $scope.user = {};
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
        $scope.checkPassword = function(){
            // Definir tipo de validaciones para cada campo
            if($scope.user.password !== '' && $scope.user.password_confirmation){
                if($scope.user.password !== $scope.user.password_confirmation) return true;
            }
            return false;
        };
        /**
         * Función para colocar el nombdre del filtro que se esta aplicando en la busqueda
         */
        $scope.filterName = function(){
            switch ($scope.filterWord){
                case 'name':
                    return 'Nombre';
                    break;
                case 'apepat':
                    return 'Apellido paterno';
                    break;
                case 'apemat':
                    return 'Apellido materno';
                    break;
                case 'email':
                    return 'Email';
                    break;
                case 'user':
                    return 'Usuario';
                    break;
                case 'rol':
                    return 'Rol';
                    break;
                case 'municipio':
                    return 'Municipio';
                    break;
            }
        };
        /**
         * Funcion para cambiar el tipo de filtro
         *
         * @param filter
         */
        $scope.changeTypeFilter = function(filter){
            $scope.focusFilter = false;
            $timeout(function(){
                $scope.q = '';
                $scope.filterWord = filter;
                $scope.focusFilter = true;
            }, 100);
        };
    }).
/**
 * Control para mostrar el modal para confirmar el borrado de un registro
 */
    controller('ModalCtrl', function($scope, $modalInstance, user) {
        $scope.name = user.name;
        /**
         * Funcion para elimnar un registro
         */
        $scope.destroy = function () {
            user.destroy(user.idx);
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