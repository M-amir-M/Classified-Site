var myApp = angular.module('agahi', []);

myApp.controller('PageController', ['$scope', '$http', function ($scope, $http) {
        $scope.$emit('LOAD');
        $http.get('/getbanners').success(function (ads) {
            $scope.banners = ads;
            $scope.$emit('UNLOAD');
        });
    }])
    .controller('HomeController', ['$scope', function ($scope) {
        $scope.$on('LOAD', function () {$scope.loading = true});
        $scope.$on('UNLOAD', function () {$scope.loading = false});
    }]);