/**
 * Created by david on 06/01/15.
 *
 * Modulo de angular para interaccion con el modulo de administracion de usuarios
 */
angular.module('app', [
    'ngAnimate',
    'ngResource',
    'ngSanitize',
    'ui.bootstrap'
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
    factory('Consultas', function($resource)
    {
        var urlConsulta = decodeURIComponent(laroute.action('admin_AuditorAdminUsuariosController@consulta')),
            urlFiltros = decodeURIComponent(laroute.action('admin_AuditorAdminUsuariosController@filtros'));

        return $resource(urlConsulta, {},
            {
                consulta : { method:'GET', isArray: true },
                filtros  : { method:'GET', isArray: false, url : urlFiltros }
            });
    }).
    /**
     * Directiva selectTwo
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
     * Directiva para mostrar datos en una tabla DataTables
     * @returns {_L19.Anonym$3}
     */
    directive('datatables', function($compile){
        var linker = function($scope, element, attrs) {
            /**
             * Se observa el contenido de la tabla
             */
            $scope.$watchCollection('content', function(newData, old){
                if( newData !== undefined ){
                    element.DataTable().clear().rows.add( newData).draw();
                }
            });
            /**
             * Se agregan las funciones disponibles de la tabla
             */
            if($scope.events !== undefined){
                $scope.events.forEach(function(element, index){
                    $scope[element.name] = function(id){
                        $scope.events[index].event(id);
                    };
                });
            }

            element.DataTable( {
                "bLengthChange"     : $scope.dtLength !== undefined ? $scope.dtLength : true,
                "bFilter"           : $scope.dtFilter !== undefined ? $scope.dtFilter : true ,
                "aoColumns"         : $scope.columns,
                "fnDrawCallback"    : function( oSettings ) {
                    $compile(element.contents())($scope);
                },
                "language"          : {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "_MENU_",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar ",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        };

        return {
            restrict: 'A',
            link : linker,
            scope: {
                content  : '=',
                events   : '=',
                columns  : '=',
                dtFilter : '=',
                dtLength : '='
            }
        };
    }).
    /**
     *Control para mostrar, crear, editar, actualizar y eliminar usuarios de la aplicacion
     */
    controller('AuditorCtrl', function($scope, $modal, $timeout, $location, $anchorScroll, Consultas) {
        var changeDate = function(){
            $scope.today = new Date();
            $scope.minDate = new Date(2015, 5, 1);
            $scope.maxDate = $scope.today;
            $scope.maxDate.setDate($scope.today.getDate()-1);
            $scope.onlyDate = $scope.today;
            $scope.dateFrom = $scope.today;
            $scope.dateTo = $scope.today;
        };
        // Variables que se exponen en la vista
        $scope.filtrado = false;
        $scope.roles = [];
        $scope.selectOption = {
            select : []
        };
        $scope.municipios = [];
        $scope.dateOptions = {
            formatYear: 'yy',
            startingDay: 1,
            showWeeks : false
        };
        // Fechas
        $scope.format = 'yyyy/MM/dd';
        changeDate();
        // Datos de la tabla
        $scope.datosTabla = [];
        $scope.aoCols =[
            {
                "mData"     : "fecha"
            },
            {
                "mData"     : "actividad"
            },
            {
                "mData"     : "usuario"
            },
            {
                "mData"     : "registro"
            }
        ];
        $scope.filtros = [];
        $scope.initApp = function () {
            // Se muestran los datos de la aplicacion
            $('#auditor').show();
        };

        /**
         * Funcion para deactivar los dias domingo
         * @param date
         * @param mode
         * @returns {boolean}
         */
        $scope.disabled = function(date, mode) {
            return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
        };
        // Variables para el control
        /**
         * Funcion para abrir los calendarios de eventos
         * @param $event
         */
        $scope.open = function($event, calendar) {
            $event.preventDefault();
            $event.stopPropagation();
            $scope[calendar] = true;
        };

        $scope.changeDate = function(){
            changeDate();
        };

        /**
         * Función para cambiar el tipo de filtro d
         */
        $scope.changeFilter = function(){
            if($scope.filtro == ''){
                $scope.datosTabla = [];
            }
        };
        /**
         * Función para filtrar los resultados de la tabla
         */
        $scope.filterRecords = function(){
            $scope.filtrado = true;
            var consulta = {};
            if($scope.v !== '' && $scope.tipoFecha !== undefined) {
                if ($scope.tipoFecha == 'especifica') {
                    consulta.tipoFecha = 'especifica';
                    consulta.fecha = $scope.fecha;
                } else {
                    consulta.tipoFecha = 'rango-fechas';
                    consulta.inicio = $scope.inicio;
                    consulta.fin = $scope.fin;
                }
            }
            switch ($scope.filtro){

                case 'roles' :
                    consulta.tipo  = 'roles';
                    consulta.datos = jsonString($scope.selectOption.roles);
                    break;
                case 'municipios' :
                    consulta.tipo  = 'municipios';
                    consulta.datos = jsonString($scope.selectOption.municipios);
                    break;
                case 'actividades' :
                    consulta.tipo  = 'actividades';
                    consulta.datos = jsonString($scope.selectOption.actividades);
                    break;
                case 'usuario' :
                    consulta.tipo  = 'usuario';
                    consulta.datos = jsonString($scope.selectOption.usuario);
                    break;
            }
            Consultas.consulta( consulta, function(data){
                $scope.datosTabla = angular.copy(data);
            });
        };
        /**
         * Función para convertir en cadena un arreglo
         * @param datos
         * @returns {*}
         */
        var jsonString = function(datos){
            return JSON.stringify(datos)
        };
        /**
         * Función para activar o desactivar los botones de los filtros
         */
        $scope.isFilterSelect = function(){
            // Se revisa que se halla se leccionado un filtro
            if($scope.tipoFecha != '' && $scope.tipoFecha !== undefined){
                return !($scope.fecha || ($scope.inicio && $scope.fin) )
            }
            if($scope.filtro !== '' && $scope.filtro !== undefined){
                switch ($scope.filtro){
                    case 'roles' :
                        return !($scope.selectOption.roles != '');
                        break;
                    case 'municipios' :
                        return !($scope.selectOption.municipios != '');
                        break;
                    case 'actividades' :
                        return !($scope.selectOption.actividades != '');
                        break;
                    case 'usuario' :
                        return !($scope.selectOption.usuario != '');
                        break;
                }
            }
            return true;
        };
        /**
         * Función para limpiar el filtro
         */
        $scope.clearFilter = function(){
            window.location.href = "/admin/auditor";
        }
    })
;