/**
 * Created by david on 06/02/15.
 *
 * Modulo de angular para interaccion con el la edicion de datos del profile
 */

angular.module('app', ['ngAnimate', 'ngResource', 'ngSanitize']).
/**
 * Configuracion del modulo
 */
    config(function($interpolateProvider) {
        // Se cambian los delimitadores default de angular para no chocar con blade
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    }).
    /**
     * Factory para realizar operaciones CRUD sobre el usuario
     */
    factory('Users', function($resource)
    {
        var urlUpdate = decodeURIComponent(laroute.action('profle.update', {user : ':id', format : 'json' }));
        return $resource(urlUpdate, {},
            {
                update  : {method:'PUT', params: { id : '@id' }, data: {}, isArray: false}
            });
    }).
    /**
     * Control para manejar los datos del profile
     */
    controller('ProfileCtrl', function($scope, Users) {
        $scope.loading = false;
        $scope.user = {};
        var afterSave = function(response){
            // Se revisa la repuesta, si se guardo correctamente el form
            // se limpia y muestra un mensaje de exito
            if(response.status == 'success'){
                window.location = laroute.action('ProfileController@index');
            }
            // Si no se guardo correctamente el form,
            // se muestran los mensajes de error correspondientes
            else{
                $scope.loading = false;
                $scope.user.error = true;
                $scope.user.errors = response.data.errors;
            }
        };
        /**
         * Funcion para iniciar la aplicacion
         */
        $scope.initApp = function(user){
            $scope.user = user;
            $('#profile').show();
        };
        /**
         * Funcion para actualizar un usuario
         * @param user
         */
        $scope.updateUser = function(){
            $scope.loading = true;
            Users.update({ id : $scope.user.id },$scope.user,function(response){
                afterSave(response);
            });
        };
        /**
         * Función para validar el contenido del formulario
         */
        $scope.checkPassword = function(){
            // Definir tipo de validaciones para cada campo
            if($scope.user.password !== ''){
                if($scope.user.password !== $scope.user.password_confirmation) return true;
            }
            return false;
        };

    });