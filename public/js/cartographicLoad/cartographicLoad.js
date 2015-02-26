/**
 * Created by david on 25/02/15.
 */
angular.module('app', []).
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
            element.on('change', function() {
                scope.$emit('fileChange', this.files[0]);
            });
        };

        return {
            restrict: 'A',
            link : linker
        };

    }).
    /**
     *  Control para carga cartografica
     */
    controller('ShapeCtrl', function($scope, $timeout) {
        $scope.isValid = false;
        $scope.showErrorSize = false;
        var maxSize = 0;

        /**
         * Funcion para setear el tamaño maximo de archivo que puede seleccionarse
         * @param size
         */
        $scope.initApp = function(size){
            maxSize = size;
        };
        /**
         * Se escucha el evento fileChange
         */
        $scope.$on('fileChange', function(event, args){
            $timeout(function () {
                // Se revisa que el archivo cumpla con el tamaño maximo del servidor
                $scope.$apply(function () {
                    $scope.isValid = (args.size < maxSize);
                    $scope.showErrorSize = !(args.size < maxSize);
                });
            }, 100);
        });
        /**
         * Funcion para indicar a la vista si el archivo seleccionado es valido
         * @return {boolean}
         */
        $scope.checkFile = function(){
            return !$scope.isValid;
        }
    });