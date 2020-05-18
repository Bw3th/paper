'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:HomeCtrl
 * @description
 * # HomeCtrl
 * Controller of the appApp
 */
angular.module('appApp')
    .controller('ClassDetailCtrl', function ($scope,$timeout, $location, $rootScope,$routeParams,czFactory) {
        $scope.info = [];
        $scope.gotoClass = function () {
            $location.url('class');
        };

        $scope.gotoHome = function () {
            $location.url('/');
        };

        $scope.getClassDetail = function () {
            czFactory.class.getClassDetail({
                id:$routeParams.id
            },function(data){
                $scope.info = data.info;
            },function(data){
                alert(data.info);
            });
        };

        $scope.getClassDetail();
    });


