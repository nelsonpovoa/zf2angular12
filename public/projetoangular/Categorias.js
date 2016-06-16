var categorias = angular.module('Categorias', ['ngRoute']);
// [] - modulos externos que o angular vai usar

categorias.config(['routeProvider', function ($routeProvider){

    $routeProvider.when('/', {
        templateUrl: 'projetoangular/templates/categorias.html'
    });
}]);