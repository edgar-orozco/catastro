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
          factory('Buscar', function($resource)
    {
   
        var urlGetAll = decodeURIComponent(laroute.action('BuscarController@getIndex', { format : 'json' }));
       
        return $resource(urlsave, {},
            {
                getAll  : {method:'GET', isArray: true, url : urlGetAll},
//                store   : {method:'POST', data: {}, isArray: false},
//                update  : {method:'PUT', params: { id : '@id' }, data: {}, isArray: false, url: urlUpdate},
//                destroy : {method:'DELETE', params: { id : '@id' }, isArray: false, url: urlDestroy}
            });
    }).
    filter('buscar', function () {
        return function (items, b, filter) {
            var filtered = [];
            var exp = new RegExp(q, 'i');
            if(q!== undefined && q.length > 0)
            {
                for (var i = 0; i < items.length; i++) {
                    var item = items[i];
                    switch (filter){
                        case 'name':
                            if (item.nombre.search(exp) >= 0) filtered.push(item);
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
                            var haveRole = false;
                            for(var j in item.roles){
                                if(item.roles[j].name.search(exp) >= 0) haveRole = true;
                            }
                            if (haveRole) filtered.push(item);
                            break;
                    }
                }
                return filtered;
            }
            else{
               return items;
            }
        };
    });