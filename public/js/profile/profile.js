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
     * Directiva para revisar el tamaño de un archivo
     */
        directive('bxdFileSize',function(){
            var linker = function(scope, element) {
                element.hide();
                element.on('change', function() {
                    scope.$emit('fileChange', this.files[0]);
                });
                scope.$on('openSelector', function(event, args){
                    element.trigger('click');
                });

            };

            return {
                restrict: 'A',
                link : linker
            };

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
    controller('ProfileCtrl', function($scope, $timeout, $http, Users) {
        // Tamaño de la imagen
        $scope.imgMin = minImgSize;
        $scope.imgMax = maxImgSize;
        $scope.showErrorSize = false;
        $scope.showErrorType = false;
        $scope.imgActual = {
            "width"     : 0,
            "height"    : 0
        };
        $scope.loading = false;
        $scope.user = {};

        // Variables para el control
        var fd;

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
            if( user.foto == undefined || user.foto == null || user.foto == '' ){
                user.foto = 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100';
            }
            $('#profile').show();
        };
        /**
         * Funcion para actualizar un usuario
         * @param user
         */
        $scope.updateUser = function(){
            $scope.loading = true;
            Users.update({ id : $scope.user.id },$scope.user,function(response){
                if(fd){
                    $http.post( decodeURIComponent(laroute.action('admin_usuarioLogoController@update', {user : $scope.user.id, format : 'json' })), fd, {
                        transformRequest: angular.identity,
                        headers: { 'Content-Type': undefined }
                    }).then(function(){
                        afterSave(response);
                    });
                } else {
                    afterSave(response);
                }
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
        /**
         * Se escucha el evento fileChange
         */
            $scope.$on('fileChange', function(event, args){
            $timeout(function () {
                // Se revisa que el archivo cumpla con el tipo y el tamaño en pixeles proporcionado
                $scope.$apply(function () {
                    // Se revisa el tipo
                    $scope.user.foto = null;
                    if(args.type == 'image/png' || args.type == 'image/jpg' || args.type == 'image/jpeg') {
                        $scope.showErrorType = false;
                        var reader = new FileReader();
                        // Se lee la imagen.
                        fd = new FormData();
                        fd.append("foto", args);
                        reader.readAsDataURL(args);
                        reader.onload = function (e) {
                            // Se inicializa el objeto imagen
                            var image = new Image();

                            // Se para el reultado deñl contenido base64.
                            image.src = e.target.result;
                            // Se valida el tamaño de la imagen.
                            image.onload = function () {
                                var height = this.height;
                                var width = this.width;
                                if ((height > $scope.imgMax.height || width > $scope.imgMax.width)
                                    || (height < $scope.imgMin.height || width < $scope.imgMin.width)) {

                                    $scope.$apply(function () {
                                        $scope.showErrorSize = true;
                                        $scope.imgActual = {
                                            "width": width,
                                            "height": height
                                        };
                                    });
                                    return false;
                                }
                                $scope.$apply(function () {
                                    $scope.showErrorSize = false;
                                    $scope.user.foto = image.src;
                                });
                                return true;
                            };

                        }
                    } else {
                        $scope.showErrorType = true;
                        $scope.showErrorSize = false;
                    }
                });
            }, 100);
        });
        /**
         * Función para indicar al selector de archivos que se muestre
         */
        $scope.openFileSelector = function(){
            $scope.$emit('openSelector', true);
        }

    });