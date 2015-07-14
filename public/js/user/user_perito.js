/**
 * Modulo de angular para interaccion con el modulo de administracion de usuarios
 */
angular.module('app', [
    'ngAnimate',
    'ngResource',
    'ngSanitize',
    'ui.bootstrap',
    'angularUtils.directives.dirPagination',
    'frapontillo.bootstrap-switch'
]).
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
        var urlsave = decodeURIComponent(laroute.action('admin_usuarioPeritoController@store', { format : 'json' })),
            urlUpdate = decodeURIComponent(laroute.action('admin_usuarioPeritoController@update', {user : ':id', format : 'json' })),
            urlActive = decodeURIComponent(laroute.action('admin_usuarioPeritoController@active', {user : ':id'})),
            urlGetAll = decodeURIComponent(laroute.action('admin_usuarioPeritoController@all'));
        return $resource(urlsave, {},
            {
                getAll  : {method:'GET', isArray: true, url : urlGetAll},
                store   : {method:'POST', data: {}, isArray: false},
                update  : {method:'PUT', params: { id : '@id' }, data: {}, isArray: false, url: urlUpdate},
                active  : {method:'PUT', params: { id : '@id' }, data: {}, isArray: false, url: urlActive}
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
                    // Si se tiene el termino y no se ha agregado al los filtrados

                    if (haveTerm && filtered.indexOf(item) < 0 ) filtered.push(item);
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
 *
 */
    directive('selectTwo', function($timeout) {
        var linker = function(scope, element, attrs){
            element.select2({
                placeholder: attrs.placeholder
            });
            /**
             * Se escucha la coleccion de roles
             */
            scope.$watchCollection('selection', function(val){
                $timeout(function(){
                    element.val( val ).trigger("change");
                }, 0);
            });
        };

        return {
            restrict : 'A',
            scope : {
                selection  : '='
            },
            link : linker
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
        $scope.roles = [];
        $scope.perito = '';
        $scope.role = {};

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
            $scope.users[response.data.idx].nombreCompleto = $scope.users[response.data.idx].nombre + ' ' + $scope.users[response.data.idx].apepat +' '+($scope.users[response.data.idx].apemat !== undefined ? $scope.users[response.data.idx].apemat : '') ;
            // Se revisa la repuesta, si se guardo correctamente el form
            // se limpia y muestra un mensaje de exito
            if(response.status == 'success'){
                var idx = null;
                // Se limpian los roles seleccionados
                $scope.roles = {};
                // Se limpian los notarias seleccionados
                $scope.notarias = {};
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
                // Se agregan los notarias al usuario
                $scope.users[idx].perito  = response.data.perito;
                // Se agrega el id del usuario
                $scope.users[idx].id = response.data.id;
                delete $scope.users[idx].idx;
                if($scope.users[idx].vigente == undefined){
                    $scope.users[idx].vigente = true;
                }
                $scope.perito = '';
                // Se muestra el mensaje de exito
                $scope.successSave = true;
                $timeout(function(){
                    $scope.successSave = false;
                }, 10000);
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
            userSave.roles[roleDefault] = roleDefault;
            // Se modifican los datos de los notarias como los espera recibir laravel
            userSave.perito = $scope.perito;

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
            $scope.roles = [];
            // Se borrran los notarias previamente seleccionados
            $scope.notarias = [];
            // Se borra la busqueda
            idx = $scope.users.length -1;
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
            $scope.user.roles.forEach(function(val){
                $scope.roles.push(val.id);
            });
            $scope.perito = $scope.user.perito.perito_id;

            $scope.user.idx = idx;
        };
        /**
         * Funcion para eliminar un usuario de la lista
         * @param idx
         */
        $scope.destroy = function (idx) {
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
            $scope.notarias = [];
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

        /**
         * Función para activar o desactivar un usuario
         *
         * @param usuario
         */
        $scope.vigencia = function(user){
            var modalInstance = $modal.open({
                templateUrl : 'modalActive.html',
                controller  : 'ActiveCtrl',
                resolve     : {
                    user  : function(){
                        return user;
                    },
                    scope  : function(){
                        return $scope;
                    }
                }
            });
            modalInstance.result.then(null, function (event) {
                if(event == 'backdrop click' || event == 'escape key press'){
                    user.vigente = !user.vigente;
                }
            });
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
    }).
/**
 * Control para mostrar el modal para confirmar activar o seactivar a un usuario
 */
    controller('ActiveCtrl', function($scope, $timeout, $modalInstance, Users, user, scope) {
        $scope.user = user;
        /**
         * Funcion para elimnar un registro
         */
        $scope.active = function () {
            Users.active(
                { id : $scope.user.id },
                { vigente : $scope.user.vigente},
                function(data) {
                    if (data.status == 'success') {
                        if(scope.showForm){
                            if(user.id == scope.user.id ){
                                scope.user.vigente = $scope.user.vigente;
                                if(user.idx !== undefined){
                                    scope.users[user.idx].vigente = $scope.user.vigente;
                                }
                            }
                        }
                        $modalInstance.close('cancel');
                        scope.successSave = true;
                        $timeout(function(){
                            scope.successSave = false;
                        }, 10000)
                    }
                    else{
                        $modalInstance.close('cancel');
                    }
                });
        };
        /**
         * Funcion para cerrar el modal
         */
        $scope.cancel = function(){
            user.vigente = !user.vigente;
            $modalInstance.dismiss('cancel');
        };
    })
;