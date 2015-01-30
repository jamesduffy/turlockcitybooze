// create the module and name it tcbApp
var tcbApp = angular.module('tcbApp', ['ngRoute']);

// configure our routes
tcbApp.config(function($routeProvider) {
    $routeProvider

        // route for the home page
        .when('/', {
            templateUrl : 'templates/home.html',
            controller  : 'mainController'
        })

        // route for the about page
        .when('/about', {
            templateUrl : 'templates/about.html',
            controller  : 'aboutController'
        })

        // route for the contact page
        .when('/contact', {
            templateUrl : 'templates/contact.html',
            controller  : 'contactController'
        });
});

// create the controller and inject Angular's $scope
tcbApp.controller('mainController', function($scope) {
    // create a message to display in our view
    $scope.message = 'Everyone come and see how good I look!';
});

tcbApp.controller('aboutController', function($scope) {
    $scope.message = 'Look! I am an about page.';
});

tcbApp.controller('contactController', function($scope) {
    $scope.message = 'Contact us! JK. This is just a demo.';
});
