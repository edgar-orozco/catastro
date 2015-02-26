/**
 * Created by david on 25/02/15.
 */
angular.module('app', []).
    /**
     * Directiva para revisar el tamaño de un archivo
     */
    directive('bxdFileSize',function(){
        var linker = function(scope, element) {
            element.on('change', function() {
                scope.$emit('fileSize', this.files[0].size);
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
    controller('ShapeCtrl', function($scope) {
        $scope.limitSize = false;

        $scope.$on('fileSize', function(event, args){
            console.log(args);
            $scope.limitSize  = (args < 950229);
        });

    });